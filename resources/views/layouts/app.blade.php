<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Kendaraan - Kelompok 4</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/[email protected]/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-slate-100 min-h-screen flex flex-col">

    <nav class="bg-gradient-to-r from-blue-700 to-indigo-700 shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center text-white">
                    <i class="fas fa-car-side text-2xl mr-2"></i>
                    <span class="font-bold text-lg">Rental Kendaraan</span>
                    <span class="ml-2 text-xs bg-white/20 px-2 py-0.5 rounded">Kelompok 4</span>
                </a>
                <div class="flex items-center space-x-1">
                    @php $aktif = fn($r) => request()->routeIs($r) ? 'bg-white/20' : 'hover:bg-white/10'; @endphp
                    <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded text-sm text-white {{ $aktif('dashboard') }}"><i class="fas fa-tachometer-alt mr-1"></i>Dashboard</a>
                    <a href="{{ route('kendaraan.index') }}" class="px-3 py-2 rounded text-sm text-white {{ $aktif('kendaraan.*') }}"><i class="fas fa-car mr-1"></i>Kendaraan</a>
                    <a href="{{ route('pelanggan.index') }}" class="px-3 py-2 rounded text-sm text-white {{ $aktif('pelanggan.*') }}"><i class="fas fa-users mr-1"></i>Pelanggan</a>
                    <a href="{{ route('transaksi.index') }}" class="px-3 py-2 rounded text-sm text-white {{ $aktif('transaksi.*') }}"><i class="fas fa-file-invoice-dollar mr-1"></i>Transaksi</a>
                    <a href="{{ route('pengembalian.index') }}" class="px-3 py-2 rounded text-sm text-white {{ $aktif('pengembalian.*') }}"><i class="fas fa-undo mr-1"></i>Pengembalian</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-8 w-full flex-1">
        @if(session('success'))
            <div class="mb-4 bg-green-50 border-l-4 border-green-500 text-green-800 p-3 rounded">
                <i class="bi bi-check-circle-fill mr-1"></i>{{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 bg-red-50 border-l-4 border-red-500 text-red-800 p-3 rounded">
                <i class="bi bi-exclamation-circle-fill mr-1"></i>{{ session('error') }}
            </div>
        @endif
        @if($errors->any())
            <div class="mb-4 bg-red-50 border-l-4 border-red-500 text-red-800 p-3 rounded text-sm">
                <strong>Validasi gagal:</strong>
                <ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="text-center text-sm text-slate-500 py-6 border-t bg-white">
        &copy; {{ date('Y') }} Rental Kendaraan - Kelompok 4
    </footer>
</body>
</html>
