@extends('layouts.app')

@section('content')
@php $isEdit = $item ?? false; @endphp
<a href="{{ route('pengembalian.index') }}" class="text-sm text-slate-500"><i class="bi bi-arrow-left mr-1"></i>Kembali</a>
<h1 class="text-3xl font-bold mt-1 mb-6">{{ $isEdit ? 'Edit' : 'Kembalikan' }} Kendaraan</h1>

@if(!$isEdit && $transaksi->isEmpty())
    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded text-sm">
        Tidak ada transaksi siap dikembalikan.<br>
        <span class="text-xs">Transaksi harus berstatus <strong>Lunas</strong> dan belum pernah dikembalikan.</span>
    </div>
@else
    <div class="bg-white rounded-lg shadow max-w-2xl">
        <form action="{{ $isEdit ? route('pengembalian.update', $item->id_pengembalian) : route('pengembalian.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            @if($isEdit) @method('PUT') @endif
            <div>
                <label class="block text-sm font-medium mb-1">Pilih Transaksi</label>
                <select name="id_transaksi" required class="w-full border rounded p-2">
                    <option value="">-- Pilih --</option>
                    @foreach($transaksi as $t)
                        <option value="{{ $t->id_transaksi }}" {{ old('id_transaksi', $item->id_transaksi ?? '') == $t->id_transaksi ? 'selected' : '' }}>
                            #{{ substr($t->id_transaksi, 0, 8) }} - {{ $t->pelanggan->nama ?? '-' }} - {{ $t->kendaraan->nama_kendaraan ?? '-' }} (Sewa {{ $t->tgl_sewa }}, {{ $t->lama_sewa }} hari)
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Tanggal Kembali</label>
                <input type="date" name="tgl_kembali" value="{{ old('tgl_kembali', $item->tgl_kembali ?? date('Y-m-d')) }}" required class="w-full border rounded p-2">
            </div>
            @if($isEdit)
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Denda (Rp)</label>
                        <input type="number" name="denda" value="{{ old('denda', $item->denda) }}" required min="0" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Total Bayar (Rp)</label>
                        <input type="number" name="total_bayar" value="{{ old('total_bayar', $item->total_bayar) }}" required min="0" class="w-full border rounded p-2">
                    </div>
                </div>
            @endif
            <div class="bg-blue-50 border-l-4 border-blue-400 p-3 text-sm text-blue-800">
                <i class="bi bi-info-circle mr-1"></i>Denda Rp 50.000 per hari telat. Status kendaraan otomatis kembali ke <strong>Tersedia</strong>.
            </div>
            <div class="flex justify-end space-x-2 pt-2 border-t">
                <a href="{{ route('pengembalian.index') }}" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 rounded">Batal</a>
                <button type="submit" class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded"><i class="bi bi-check-lg mr-1"></i>{{ $isEdit ? 'Update' : 'Simpan' }}</button>
            </div>
        </form>
    </div>
@endif
@endsection
