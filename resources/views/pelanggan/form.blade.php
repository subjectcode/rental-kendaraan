@extends('layouts.app')

@section('content')
@php $isEdit = $item !== null; @endphp
<a href="{{ route('pelanggan.index') }}" class="text-sm text-slate-500"><i class="bi bi-arrow-left mr-1"></i>Kembali</a>
<h1 class="text-3xl font-bold mt-1 mb-6">{{ $isEdit ? 'Edit' : 'Tambah' }} Pelanggan</h1>

<div class="bg-white rounded-lg shadow max-w-2xl">
    <form action="{{ $isEdit ? route('pelanggan.update', $item->id_pelanggan) : route('pelanggan.store') }}" method="POST" class="p-6 space-y-4">
        @csrf
        @if($isEdit) @method('PUT') @endif
        <div>
            <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
            <input type="text" name="nama" value="{{ old('nama', $item->nama ?? '') }}" required class="w-full border rounded p-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">NIK (16 digit)</label>
            <input type="text" name="nik" value="{{ old('nik', $item->nik ?? '') }}" required maxlength="16" pattern="\d{16}" class="w-full border rounded p-2 font-mono">
            <p class="text-xs text-slate-500 mt-1">Wajib 16 angka</p>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">No HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp', $item->no_hp ?? '') }}" required pattern="\d{10,15}" class="w-full border rounded p-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Alamat</label>
            <textarea name="alamat" required rows="3" class="w-full border rounded p-2">{{ old('alamat', $item->alamat ?? '') }}</textarea>
        </div>
        <div class="flex justify-end space-x-2 pt-2 border-t">
            <a href="{{ route('pelanggan.index') }}" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 rounded">Batal</a>
            <button type="submit" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded"><i class="bi bi-check-lg mr-1"></i>{{ $isEdit ? 'Update' : 'Simpan' }}</button>
        </div>
    </form>
</div>
@endsection
