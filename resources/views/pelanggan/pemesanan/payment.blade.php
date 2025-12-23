<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - #{{ str_pad($pemesanan->id, 6, '0', STR_PAD_LEFT) }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .payment-card {
            transition: all 0.2s ease;
        }
        
        .payment-card:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar - Compact -->
    <nav class="bg-gradient-to-r from-blue-900 to-blue-800 text-white shadow-lg sticky top-0 z-50">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="flex justify-between items-center py-3">
            <!-- Logo & Brand -->
            <div class="flex items-center space-x-2">
                <div class="bg-blue-500 p-1.5 rounded-lg">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                    </svg>
                </div>
                <h1 class="text-base sm:text-lg font-bold">Form Pemesanan</h1>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center space-x-3">
                @if(request()->routeIs('pelanggan.dashboard'))
                    <a href="{{ route('pelanggan.dashboard') }}" 
                       class="text-white bg-blue-700 px-3 py-1.5 rounded-lg font-semibold text-sm transition">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('pelanggan.dashboard') }}" 
                       class="hover:text-blue-200 text-sm font-medium transition">
                        Dashboard
                    </a>
                @endif

                @if(request()->routeIs('pelanggan.mobil.*'))
                    <a href="{{ route('pelanggan.mobil.index') }}" 
                       class="text-white bg-blue-700 px-3 py-1.5 rounded-lg font-semibold text-sm transition">
                        Cari Mobil
                    </a>
                @else
                    <a href="{{ route('pelanggan.mobil.index') }}" 
                       class="hover:text-blue-200 text-sm font-medium transition">
                        Cari Mobil
                    </a>
                @endif

                @if(request()->routeIs('pelanggan.pemesanan.*'))
                    <a href="{{ route('pelanggan.pemesanan.index') }}" 
                       class="text-white bg-blue-700 px-3 py-1.5 rounded-lg font-semibold text-sm transition">
                        Pesanan Saya
                    </a>
                @else
                    <a href="{{ route('pelanggan.pemesanan.index') }}" 
                       class="hover:text-blue-200 text-sm font-medium transition">
                        Pesanan Saya
                    </a>
                @endif

                <!-- Desktop User Dropdown -->
                <div class="relative pl-3 border-l border-blue-700">
                    <button id="userDropdownBtnPelanggan" class="flex items-center space-x-2 hover:bg-blue-700 px-3 py-1.5 rounded-lg transition">
                        <div class="bg-blue-700 p-1.5 rounded-full">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold">{{ auth()->user()->name }}</p>
                        </div>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    <!-- Dropdown Menu Desktop -->
                    <div id="userDropdownMenuPelanggan" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50">
                        <a href="/" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 transition">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                <span>Ke Home</span>
                            </div>
                        </a>
                        <div class="border-t border-gray-100"></div>
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    <span>Logout</span>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Mobile Menu Button -->
            <button id="mobileMenuBtnPelanggan" class="lg:hidden text-white focus:outline-none">
                <svg id="menuOpenIconPelanggan" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="menuCloseIconPelanggan" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenuPelanggan" class="hidden lg:hidden pb-4">
            <div class="flex flex-col space-y-2">
                @if(request()->routeIs('pelanggan.dashboard'))
                    <a href="{{ route('pelanggan.dashboard') }}" 
                       class="text-white bg-blue-700 px-4 py-2 rounded-lg font-semibold text-sm">
                        🏠 Dashboard
                    </a>
                @else
                    <a href="{{ route('pelanggan.dashboard') }}" 
                       class="text-white hover:bg-blue-700 px-4 py-2 rounded-lg text-sm transition">
                        🏠 Dashboard
                    </a>
                @endif

                @if(request()->routeIs('pelanggan.mobil.*'))
                    <a href="{{ route('pelanggan.mobil.index') }}" 
                       class="text-white bg-blue-700 px-4 py-2 rounded-lg font-semibold text-sm">
                        🚗 Cari Mobil
                    </a>
                @else
                    <a href="{{ route('pelanggan.mobil.index') }}" 
                       class="text-white hover:bg-blue-700 px-4 py-2 rounded-lg text-sm transition">
                        🚗 Cari Mobil
                    </a>
                @endif

                @if(request()->routeIs('pelanggan.pemesanan.*'))
                    <a href="{{ route('pelanggan.pemesanan.index') }}" 
                       class="text-white bg-blue-700 px-4 py-2 rounded-lg font-semibold text-sm">
                        📦 Pesanan Saya
                    </a>
                @else
                    <a href="{{ route('pelanggan.pemesanan.index') }}" 
                       class="text-white hover:bg-blue-700 px-4 py-2 rounded-lg text-sm transition">
                        📦 Pesanan Saya
                    </a>
                @endif

                <!-- Mobile User Dropdown -->
                <div class="border-t border-blue-700 pt-3 mt-2">
                    <button id="mobileUserDropdownBtnPelanggan" class="w-full flex items-center justify-between px-4 py-2 text-white hover:bg-blue-700 rounded-lg transition">
                        <div class="flex items-center space-x-2">
                            <div class="bg-blue-700 p-1.5 rounded-full">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold">{{ auth()->user()->name }}</p>
                                <p class="text-blue-200 text-xs">Pelanggan</p>
                            </div>
                        </div>
                        <svg id="mobileDropdownIconPelanggan" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    <!-- Mobile Dropdown Content -->
                    <div id="mobileUserDropdownMenuPelanggan" class="hidden mt-2 space-y-2">
                        <a href="/" class="flex items-center space-x-2 px-4 py-2 text-white hover:bg-blue-700 rounded-lg text-sm transition ml-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            <span>Ke Home</span>
                        </a>
                        <form method="POST" action="/logout" class="ml-4">
                            @csrf
                            <button type="submit" class="w-full flex items-center space-x-2 px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg text-sm font-semibold transition text-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    // Mobile menu toggle
    const mobileMenuBtnPelanggan = document.getElementById('mobileMenuBtnPelanggan');
    const mobileMenuPelanggan = document.getElementById('mobileMenuPelanggan');
    const menuOpenIconPelanggan = document.getElementById('menuOpenIconPelanggan');
    const menuCloseIconPelanggan = document.getElementById('menuCloseIconPelanggan');

    if (mobileMenuBtnPelanggan) {
        mobileMenuBtnPelanggan.addEventListener('click', function() {
            mobileMenuPelanggan.classList.toggle('hidden');
            menuOpenIconPelanggan.classList.toggle('hidden');
            menuCloseIconPelanggan.classList.toggle('hidden');
        });
    }

    // Desktop user dropdown
    const userDropdownBtnPelanggan = document.getElementById('userDropdownBtnPelanggan');
    const userDropdownMenuPelanggan = document.getElementById('userDropdownMenuPelanggan');

    if (userDropdownBtnPelanggan) {
        userDropdownBtnPelanggan.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdownMenuPelanggan.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userDropdownBtnPelanggan.contains(e.target) && !userDropdownMenuPelanggan.contains(e.target)) {
                userDropdownMenuPelanggan.classList.add('hidden');
            }
        });
    }

    // Mobile user dropdown
    const mobileUserDropdownBtnPelanggan = document.getElementById('mobileUserDropdownBtnPelanggan');
    const mobileUserDropdownMenuPelanggan = document.getElementById('mobileUserDropdownMenuPelanggan');
    const mobileDropdownIconPelanggan = document.getElementById('mobileDropdownIconPelanggan');

    if (mobileUserDropdownBtnPelanggan) {
        mobileUserDropdownBtnPelanggan.addEventListener('click', function(e) {
            e.stopPropagation();
            mobileUserDropdownMenuPelanggan.classList.toggle('hidden');
            mobileDropdownIconPelanggan.classList.toggle('rotate-180');
        });
    }
