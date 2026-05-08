@extends('layouts.app')

@section('content')
<a href="{{ route('transaksi.index') }}" class="text-sm text-slate-500"><i class="bi bi-arrow-left mr-1"></i>Kembali</a>
<h1 class="text-3xl font-bold mt-1 mb-6">Detail Transaksi</h1>

<div class="bg-white rounded-lg shadow max-w-3xl">
    <div class="px-6 py-4 border-b flex justify-between bg-gradient-to-r from-blue-50 to-indigo-50">
        <div>
            <h2 class="text-lg font-bold" title="{{ $item->id_transaksi }}">Transaksi #{{ substr($item->id_transaksi, 0, 8) }}</h2>
            <p class="text-sm text-slate-500">Tanggal sewa: {{ $item->tgl_sewa }}</p>
        </div>
        @if($item->status_pembayaran === 'lunas')
            <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-700"><i class="bi bi-check-circle mr-1"></i>Lunas</span>
        @else
            <span class="px-3 py-1 text-sm rounded-full bg-orange-100 text-orange-700"><i class="bi bi-clock-history mr-1"></i>Belum Lunas</span>
        @endif
    </div>

    <div class="p-6 grid grid-cols-2 gap-6">
        <div>
            <h3 class="text-xs font-semibold uppercase text-slate-500 mb-2"><i class="bi bi-person-circle mr-1"></i>Pelanggan</h3>
            @if($pelanggan)
                <div class="space-y-1 text-sm">
                    <div class="font-medium text-base">{{ $pelanggan->nama }}</div>
                    <div>NIK: <span class="font-mono">{{ $pelanggan->nik }}</span></div>
                    <div>HP: {{ $pelanggan->no_hp }}</div>
                    <div class="text-slate-600">{{ $pelanggan->alamat }}</div>
                </div>
            @endif
        </div>
        <div>
            <h3 class="text-xs font-semibold uppercase text-slate-500 mb-2"><i class="bi bi-car-front mr-1"></i>Kendaraan</h3>
            @if($kendaraan)
                <div class="space-y-1 text-sm">
                    <div class="font-medium text-base">{{ $kendaraan->nama_kendaraan }}</div>
                    <div>Merk: {{ $kendaraan->merk }}</div>
                    <div>Jenis: {{ $kendaraan->jenis }}</div>
                    <div>Harga/hari: Rp {{ number_format($kendaraan->harga_sewa, 0, ',', '.') }}</div>
                </div>
            @endif
        </div>
    </div>

    <div class="border-t px-6 py-4 bg-slate-50">
        <h3 class="text-xs font-semibold uppercase text-slate-500 mb-3">Rincian</h3>
        <div class="space-y-2 text-sm">
            <div class="flex justify-between"><span>Tanggal Sewa</span><span class="font-medium">{{ $item->tgl_sewa }}</span></div>
            <div class="flex justify-between"><span>Lama Sewa</span><span class="font-medium">{{ $item->lama_sewa }} hari</span></div>
            @if($kendaraan)
                <div class="flex justify-between"><span>Harga per Hari</span><span class="font-medium">Rp {{ number_format($kendaraan->harga_sewa, 0, ',', '.') }}</span></div>
            @endif
            <div class="flex justify-between border-t pt-2 mt-2">
                <span class="font-semibold">Total Bayar</span>
                <span class="font-bold text-lg text-blue-700">Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <div class="border-t px-6 py-4 flex justify-end">
        @if($item->status_pembayaran !== 'lunas')
            <form action="{{ route('transaksi.bayar', $item->id_transaksi) }}" method="POST" onsubmit="return confirm('Proses pembayaran?')">
                @csrf
                <button class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded"><i class="bi bi-cash-coin mr-1"></i>Proses Pembayaran</button>
            </form>
        @else
            <span class="text-sm text-green-700">Pembayaran lunas. Lanjut ke <a href="{{ route('pengembalian.create') }}" class="underline font-medium">pengembalian</a>.</span>
        @endif
    </div>
</div>
@endsection
