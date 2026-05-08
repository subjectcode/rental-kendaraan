<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController
{
    public function index()
    {
        return view('transaksi.index', ['data' => Transaksi::with(['pelanggan', 'kendaraan'])->get()]);
    }

    public function create()
    {
        return view('transaksi.form', [
            'pelanggan' => Pelanggan::all(),
            'kendaraan' => Kendaraan::where('status', 'tersedia')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'id_kendaraan' => 'required|exists:kendaraan,id_kendaraan',
            'tgl_sewa'     => 'required|date',
            'lama_sewa'    => 'required|integer|min:1',
        ]);

        $kendaraan = Kendaraan::findOrFail($data['id_kendaraan']);

        if ($kendaraan->status !== 'tersedia') {
            return back()->withInput()->with('error', 'Kendaraan sedang tidak tersedia');
        }

        $data['total_bayar'] = $kendaraan->harga_sewa * $data['lama_sewa'];
        $data['status_pembayaran'] = 'belum';

        Transaksi::create($data);

        $kendaraan->update(['status' => 'disewa']);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi sewa berhasil dibuat');
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load(['pelanggan', 'kendaraan']);
        return view('transaksi.detail', [
            'item'      => $transaksi,
            'pelanggan' => $transaksi->pelanggan,
            'kendaraan' => $transaksi->kendaraan,
        ]);
    }

    public function bayar(Transaksi $transaksi)
    {
        if ($transaksi->status_pembayaran === 'lunas') {
            return back()->with('error', 'Transaksi sudah lunas');
        }

        $transaksi->update(['status_pembayaran' => 'lunas']);
        return redirect()->route('transaksi.index')->with('success', 'Pembayaran berhasil diproses');
    }

    public function edit(Transaksi $transaksi)
    {
        return view('transaksi.form', [
            'item'      => $transaksi,
            'pelanggan' => Pelanggan::all(),
            'kendaraan' => Kendaraan::all(), // Include all for editing, even if not available
        ]);
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $data = $request->validate([
            'id_pelanggan'      => 'required|exists:pelanggan,id_pelanggan',
            'id_kendaraan'      => 'required|exists:kendaraan,id_kendaraan',
            'tgl_sewa'          => 'required|date',
            'lama_sewa'         => 'required|integer|min:1',
            'status_pembayaran' => 'required|in:lunas,belum',
        ]);

        $kendaraan = Kendaraan::findOrFail($data['id_kendaraan']);
        $data['total_bayar'] = $kendaraan->harga_sewa * $data['lama_sewa'];

        $transaksi->update($data);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi diperbarui');
    }

    public function destroy(Transaksi $transaksi)
    {
        $kendaraan = $transaksi->kendaraan;
        if ($kendaraan) {
            $kendaraan->update(['status' => 'tersedia']);
        }
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi dihapus');
    }
}
