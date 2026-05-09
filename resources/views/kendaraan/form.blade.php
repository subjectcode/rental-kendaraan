@extends('layouts.app')

@section('content')
@php $isEdit = $item !== null; @endphp
<a href="{{ route('kendaraan.index') }}" class="text-sm text-slate-500 hover:text-blue-600 transition-colors"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
<h1 class="text-3xl font-bold mt-1 mb-6"><i class="fas fa-car mr-2"></i>{{ $isEdit ? 'Edit' : 'Tambah' }} Kendaraan</h1>

<div class="bg-white rounded-lg shadow-lg border max-w-2xl overflow-hidden">
    <form action="{{ $isEdit ? route('kendaraan.update', $item->id_kendaraan) : route('kendaraan.store') }}" method="POST" class="p-6 space-y-4">
        @csrf
        @if($isEdit) @method('PUT') @endif
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-1">Nama Kendaraan</label>
            <input type="text" name="nama_kendaraan" value="{{ old('nama_kendaraan', $item->nama_kendaraan ?? '') }}" required class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none transition-all" placeholder="Contoh: Toyota Avanza">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Jenis</label>
                <select name="jenis" required class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none transition-all bg-white">
                    <option value="">-- Pilih --</option>
                    @foreach(['Mobil', 'Motor'] as $j)
                        <option value="{{ $j }}" {{ old('jenis', $item->jenis ?? '') === $j ? 'selected' : '' }}>{{ $j }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Merk</label>
                <input type="text" name="merk" value="{{ old('merk', $item->merk ?? '') }}" required class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none transition-all" placeholder="Contoh: Toyota">
            </div>
        </div>
        <div class="grid {{ $isEdit ? 'grid-cols-2' : 'grid-cols-1' }} gap-4">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Harga Sewa per Hari (Rp)</label>
                <input type="number" name="harga_sewa" value="{{ old('harga_sewa', $item->harga_sewa ?? '') }}" required min="1" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
            </div>
            @if($isEdit)
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Status</label>
                    <select name="status" required class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none transition-all bg-white">
                        @foreach(['tersedia', 'disewa', 'servis'] as $s)
                            <option value="{{ $s }}" {{ old('status', $item->status) === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>
        @if(!$isEdit)
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 text-sm text-blue-800 rounded-r-lg">
                <i class="fas fa-info-circle mr-1"></i>Status otomatis di-set sebagai <span class="font-bold">Tersedia</span>.
            </div>
        @endif
        <div class="flex justify-end space-x-2 pt-4 border-t">
            <a href="{{ route('kendaraan.index') }}" class="px-6 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg transition-all">Batal</a>
            <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md transition-all flex items-center">
                <i class="fas fa-save mr-2"></i>{{ $isEdit ? 'Update' : 'Simpan' }}
            </button>
        </div>
    </form>
</div>
    </form>
</div>
@endsection
