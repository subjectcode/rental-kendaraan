<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController
{
    public function index()
    {
        return view('pelanggan.index', ['data' => Pelanggan::all()]);
    }

    public function create()
    {
        return view('pelanggan.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'   => 'required|string|max:255',
            'nik'    => 'required|string|size:16|unique:pelanggan,nik',
            'no_hp'  => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        Pelanggan::create($data);
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambah');
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.form', ['item' => $pelanggan]);
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $data = $request->validate([
            'nama'   => 'required|string|max:255',
            'nik'    => 'required|string|size:16|unique:pelanggan,nik,'.$pelanggan->id_pelanggan.',id_pelanggan',
            'no_hp'  => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        $pelanggan->update($data);
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan diperbarui');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan dihapus');
    }
}
