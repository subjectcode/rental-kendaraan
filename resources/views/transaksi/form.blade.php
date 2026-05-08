@extends('layouts.app')

@section('content')
@php $isEdit = $item ?? false; @endphp
<a href="{{ route('transaksi.index') }}" class="text-sm text-slate-500"><i class="bi bi-arrow-left mr-1"></i>Kembali</a>
<h1 class="text-3xl font-bold mt-1 mb-6">{{ $isEdit ? 'Edit' : 'Sewa' }} Kendaraan</h1>

@if($pelanggan->isEmpty())
    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded mb-4 text-sm">
        Belum ada pelanggan. <a href="{{ route('pelanggan.create') }}" class="underline font-medium">Daftar pelanggan dulu</a>.
    </div>
@endif
@if($kendaraan->isEmpty())
    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded mb-4 text-sm">Tidak ada kendaraan tersedia.</div>
@endif

<div class="bg-white rounded-lg shadow max-w-2xl">
    <form action="{{ $isEdit ? route('transaksi.update', $item->id_transaksi) : route('transaksi.store') }}" method="POST" class="p-6 space-y-4">
        @csrf
        @if($isEdit) @method('PUT') @endif
        <div>
            <label class="block text-sm font-medium mb-1">Pelanggan</label>
            <select name="id_pelanggan" required class="w-full border rounded p-2">
                <option value="">-- Pilih --</option>
                @foreach($pelanggan as $p)
                    <option value="{{ $p->id_pelanggan }}" {{ old('id_pelanggan', $item->id_pelanggan ?? '') == $p->id_pelanggan ? 'selected' : '' }}>{{ $p->nama }} - {{ $p->nik }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Kendaraan (Tersedia)</label>
            <select name="id_kendaraan" id="selKendaraan" required class="w-full border rounded p-2">
                <option value="" data-harga="0">-- Pilih --</option>
                @foreach($kendaraan as $k)
                    <option value="{{ $k->id_kendaraan }}" data-harga="{{ $k->harga_sewa }}" {{ old('id_kendaraan', $item->id_kendaraan ?? '') == $k->id_kendaraan ? 'selected' : '' }}>
                        {{ $k->nama_kendaraan }} ({{ $k->merk }}) - Rp {{ number_format($k->harga_sewa, 0, ',', '.') }}/hari
                    </option>
                @endforeach
            </select>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Tanggal Sewa</label>
                <input type="date" name="tgl_sewa" value="{{ old('tgl_sewa', $item->tgl_sewa ?? date('Y-m-d')) }}" required class="w-full border rounded p-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Lama Sewa (hari)</label>
                <input type="number" name="lama_sewa" id="inpLama" value="{{ old('lama_sewa', $item->lama_sewa ?? 1) }}" required min="1" class="w-full border rounded p-2">
            </div>
        </div>
        @if($isEdit)
            <div>
                <label class="block text-sm font-medium mb-1">Status Pembayaran</label>
                <select name="status_pembayaran" required class="w-full border rounded p-2">
                    <option value="belum" {{ old('status_pembayaran', $item->status_pembayaran) === 'belum' ? 'selected' : '' }}>Belum Lunas</option>
                    <option value="lunas" {{ old('status_pembayaran', $item->status_pembayaran) === 'lunas' ? 'selected' : '' }}>Lunas</option>
                </select>
            </div>
        @endif
        <div class="bg-green-50 border-l-4 border-green-400 p-3 text-sm">
            <i class="bi bi-calculator mr-1"></i>Estimasi Total: <span class="font-bold text-lg" id="estTotal">Rp 0</span>
        </div>
        <div class="flex justify-end space-x-2 pt-2 border-t">
            <a href="{{ route('transaksi.index') }}" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 rounded">Batal</a>
            <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded" {{ !$isEdit && ($pelanggan->isEmpty() || $kendaraan->isEmpty()) ? 'disabled' : '' }}><i class="bi bi-check-lg mr-1"></i>{{ $isEdit ? 'Update' : 'Buat' }} Transaksi</button>
        </div>
    </form>
</div>

<script>
    const sel = document.getElementById('selKendaraan');
    const inp = document.getElementById('inpLama');
    const est = document.getElementById('estTotal');
    function hitung() {
        const harga = parseFloat(sel.options[sel.selectedIndex]?.dataset.harga || 0);
        const lama = parseInt(inp.value || 0);
        est.textContent = 'Rp ' + (harga * lama).toLocaleString('id-ID');
    }
    sel.addEventListener('change', hitung);
    inp.addEventListener('input', hitung);
    hitung();
</script>
@endsection
