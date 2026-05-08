<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController
{
    public function index()
    {
        return view('kendaraan.index', ['data' => Kendaraan::all()]);
    }

    public function create()
    {
        return view('kendaraan.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kendaraan' => 'required|string|max:255',
            'jenis'          => 'required|in:Mobil,Motor',
            'merk'           => 'required|string|max:50',
            'harga_sewa'     => 'required|numeric|min:1',
        ]);
        $data['status'] = 'tersedia';

        Kendaraan::create($data);
        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil ditambahkan');
    }

    public function edit(Kendaraan $kendaraan)
    {
        return view('kendaraan.form', ['item' => $kendaraan]);
    }

    public function update(Request $request, Kendaraan $kendaraan)
    {
        $data = $request->validate([
            'nama_kendaraan' => 'required|string|max:255',
            'jenis'          => 'required|in:Mobil,Motor',
            'merk'           => 'required|string|max:50',
            'harga_sewa'     => 'required|numeric|min:1',
            'status'         => 'required|in:tersedia,disewa,servis',
        ]);

        $kendaraan->update($data);
        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan diperbarui');
    }

    public function destroy(Kendaraan $kendaraan)
    {
        $kendaraan->delete();
        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan dihapus');
    }
}
