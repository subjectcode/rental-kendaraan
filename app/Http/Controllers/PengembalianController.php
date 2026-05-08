<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class PengembalianController
{
    public function index()
    {
        return view('pengembalian.index', ['data' => Pengembalian::with(['transaksi.pelanggan', 'transaksi.kendaraan'])->get()]);
    }

    public function create()
    {
        // Ambil transaksi yang lunas dan belum dikembalikan
        $transaksiSiap = Transaksi::with(['pelanggan', 'kendaraan'])
            ->where('status_pembayaran', 'lunas')
            ->doesntHave('pengembalian')
            ->get();

        return view('pengembalian.form', [
            'transaksi' => $transaksiSiap
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_transaksi' => 'required|exists:transaksi,id_transaksi',
            'tgl_kembali'  => 'required|date',
        ]);

        $transaksi = Transaksi::findOrFail($data['id_transaksi']);

        if ($transaksi->status_pembayaran !== 'lunas') {
            return back()->withInput()->with('error', 'Transaksi belum lunas, silakan bayar dulu');
        }

        // Hitung denda telat
        $tgl_sewa = new \DateTime($transaksi->tgl_sewa);
        $tgl_kembali = new \DateTime($data['tgl_kembali']);
        $selisih_hari = $tgl_kembali->diff($tgl_sewa)->days;
        
        // Cek telat atau tidak
        // Logika sederhana: batas kembali = tgl_sewa + lama_sewa
        $batas_kembali = (clone $tgl_sewa)->modify('+' . $transaksi->lama_sewa . ' days');
        $telat = $tgl_kembali > $batas_kembali ? $tgl_kembali->diff($batas_kembali)->days : 0;
        
        $denda_per_hari = 50000;
        $data['denda'] = $telat * $denda_per_hari;
        $data['total_bayar'] = $transaksi->total_bayar + $data['denda'];

        Pengembalian::create($data);

        // Update status kendaraan kembali tersedia
        if ($transaksi->kendaraan) {
            $transaksi->kendaraan->update(['status' => 'tersedia']);
        }

        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian berhasil disimpan');
    }

    public function edit(Pengembalian $pengembalian)
    {
        return view('pengembalian.form', [
            'item'      => $pengembalian,
            'transaksi' => Transaksi::all(),
        ]);
    }

    public function update(Request $request, Pengembalian $pengembalian)
    {
        $data = $request->validate([
            'id_transaksi' => 'required|exists:transaksi,id_transaksi',
            'tgl_kembali'  => 'required|date',
            'denda'        => 'required|numeric|min:0',
            'total_bayar'  => 'required|numeric|min:0',
        ]);

        $pengembalian->update($data);

        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian diperbarui');
    }

    public function destroy(Pengembalian $pengembalian)
    {
        $pengembalian->delete();
        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian dihapus');
    }
}
