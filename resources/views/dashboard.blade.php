@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-slate-800 mb-1"><i class="fas fa-car mr-2"></i>Dashboard</h1>
<p class="text-slate-500 mb-6">Ringkasan sistem rental kendaraan</p>

{{-- Kartu statistik --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-lg shadow p-5 border-l-4 border-blue-500">
        <p class="text-sm text-slate-500">Total Kendaraan</p>
        <p class="text-2xl font-bold">{{ $stats['total_kendaraan'] }}</p>
        <p class="text-xs text-slate-500 mt-1">
            <span class="text-green-600">{{ $stats['kendaraan_tersedia'] }} tersedia</span> ·
            <span class="text-orange-600">{{ $stats['kendaraan_disewa'] }} disewa</span>
        </p>
    </div>
    <div class="bg-white rounded-lg shadow p-5 border-l-4 border-purple-500">
        <p class="text-sm text-slate-500">Total Pelanggan</p>
        <p class="text-2xl font-bold">{{ $stats['total_pelanggan'] }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-5 border-l-4 border-green-500">
        <p class="text-sm text-slate-500">Total Transaksi</p>
        <p class="text-2xl font-bold">{{ $stats['total_transaksi'] }}</p>
        <p class="text-xs text-orange-600 mt-1">{{ $stats['transaksi_belum'] }} belum lunas</p>
    </div>
    <div class="bg-white rounded-lg shadow p-5 border-l-4 border-yellow-500">
        <p class="text-sm text-slate-500">Total Pendapatan</p>
        <p class="text-xl font-bold">Rp {{ number_format($stats['total_pendapatan'], 0, ',', '.') }}</p>
    </div>
</div>

{{-- Quick actions --}}
<div class="bg-white rounded-lg shadow p-5 mb-6">
    <h2 class="font-semibold text-slate-700 mb-3">Aksi Cepat</h2>
    <div class="flex flex-wrap gap-2">
        <a href="{{ route('transaksi.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm"><i class="fas fa-plus mr-1"></i>Sewa Baru</a>
        <a href="{{ route('pelanggan.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded text-sm"><i class="fas fa-user-plus mr-1"></i>Daftar Pelanggan</a>
        <a href="{{ route('kendaraan.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm"><i class="fas fa-car mr-1"></i>Tambah Kendaraan</a>
        <a href="{{ route('pengembalian.create') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded text-sm"><i class="fas fa-undo mr-1"></i>Pengembalian</a>
    </div>
</div>

{{-- 5 Transaksi terbaru --}}
<div class="bg-white rounded-lg shadow">
    <div class="px-5 py-3 border-b flex justify-between"><h2 class="font-semibold">Transaksi Terbaru</h2><a href="{{ route('transaksi.index') }}" class="text-sm text-blue-600">Lihat semua →</a></div>
    <table class="min-w-full text-sm">
        <thead class="bg-slate-50 text-slate-600"><tr><th class="px-4 py-2 text-left">ID</th><th class="px-4 py-2 text-left">Tgl Sewa</th><th class="px-4 py-2 text-left">Lama</th><th class="px-4 py-2 text-left">Total</th><th class="px-4 py-2 text-left">Status</th></tr></thead>
        <tbody class="divide-y">
            @forelse($transaksi_recent as $t)
                <tr class="hover:bg-slate-50">
                    <td class="px-4 py-2 font-medium" title="{{ $t->id_transaksi }}">#{{ substr($t->id_transaksi, 0, 8) }}</td>
                    <td class="px-4 py-2">{{ $t->tgl_sewa }}</td>
                    <td class="px-4 py-2">{{ $t->lama_sewa }} hari</td>
                    <td class="px-4 py-2">Rp {{ number_format($t->total_bayar, 0, ',', '.') }}</td>
                    <td class="px-4 py-2">
                        @if($t->status_pembayaran === 'lunas')
                            <span class="px-2 py-0.5 text-xs rounded bg-green-100 text-green-700">Lunas</span>
                        @else
                            <span class="px-2 py-0.5 text-xs rounded bg-orange-100 text-orange-700">Belum Lunas</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center py-6 text-slate-500">Belum ada transaksi</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
