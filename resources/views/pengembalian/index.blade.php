@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div><h1 class="text-3xl font-bold"><i class="fas fa-car mr-2"></i>Data Pengembalian</h1><p class="text-slate-500">Daftar pengembalian kendaraan</p></div>
    <a href="{{ route('pengembalian.create') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded shadow-sm transition-colors"><i class="fas fa-undo mr-1"></i>Kembalikan</a>
</div>
<div class="bg-white rounded-lg shadow overflow-hidden border">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-50 text-slate-600 uppercase text-xs border-b">
            <tr><th class="px-4 py-3 text-left">ID</th><th class="px-4 py-3 text-left">Trx</th><th class="px-4 py-3 text-left">Pelanggan</th><th class="px-4 py-3 text-left">Kendaraan</th><th class="px-4 py-3 text-left">Tgl Kembali</th><th class="px-4 py-3 text-left">Denda</th><th class="px-4 py-3 text-left">Total</th><th class="px-4 py-3 text-center">Aksi</th></tr>
        </thead>
        <tbody class="divide-y">
            @forelse($data as $pg)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-3 font-medium text-slate-400" title="{{ $pg->id_pengembalian }}">#{{ substr($pg->id_pengembalian, 0, 8) }}</td>
                    <td class="px-4 py-3 font-mono text-xs"><a href="{{ route('transaksi.show', $pg->id_transaksi) }}" class="text-blue-600 hover:underline" title="{{ $pg->id_transaksi }}">#{{ substr($pg->id_transaksi, 0, 8) }}</a></td>
                    <td class="px-4 py-3 font-medium text-slate-700">{{ $pg->transaksi->pelanggan->nama ?? '-' }}</td>
                    <td class="px-4 py-3 text-slate-600">{{ $pg->transaksi->kendaraan->nama_kendaraan ?? '-' }}</td>
                    <td class="px-4 py-3 text-slate-600">{{ $pg->tgl_kembali }}</td>
                    <td class="px-4 py-3">
                        @if($pg->denda > 0)
                            <span class="text-red-600 font-bold">Rp {{ number_format($pg->denda, 0, ',', '.') }}</span>
                        @else
                            <span class="text-green-600 font-medium"><i class="fas fa-check mr-1"></i>Tidak ada</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 font-bold text-slate-800">Rp {{ number_format($pg->total_bayar, 0, ',', '.') }}</td>
                    <td class="px-4 py-3 text-center whitespace-nowrap">
                        <div class="flex justify-center space-x-1">
                            <a href="{{ route('pengembalian.edit', $pg->id_pengembalian) }}" class="w-8 h-8 flex items-center justify-center bg-blue-50 text-blue-600 hover:bg-blue-100 rounded border border-blue-200 transition-all shadow-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('pengembalian.destroy', $pg->id_pengembalian) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data pengembalian?')">
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
                <tr><td colspan="8" class="text-center py-12 text-slate-500"><i class="fas fa-undo-alt text-4xl block mb-3 opacity-20"></i>Belum ada pengembalian</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
        </tbody>
    </table>
</div>
@endsection
