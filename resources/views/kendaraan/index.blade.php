@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div><h1 class="text-3xl font-bold"><i class="fas fa-car mr-2"></i>Data Kendaraan</h1><p class="text-slate-500">Daftar seluruh kendaraan rental</p></div>
    <a href="{{ route('kendaraan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow-sm transition-colors"><i class="fas fa-plus mr-1"></i>Tambah</a>
</div>
<div class="bg-white rounded-lg shadow overflow-hidden border">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-50 text-slate-600 uppercase text-xs border-b">
            <tr><th class="px-4 py-3 text-left">ID</th><th class="px-4 py-3 text-left">Nama</th><th class="px-4 py-3 text-left">Jenis</th><th class="px-4 py-3 text-left">Merk</th><th class="px-4 py-3 text-left">Harga/Hari</th><th class="px-4 py-3 text-left">Status</th><th class="px-4 py-3 text-center">Aksi</th></tr>
        </thead>
        <tbody class="divide-y">
            @forelse($data as $k)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-3 font-medium text-slate-400" title="{{ $k->id_kendaraan }}">#{{ substr($k->id_kendaraan, 0, 8) }}</td>
                    <td class="px-4 py-3 font-bold text-slate-700">{{ $k->nama_kendaraan }}</td>
                    <td class="px-4 py-3">
                        @if($k->jenis === 'Mobil')
                            <span class="px-2 py-0.5 text-xs rounded bg-blue-100 text-blue-700 border border-blue-200"><i class="fas fa-car mr-1"></i>{{ $k->jenis }}</span>
                        @else
                            <span class="px-2 py-0.5 text-xs rounded bg-purple-100 text-purple-700 border border-purple-200"><i class="fas fa-motorcycle mr-1"></i>{{ $k->jenis }}</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">{{ $k->merk }}</td>
                    <td class="px-4 py-3 font-medium">Rp {{ number_format($k->harga_sewa, 0, ',', '.') }}</td>
                    <td class="px-4 py-3">
                        @if($k->status === 'tersedia')
                            <span class="px-2 py-0.5 text-xs rounded bg-green-100 text-green-700 border border-green-200"><i class="fas fa-check-circle mr-1"></i>{{ ucfirst($k->status) }}</span>
                        @elseif($k->status === 'disewa')
                            <span class="px-2 py-0.5 text-xs rounded bg-orange-100 text-orange-700 border border-orange-200"><i class="fas fa-clock mr-1"></i>{{ ucfirst($k->status) }}</span>
                        @else
                            <span class="px-2 py-0.5 text-xs rounded bg-red-100 text-red-700 border border-red-200"><i class="fas fa-tools mr-1"></i>{{ ucfirst($k->status) }}</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-center whitespace-nowrap">
                        <div class="flex justify-center space-x-1">
                            <a href="{{ route('kendaraan.edit', $k->id_kendaraan) }}" class="w-8 h-8 flex items-center justify-center bg-blue-50 text-blue-600 hover:bg-blue-100 rounded border border-blue-200 transition-all shadow-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('kendaraan.destroy', $k->id_kendaraan) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kendaraan ini?')">
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
                <tr><td colspan="7" class="text-center py-12 text-slate-500"><i class="fas fa-inbox text-4xl block mb-3 opacity-20"></i>Belum ada kendaraan</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
        </tbody>
    </table>
</div>
@endsection
