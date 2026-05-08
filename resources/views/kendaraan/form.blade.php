@extends('layouts.app')

@section('content')
@php $isEdit = $item !== null; @endphp
<a href="{{ route('kendaraan.index') }}" class="text-sm text-slate-500"><i class="bi bi-arrow-left mr-1"></i>Kembali</a>
<h1 class="text-3xl font-bold mt-1 mb-6">{{ $isEdit ? 'Edit' : 'Tambah' }} Kendaraan</h1>

<div class="bg-white rounded-lg shadow max-w-2xl">
    <form action="{{ $isEdit ? route('kendaraan.update', $item->id_kendaraan) : route('kendaraan.store') }}" method="POST" class="p-6 space-y-4">
        @csrf
        @if($isEdit) @method('PUT') @endif
        <div>
            <label class="block text-sm font-medium mb-1">Nama Kendaraan</label>
            <input type="text" name="nama_kendaraan" value="{{ old('nama_kendaraan', $item->nama_kendaraan ?? '') }}" required class="w-full border rounded p-2">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Jenis</label>
                <select name="jenis" required class="w-full border rounded p-2">
                    <option value="">-- Pilih --</option>
                    @foreach(['Mobil', 'Motor'] as $j)
                        <option value="{{ $j }}" {{ old('jenis', $item->jenis ?? '') === $j ? 'selected' : '' }}>{{ $j }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Merk</label>
                <input type="text" name="merk" value="{{ old('merk', $item->merk ?? '') }}" required class="w-full border rounded p-2">
            </div>
        </div>
        <div class="grid {{ $isEdit ? 'grid-cols-2' : 'grid-cols-1' }} gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Harga Sewa per Hari (Rp)</label>
                <input type="number" name="harga_sewa" value="{{ old('harga_sewa', $item->harga_sewa ?? '') }}" required min="1" class="w-full border rounded p-2">
            </div>
            @if($isEdit)
                <div>
                    <label class="block text-sm font-medium mb-1">Status</label>
                    <select name="status" required class="w-full border rounded p-2">
                        @foreach(['tersedia', 'disewa', 'servis'] as $s)
                            <option value="{{ $s }}" {{ old('status', $item->status) === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>
        @if(!$isEdit)
            <div class="bg-blue-50 border-l-4 border-blue-400 p-3 text-sm text-blue-800">
                <i class="bi bi-info-circle mr-1"></i>Status otomatis di-set sebagai <strong>Tersedia</strong>.
            </div>
        @endif
        <div class="flex justify-end space-x-2 pt-2 border-t">
            <a href="{{ route('kendaraan.index') }}" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 rounded">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded"><i class="bi bi-check-lg mr-1"></i>{{ $isEdit ? 'Update' : 'Simpan' }}</button>
        </div>
    </form>
</div>
@endsection
