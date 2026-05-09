@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div><h1 class="text-3xl font-bold"><i class="fas fa-car mr-2"></i>Data Pelanggan</h1><p class="text-slate-500">Daftar pelanggan terdaftar</p></div>
    <a href="{{ route('pelanggan.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded shadow-sm transition-colors"><i class="fas fa-user-plus mr-1"></i>Tambah</a>
</div>
<div class="bg-white rounded-lg shadow overflow-hidden border">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-50 text-slate-600 uppercase text-xs border-b">
            <tr><th class="px-4 py-3 text-left">ID</th><th class="px-4 py-3 text-left">Nama</th><th class="px-4 py-3 text-left">NIK</th><th class="px-4 py-3 text-left">No HP</th><th class="px-4 py-3 text-left">Alamat</th><th class="px-4 py-3 text-center">Aksi</th></tr>
        </thead>
        <tbody class="divide-y">
            @forelse($data as $p)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-3 font-medium text-slate-400" title="{{ $p->id_pelanggan }}">#{{ substr($p->id_pelanggan, 0, 8) }}</td>
                    <td class="px-4 py-3 font-bold text-slate-700"><i class="fas fa-user-circle text-slate-300 mr-1"></i>{{ $p->nama }}</td>
                    <td class="px-4 py-3 font-mono text-xs text-slate-500">{{ $p->nik }}</td>
                    <td class="px-4 py-3 text-slate-600"><i class="fas fa-phone-alt text-slate-300 mr-2 text-xs"></i>{{ $p->no_hp }}</td>
                    <td class="px-4 py-3 max-w-xs truncate text-slate-600" title="{{ $p->alamat }}">{{ $p->alamat }}</td>
                    <td class="px-4 py-3 text-center whitespace-nowrap">
                        <div class="flex justify-center space-x-1">
                            <a href="{{ route('pelanggan.edit', $p->id_pelanggan) }}" class="w-8 h-8 flex items-center justify-center bg-blue-50 text-blue-600 hover:bg-blue-100 rounded border border-blue-200 transition-all shadow-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('pelanggan.destroy', $p->id_pelanggan) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pelanggan ini?')">
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
                <tr><td colspan="6" class="text-center py-12 text-slate-500"><i class="fas fa-users-slash text-4xl block mb-3 opacity-20"></i>Belum ada pelanggan</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
        </tbody>
    </table>
</div>
@endsection