</script>

    <div class="container mx-auto px-6 py-4">
        <div class="max-w-6xl mx-auto">
            <!-- Messages - Compact -->
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-3 mb-4 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-xs font-semibold">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-3 mb-4 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-4 h-4 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <p class="font-bold text-xs mb-1">Error:</p>
                            <ul class="list-disc list-inside space-y-0.5">
                                @foreach($errors->all() as $error)
                                    <li class="text-xs">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Countdown Timer - Super Compact -->
            @if($pemesanan->status === 'pending' && $pemesanan->expired_at)
            <div id="countdown-alert" class="bg-gradient-to-r from-red-600 to-orange-600 text-white rounded-lg p-3 mb-4 flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <svg class="w-6 h-6 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h3 class="font-bold text-sm">⏰ Selesaikan Pembayaran</h3>
                        <p class="text-xs opacity-90">Pemesanan akan dibatalkan otomatis</p>
                    </div>
                </div>
                <div class="text-center">
                    <p class="text-xs opacity-90 font-bold mb-0.5">SISA WAKTU</p>
                    <div id="countdown" class="text-2xl font-bold font-mono bg-white bg-opacity-20 px-3 py-1 rounded-lg">15:00</div>
                </div>
            </div>
            @endif

            <!-- Main Grid: 3 Columns -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <!-- LEFT: Ringkasan (1 col) -->
                <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
                    <div class="flex items-center mb-3">
                        <div class="bg-blue-900 p-1 rounded mr-2">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-sm font-bold text-gray-900">Ringkasan Pemesanan</h3>
                    </div>
                    
                    <div class="bg-blue-50 rounded-lg p-2 mb-3">
                        <p class="text-xs text-blue-800 font-bold mb-0.5">Kode Pemesanan</p>
                        <p class="font-bold text-lg text-blue-900">#{{ str_pad($pemesanan->id, 6, '0', STR_PAD_LEFT) }}</p>
                    </div>

                    <div class="space-y-2 mb-3">
                        <div class="bg-gray-50 rounded p-2">
                            <p class="text-xs text-gray-600 font-bold mb-0.5">Mobil</p>
                            <p class="font-bold text-xs text-gray-900">{{ $pemesanan->mobil->merek }} {{ $pemesanan->mobil->model }}</p>
                        </div>
                        <div class="bg-gray-50 rounded p-2">
                            <p class="text-xs text-gray-600 font-bold mb-0.5">Periode Sewa</p>
                            <p class="text-xs font-semibold text-gray-900">{{ $pemesanan->tanggal_mulai->format('d M') }} - {{ $pemesanan->tanggal_selesai->format('d M Y') }}</p>
                            <p class="text-xs text-gray-700 font-bold mt-0.5">{{ $pemesanan->durasi }} Hari</p>
                        </div>
                        <div class="bg-gray-50 rounded p-2">
                            <p class="text-xs text-gray-600 font-bold mb-0.5">Penyewa</p>
                            <p class="text-xs font-semibold text-gray-900">{{ $pemesanan->nama_lengkap }}</p>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-3">
                        <div class="flex justify-between text-xs mb-2">
                            <span class="text-gray-600">Harga/Hari</span>
                            <span class="font-bold text-gray-900">{{ $pemesanan->harga_per_hari_format }}</span>
                        </div>
                        <div class="flex justify-between text-xs mb-3">
                            <span class="text-gray-600">Durasi</span>
                            <span class="font-bold text-gray-900">× {{ $pemesanan->durasi }} hari</span>
                        </div>
                        <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-lg p-3">
                            <p class="text-green-100 text-xs font-bold mb-0.5">TOTAL BAYAR</p>
                            <p class="text-2xl font-bold text-white">{{ $pemesanan->total_harga_format }}</p>
                        </div>
                    </div>
                </div>

                <!-- MIDDLE & RIGHT: Form (2 cols) -->
                <div class="lg:col-span-2">
                    <form method="POST" action="{{ route('pelanggan.pemesanan.upload-bukti', $pemesanan->id) }}" enctype="multipart/form-data" id="payment-form">
                        @csrf

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
                            <!-- Metode Pembayaran -->
                            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
                                <div class="flex items-center mb-3">
                                    <div class="bg-blue-900 p-1 rounded mr-2">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                            <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-bold text-gray-900">Pilih Metode</h3>
                                </div>

                                <div class="space-y-1.5 max-h-64 overflow-y-auto pr-1">
                                    @forelse($metodePembayarans as $metode)
                                        <label class="block cursor-pointer">
                                            <div class="border border-gray-200 hover:border-blue-500 hover:bg-blue-50 rounded-lg p-2 transition">
                                                <input type="radio" name="metode_pembayaran" value="{{ $metode->kode }}" 
                                                    class="mr-2" onchange="showPaymentInfo('{{ $metode->kode }}')">
                                                <span class="font-bold text-xs">{{ $metode->icon }} {{ $metode->nama_metode }}</span>
                                            </div>
                                        </label>
                                    @empty
                                        <p class="text-gray-500 text-xs">Tidak ada metode tersedia.</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Upload Bukti -->
                            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
                                <div class="flex items-center mb-3">
                                    <div class="bg-blue-900 p-1 rounded mr-2">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-bold text-gray-900">Upload Bukti</h3>
                                </div>

                                <div class="border-2 border-dashed border-blue-300 rounded-lg p-3 text-center bg-blue-50">
                                    <input type="file" name="bukti_pembayaran" id="buktiBayar" accept="image/*" class="hidden" onchange="previewBukti(event)">
                                    
                                    <div id="buktiPreview" class="hidden mb-2">
                                        <img id="buktiImage" class="max-w-full h-32 mx-auto rounded-lg border-2 border-white">
                                    </div>

                                    <label for="buktiBayar" class="cursor-pointer block">
                                        <div class="bg-blue-800 p-3 rounded-lg mb-2 inline-block">
                                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <p class="text-xs font-bold text-blue-900">Klik untuk upload</p>
                                        <p class="text-xs text-gray-600 mt-0.5">JPG/PNG (Max 2MB)</p>
                                    </label>
                                </div>

                                <div class="bg-blue-50 rounded-lg p-2 mt-3">
                                    <p class="text-xs text-blue-800 font-semibold">
                                        <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                        </svg>
                                        Pastikan bukti jelas & terbaca
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Info Pembayaran - Full Width -->
                        <div id="paymentInfo" class="hidden mb-4">
                            @foreach($metodePembayarans as $metode)
                                @php
                                    $colors = [
                                        'transfer_bca' => ['bg' => 'blue', 'from' => 'blue-600', 'to' => 'blue-700'],
                                        'transfer_bni' => ['bg' => 'orange', 'from' => 'orange-600', 'to' => 'orange-700'],
                                        'transfer_mandiri' => ['bg' => 'yellow', 'from' => 'yellow-500', 'to' => 'yellow-600'],
                                        'va_bca' => ['bg' => 'blue', 'from' => 'blue-600', 'to' => 'blue-700'],
                                        'va_bni' => ['bg' => 'orange', 'from' => 'orange-600', 'to' => 'orange-700'],
                                        'va_mandiri' => ['bg' => 'yellow', 'from' => 'yellow-500', 'to' => 'yellow-600'],
                                        'dana' => ['bg' => 'blue', 'from' => 'blue-600', 'to' => 'blue-700'],
                                        'ovo' => ['bg' => 'purple', 'from' => 'purple-600', 'to' => 'purple-700'],
                                        'gopay' => ['bg' => 'green', 'from' => 'green-600', 'to' => 'green-700'],
                                        'linkaja' => ['bg' => 'red', 'from' => 'red-600', 'to' => 'red-700'],
                                        'shopeepay' => ['bg' => 'orange', 'from' => 'orange-600', 'to' => 'orange-700'],
                                    ];
                                    
                                    $color = $colors[$metode->kode] ?? ['bg' => 'gray', 'from' => 'gray-600', 'to' => 'gray-700'];
                                    
                                    $nomorRekening = $metode->nomor_rekening;
                                    if (str_starts_with($metode->kode, 'va_')) {
                                        $nomorRekening .= str_pad($pemesanan->id, 8, '0', STR_PAD_LEFT);
                                    }
                                @endphp

                                <div id="info-{{ $metode->kode }}" class="hidden bg-white rounded-lg shadow-md border border-{{ $color['bg'] }}-200 p-4">
                                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                                        <!-- Payment Details (2 cols) -->
                                        <div class="lg:col-span-2">
                                            <h4 class="text-base font-bold text-{{ $color['bg'] }}-900 mb-3 flex items-center">
                                                <span class="text-xl mr-2">{{ $metode->icon }}</span> {{ $metode->nama_metode }}
                                            </h4>
                                            <div class="bg-gradient-to-r from-{{ $color['from'] }} to-{{ $color['to'] }} rounded-lg p-4 text-white">
                                                <p class="text-xs opacity-90 font-bold mb-1.5">
                                                    @if($metode->tipe === 'bank')
                                                        {{ str_starts_with($metode->kode, 'va_') ? 'Virtual Account' : 'No. Rekening' }}
                                                    @else
                                                        Nomor {{ $metode->nama_penerima }}
                                                    @endif
                                                </p>
                                                <div class="flex items-center justify-between bg-white rounded-lg p-2.5 mb-2">
                                                    <p class="text-xl font-bold text-{{ $color['bg'] }}-900">{{ $nomorRekening }}</p>
                                                    <button type="button" onclick="copyToClipboard('{{ $nomorRekening }}')" 
                                                        class="bg-{{ $color['bg'] }}-600 hover:bg-{{ $color['bg'] }}-700 text-white px-3 py-1.5 rounded text-xs font-bold">
                                                        <svg class="w-3 h-3 inline mr-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M8 2a1 1 0 000 2h2a1 1 0 100-2H8z"/>
                                                            <path d="M3 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v6h-4.586l1.293-1.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L10.414 13H15v3a2 2 0 01-2 2H5a2 2 0 01-2-2V5zM15 11h2a1 1 0 110 2h-2v-2z"/>
                                                        </svg>
                                                        Salin
                                                    </button>
                                                </div>
                                                <div class="flex justify-between items-center">
                                                    <div>
                                                        <p class="text-xs opacity-90 font-bold">Atas Nama</p>
                                                        <p class="font-bold text-sm">{{ $metode->atas_nama }}</p>
                                                    </div>
                                                    @if(str_starts_with($metode->kode, 'va_'))
                                                        <span class="text-xs bg-white bg-opacity-20 px-2 py-1 rounded">VA Khusus</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Instructions (1 col) -->
                                        <div class="bg-blue-50 rounded-lg p-3">
                                            <h5 class="text-xs font-bold text-blue-900 mb-2 flex items-center">
                                                <svg class="w-4 h-4 mr-1 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                                </svg>
                                                Langkah Pembayaran
                                            </h5>
                                            <ol class="list-decimal list-inside space-y-1 text-xs text-gray-700">
                                                <li>Transfer sesuai nominal</li>
                                                <li>Simpan bukti transfer</li>
                                                <li>Upload bukti di samping</li>
                                                <li>Tunggu konfirmasi admin</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" 
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-900 hover:to-teal-800 text-white px-6 py-3 rounded-lg font-bold text-base transition shadow-lg hover:shadow-xl flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Konfirmasi Pembayaran
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showPaymentInfo(method) {
            document.getElementById('paymentInfo').classList.remove('hidden');
            
            const allInfoDivs = document.querySelectorAll('[id^="info-"]');
            allInfoDivs.forEach(div => {
                div.classList.add('hidden');
            });
            
            const selectedInfo = document.getElementById('info-' + method);
            if (selectedInfo) {
                selectedInfo.classList.remove('hidden');
            }
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('✅ Nomor berhasil disalin!');
            });
        }

        function previewBukti(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('buktiImage').src = e.target.result;
                    document.getElementById('buktiPreview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        @if($pemesanan->status === 'pending' && $pemesanan->expired_at)
        (function() {
            const expiredAt = new Date("{{ $pemesanan->expired_at->toIso8601String() }}").getTime();
            const countdownElement = document.getElementById('countdown');
            const countdownAlert = document.getElementById('countdown-alert');
            const paymentForm = document.getElementById('payment-form');
            
            let isSubmittingForm = false;

            if (paymentForm) {
                paymentForm.addEventListener('submit', function() {
                    isSubmittingForm = true;
                    window.removeEventListener('beforeunload', preventNavigation);
                });
            }

            function updateCountdown() {
                const now = new Date().getTime();
                const distance = expiredAt - now;

                if (distance < 0) {
                    countdownElement.innerHTML = "00:00";
                    countdownAlert.classList.remove('from-red-600', 'to-orange-600', 'from-orange-600', 'to-red-600');
                    countdownAlert.classList.add('from-gray-600', 'to-gray-700');
                    
                    if (paymentForm) {
                        const formElements = paymentForm.querySelectorAll('input, button, label');
                        formElements.forEach(el => {
                            el.disabled = true;
                        });
                    }
                    
                    window.removeEventListener('beforeunload', preventNavigation);
                    
                    setTimeout(() => {
                        window.location.href = "{{ route('pelanggan.pemesanan.index') }}";
                    }, 3000);
                    
                    clearInterval(countdownInterval);
                    return;
                }

                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                countdownElement.innerHTML = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                if (minutes < 5 && minutes >= 3) {
                    countdownAlert.classList.remove('from-red-600', 'to-orange-600');
                    countdownAlert.classList.add('from-orange-600', 'to-red-600');
                }

                if (minutes < 3) {
                    countdownAlert.classList.remove('from-orange-600', 'to-red-600');
                    countdownAlert.classList.add('from-red-600', 'to-red-700');
                    countdownElement.classList.add('animate-pulse');
                }
            }

            function preventNavigation(e) {
                if (isSubmittingForm) return;
                if (countdownElement && countdownElement.innerHTML !== "00:00") {
                    e.preventDefault();
                    e.returnValue = '';
                    return '';
                }
            }

            updateCountdown();
            const countdownInterval = setInterval(updateCountdown, 1000);
            window.addEventListener('beforeunload', preventNavigation);
        })();
        @endif
    </script>
</body>
</html>