@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div><h1 class="text-3xl font-bold">Data Transaksi</h1><p class="text-slate-500">Daftar transaksi sewa</p></div>
    <a href="{{ route('transaksi.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded"><i class="bi bi-plus-lg mr-1"></i>Sewa Baru</a>
</div>
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-50 text-slate-600 uppercase text-xs">
            <tr><th class="px-4 py-3 text-left">ID</th><th class="px-4 py-3 text-left">Pelanggan</th><th class="px-4 py-3 text-left">Kendaraan</th><th class="px-4 py-3 text-left">Tgl Sewa</th><th class="px-4 py-3 text-left">Lama</th><th class="px-4 py-3 text-left">Total</th><th class="px-4 py-3 text-left">Status</th><th class="px-4 py-3 text-center">Aksi</th></tr>
        </thead>
        <tbody class="divide-y">
            @forelse($data as $t)
                <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3 font-medium" title="{{ $t->id_transaksi }}">#{{ substr($t->id_transaksi, 0, 8) }}</td>
                    <td class="px-4 py-3"><div class="font-medium">{{ $t->pelanggan->nama ?? '-' }}</div><div class="text-xs text-slate-500">{{ $t->pelanggan->no_hp ?? '' }}</div></td>
                    <td class="px-4 py-3"><div class="font-medium">{{ $t->kendaraan->nama_kendaraan ?? '-' }}</div><div class="text-xs text-slate-500">{{ $t->kendaraan->merk ?? '' }} - {{ $t->kendaraan->jenis ?? '' }}</div></td>
                    <td class="px-4 py-3">{{ $t->tgl_sewa }}</td>
                    <td class="px-4 py-3">{{ $t->lama_sewa }} hari</td>
                    <td class="px-4 py-3 font-medium">Rp {{ number_format($t->total_bayar, 0, ',', '.') }}</td>
                    <td class="px-4 py-3">
                        @if($t->status_pembayaran === 'lunas')
                            <span class="px-2 py-0.5 text-xs rounded bg-green-100 text-green-700">Lunas</span>
                        @else
                            <span class="px-2 py-0.5 text-xs rounded bg-orange-100 text-orange-700">Belum Lunas</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-center whitespace-nowrap">
                        <div class="flex justify-center space-x-1">
                            <a href="{{ route('transaksi.show', $t->id_transaksi) }}" class="w-8 h-8 flex items-center justify-center bg-slate-50 text-slate-600 hover:bg-slate-100 rounded border border-slate-200 transition-all shadow-sm" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('transaksi.edit', $t->id_transaksi) }}" class="w-8 h-8 flex items-center justify-center bg-blue-50 text-blue-600 hover:bg-blue-100 rounded border border-blue-200 transition-all shadow-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($t->status_pembayaran !== 'lunas')
                                <form action="{{ route('transaksi.bayar', $t->id_transaksi) }}" method="POST" class="inline" onsubmit="return confirm('Proses pembayaran?')">
                                    @csrf
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center bg-green-50 text-green-600 hover:bg-green-100 rounded border border-green-200 transition-all shadow-sm" title="Bayar">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('transaksi.destroy', $t->id_transaksi) }}" method="POST" class="inline" onsubmit="return confirm('Hapus transaksi?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 flex items-center justify-center bg-red-50 text-red-600 hover:bg-red-100 rounded border border-red-200 transition-all shadow-sm" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center py-10 text-slate-500"><i class="bi bi-inbox text-3xl block mb-2"></i>Belum ada transaksi</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
