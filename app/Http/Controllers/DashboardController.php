<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Pelanggan;
use App\Models\Transaksi;

class DashboardController
{
    public function index()
    {
        $kendaraan = Kendaraan::all();
        $pelanggan = Pelanggan::all();
        $transaksi = Transaksi::all();

        $stats = [
            'total_kendaraan'      => $kendaraan->count(),
            'kendaraan_tersedia'   => $kendaraan->where('status', 'tersedia')->count(),
            'kendaraan_disewa'     => $kendaraan->where('status', 'disewa')->count(),
            'total_pelanggan'      => $pelanggan->count(),
            'total_transaksi'      => $transaksi->count(),
            'transaksi_belum'      => $transaksi->where('status_pembayaran', 'belum')->count(),
            'total_pendapatan'     => $transaksi->where('status_pembayaran', 'lunas')->sum('total_bayar'),
        ];

        $transaksi_recent = Transaksi::with(['pelanggan', 'kendaraan'])
            ->latest('id_transaksi')
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'transaksi_recent'));
    }
}
