@extends('layouts.app')

@section('content')
<a href="{{ route('transaksi.index') }}" class="text-sm text-slate-500 hover:text-blue-600 transition-colors"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
<h1 class="text-3xl font-bold mt-1 mb-6"><i class="fas fa-car mr-2"></i>Detail Transaksi</h1>

<div class="bg-white rounded-lg shadow-lg border max-w-3xl overflow-hidden">
    <div class="px-6 py-4 border-b flex justify-between items-center bg-gradient-to-r from-blue-50 to-indigo-50">
        <div>
            <h2 class="text-lg font-bold text-slate-800" title="{{ $item->id_transaksi }}">Transaksi #{{ substr($item->id_transaksi, 0, 8) }}</h2>
            <p class="text-sm text-slate-500"><i class="fas fa-calendar-alt mr-1"></i>Tanggal sewa: {{ $item->tgl_sewa }}</p>
        </div>
        @if($item->status_pembayaran === 'lunas')
            <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-700 border border-green-200"><i class="fas fa-check-circle mr-1"></i>Lunas</span>
        @else
            <span class="px-3 py-1 text-sm rounded-full bg-orange-100 text-orange-700 border border-orange-200"><i class="fas fa-clock mr-1"></i>Belum Lunas</span>
        @endif
    </div>

    <div class="p-6 grid grid-cols-2 gap-6">
        <div>
            <h3 class="text-xs font-semibold uppercase text-slate-400 mb-3 tracking-wider"><i class="fas fa-user-circle mr-1"></i>Pelanggan</h3>
            @if($pelanggan)
                <div class="space-y-1 text-sm">
                    <div class="font-bold text-base text-slate-800">{{ $pelanggan->nama }}</div>
                    <div class="text-slate-600">NIK: <span class="font-mono">{{ $pelanggan->nik }}</span></div>
                    <div class="text-slate-600">HP: {{ $pelanggan->no_hp }}</div>
                    <div class="text-slate-500 mt-2 italic">"{{ $pelanggan->alamat }}"</div>
                </div>
            @endif
        </div>
        <div>
            <h3 class="text-xs font-semibold uppercase text-slate-400 mb-3 tracking-wider"><i class="fas fa-car-side mr-1"></i>Kendaraan</h3>
            @if($kendaraan)
                <div class="space-y-1 text-sm">
                    <div class="font-bold text-base text-slate-800">{{ $kendaraan->nama_kendaraan }}</div>
                    <div class="text-slate-600">Merk: {{ $kendaraan->merk }}</div>
                    <div class="text-slate-600">Jenis: {{ $kendaraan->jenis }}</div>
                    <div class="text-blue-700 font-medium">Harga/hari: Rp {{ number_format($kendaraan->harga_sewa, 0, ',', '.') }}</div>
                </div>
            @endif
        </div>
    </div>

    <div class="border-t px-6 py-4 bg-slate-50">
        <h3 class="text-xs font-semibold uppercase text-slate-400 mb-3 tracking-wider">Rincian Pembayaran</h3>
        <div class="space-y-2 text-sm">
            <div class="flex justify-between text-slate-600"><span>Tanggal Sewa</span><span class="font-medium text-slate-800">{{ $item->tgl_sewa }}</span></div>
            <div class="flex justify-between text-slate-600"><span>Lama Sewa</span><span class="font-medium text-slate-800">{{ $item->lama_sewa }} hari</span></div>
            @if($kendaraan)
                <div class="flex justify-between text-slate-600"><span>Harga per Hari</span><span class="font-medium text-slate-800">Rp {{ number_format($kendaraan->harga_sewa, 0, ',', '.') }}</span></div>
            @endif
            <div class="flex justify-between border-t pt-2 mt-2">
                <span class="font-bold text-slate-700 uppercase text-xs self-center">Total Bayar</span>
                <span class="font-bold text-2xl text-blue-700">Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <div class="border-t px-6 py-4 flex justify-end bg-white">
        @if($item->status_pembayaran !== 'lunas')
            <form action="{{ route('transaksi.bayar', $item->id_transaksi) }}" method="POST" onsubmit="return confirm('Proses pembayaran?')">
                @csrf
                <button class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-sm transition-all flex items-center">
                    <i class="fas fa-money-bill-wave mr-2"></i>Proses Pembayaran
                </button>
            </form>
        @else
            <span class="text-sm text-green-700">Pembayaran lunas. Lanjut ke <a href="{{ route('pengembalian.create') }}" class="underline font-medium">pengembalian</a>.</span>
        @endif
    </div>
</div>
@endsection
