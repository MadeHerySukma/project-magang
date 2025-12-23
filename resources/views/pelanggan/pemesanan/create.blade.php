<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan - {{ $mobil->merek }} {{ $mobil->model }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        .animate-slideIn {
            animation: slideIn 0.3s ease-out;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar - Compact -->
    <!-- Navbar Pelanggan - RESPONSIVE dengan Mobile Menu -->
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
            <!-- Error Messages - Compact -->
            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-3 mb-4 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-xs font-semibold">{{ session('error') }}</p>
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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <!-- LEFT: Info Mobil - Compact -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
                        <div class="flex items-center mb-3">
                            <div class="bg-blue-900 p-1 rounded mr-2">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-gray-900">Mobil Dipilih</h3>
                        </div>
                        
                        @php
                            $foto = $mobil->foto_depan ?? $mobil->foto_belakang ?? $mobil->foto_interior;
                        @endphp
                        
                        <div class="mb-3 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-lg overflow-hidden border-2 border-white">
                            @if($foto)
                                <img src="{{ asset('storage/' . $foto) }}" alt="{{ $mobil->model }}" class="w-full h-36 object-contain p-2">
                            @else
                                <div class="w-full h-36 flex items-center justify-center text-white">
                                    <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <h4 class="text-xl font-bold text-gray-900 mb-0.5">{{ $mobil->merek }}</h4>
                        <p class="text-sm text-gray-600 mb-3">{{ $mobil->model }}</p>

                        <div class="space-y-2 text-xs border-t border-gray-200 pt-3 mb-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 font-semibold">Jenis</span>
                                <span class="px-2 py-0.5 bg-blue-100 text-blue-800 rounded font-bold">{{ $mobil->jenis }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 font-semibold">Tahun</span>
                                <span class="px-2 py-0.5 bg-indigo-100 text-indigo-800 rounded font-bold">{{ $mobil->tahun }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 font-semibold">Plat</span>
                                <span class="px-2 py-0.5 bg-gray-100 text-gray-800 rounded font-bold">{{ $mobil->nomor_plat }}</span>
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg p-3 mb-3">
                            <p class="text-blue-100 text-xs font-semibold mb-0.5">Harga Sewa/Hari</p>
                            <p class="text-2xl font-bold text-white">{{ $mobil->harga_format }}</p>
                        </div>

                        <!-- Preview Total -->
                        <div id="totalPreview" class="hidden bg-gradient-to-r from-green-600 to-green-700 rounded-lg p-3">
                            <p class="text-green-100 text-xs font-semibold mb-0.5">Estimasi Total</p>
                            <p class="text-xs text-green-100 mb-1">
                                <span id="durasiText" class="font-bold">0 hari</span> × {{ $mobil->harga_format }}
                            </p>
                            <p class="text-2xl font-bold text-white" id="totalHarga">Rp 0</p>
                        </div>
                    </div>
                </div>

                <!-- RIGHT: Form -->
                <div class="lg:col-span-2">
                    <form id="formPemesanan" method="POST" action="{{ route('pelanggan.pemesanan.store') }}" enctype="multipart/form-data" class="space-y-4" novalidate>
                        @csrf
                        <input type="hidden" name="mobil_id" value="{{ $mobil->id }}">

                        <!-- Tanggal Sewa -->
                        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
                            <div class="flex items-center mb-3">
                                <div class="bg-blue-900 p-1 rounded mr-2">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <h3 class="text-sm font-bold text-gray-900">Pilih Tanggal Sewa</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-gray-900 font-bold mb-1 text-xs">
                                        Tanggal Mulai <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="tanggal_mulai" id="tanggalMulai" required
                                        value="{{ old('tanggal_mulai') }}"
                                        min="{{ date('Y-m-d') }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div>
                                    <label class="block text-gray-900 font-bold mb-1 text-xs">
                                        Tanggal Selesai <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="tanggal_selesai" id="tanggalSelesai" required
                                        value="{{ old('tanggal_selesai') }}"
                                        min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>

                            <div class="bg-blue-50 rounded-lg p-2 mt-3">
                                <p class="text-xs text-blue-800 font-semibold">
                                    <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                    </svg>
                                    Minimal pemesanan 1 hari
                                </p>
                            </div>
                        </div>

                        <!-- Data Diri -->
                        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
                            <div class="flex items-center mb-3">
                                <div class="bg-blue-900 p-1 rounded mr-2">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <h3 class="text-sm font-bold text-gray-900">Data Penyewa</h3>
                            </div>

                            <div class="space-y-3">
                                <div>
                                    <label class="block text-gray-900 font-bold mb-1 text-xs">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="nama_lengkap" required
                                        value="{{ old('nama_lengkap', auth()->user()->name) }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Nama sesuai KTP">
                                </div>

                                <div>
                                    <label class="block text-gray-900 font-bold mb-1 text-xs">
                                        NIK (16 digit) <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="nik" required maxlength="16" pattern="[0-9]{16}"
                                        value="{{ old('nik') }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="16 digit NIK">
                                </div>

                                 <div>
                                    <label for="no_telepon" class="block text-gray-900 font-bold mb-1 text-xs">
                                        Nomor Telepon Utama <span class="text-red-500">*</span>
                                    </label>
                                    <small class="block text-gray-600 text-xs mt-0 mb-1">
                                        📱 No. WhatsApp yang terdaftar saat registrasi (untuk konfirmasi admin)
                                    </small>
                                    <input type="tel" name="no_telepon" id="no_telepon" required pattern="[0-9]+"
                                        value="{{ old('no_telepon', auth()->user()->no_hp) }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-blue-50"
                                        placeholder="08xxxxxxxxxx"
                                        readonly>
                                    <small class="block text-blue-600 text-xs mt-1 font-semibold">
                                        ✓ Nomor ini akan digunakan untuk notifikasi WhatsApp dari admin
                                    </small>
                                </div>

                                <!-- NOMOR TELEPON ALTERNATIF (OPSIONAL) -->
                                <div class="bg-yellow-50 border-2 border-yellow-300 rounded-lg p-3">
                                    <label for="no_telepon_alternatif" class="block text-gray-900 font-bold mb-1 text-xs">
                                        📞 Nomor Telepon Lain (Opsional)
                                    </label>
                                    <small class="block text-gray-600 text-xs mt-0 mb-2">
                                        Isi jika ingin dihubungi di nomor lain (keluarga/teman). Admin akan punya pilihan untuk menghubungi nomor ini jika nomor utama tidak aktif.
                                    </small>
                                    <input type="tel" name="no_telepon_alternatif" id="no_telepon_alternatif" pattern="[0-9]+"
                                        value="{{ old('no_telepon_alternatif') }}"
                                        class="w-full px-3 py-2 border border-yellow-400 rounded-lg text-sm focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                                        placeholder="08xxxxxxxxxx (optional)">
                                    <small class="text-yellow-700 text-xs mt-1 font-semibold flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                        </svg>
                                        Kosongkan jika tidak ada nomor lain
                                    </small>
                                </div>

                                <div>
                                    <label class="block text-gray-900 font-bold mb-1 text-xs">
                                        Alamat Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <textarea name="alamat" required rows="2"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Alamat lengkap">{{ old('alamat') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Upload KTP & Catatan - Side by Side -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Upload KTP -->
                            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
                                <div class="flex items-center mb-3">
                                    <div class="bg-blue-900 p-1 rounded mr-2">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-bold text-gray-900">Upload KTP</h3>
                                </div>

                                <div class="border-2 border-dashed border-blue-300 rounded-lg p-3 text-center bg-blue-50">
                                    <input type="file" name="foto_ktp" id="fotoKtp" accept="image/*" required class="hidden" onchange="previewKTP(event)">
                                    
                                    <div id="ktpPreview" class="hidden mb-2">
                                        <img id="ktpImage" class="max-w-full h-32 mx-auto rounded-lg border-2 border-white">
                                    </div>

                                    <label for="fotoKtp" class="cursor-pointer block">
                                        <div class="bg-blue-600 p-3 rounded-lg mb-2 inline-block">
                                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <p class="text-xs font-bold text-blue-900">Klik untuk upload</p>
                                        <p class="text-xs text-gray-600 mt-0.5">JPG/PNG (Max 2MB)</p>
                                    </label>
                                </div>

                                <div class="bg-yellow-50 rounded-lg p-2 mt-3">
                                    <p class="text-xs text-yellow-800 font-semibold">
                                        <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        Foto KTP harus jelas
                                    </p>
                                </div>
                            </div>

                            <!-- Catatan -->
                            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
                                <div class="flex items-center mb-3">
                                    <div class="bg-gray-600 p-1 rounded mr-2">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-bold text-gray-900">Catatan (Opsional)</h3>
                                </div>
                                <textarea name="catatan" rows="7"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Catatan atau permintaan khusus...">{{ old('catatan') }}</textarea>
                            </div>
                        </div>

                        <!-- Terms & Submit -->
                        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
                            <div class="mb-4">
                                <label class="flex items-start cursor-pointer">
                                    <input type="checkbox" required class="mt-0.5 mr-2 w-4 h-4">
                                    <span class="text-xs text-gray-800 font-semibold">
                                        Saya setuju dengan <a href="#" class="text-blue-600 font-bold hover:underline">syarat dan ketentuan</a> penyewaan mobil
                                    </span>
                                </label>
                            </div>

                            <div class="flex gap-3">
                                <a href="/pelanggan/mobil/{{ $mobil->id }}" 
                                    class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-4 py-3 rounded-lg text-sm font-bold text-center transition flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                    Batal
                                </a>
                                <button type="submit" 
                                    class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-3 rounded-lg text-sm font-bold transition flex items-center justify-center">
                                    Lanjut ke Pembayaran
                                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Alert Box -->
    <div id="customAlert" class="hidden fixed top-4 right-4 z-50 animate-slideIn">
        <div class="bg-red-600 text-white px-4 py-3 rounded-lg shadow-2xl flex items-center space-x-2 max-w-md">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            <div>
                <p class="font-bold text-sm">Peringatan!</p>
                <p id="alertMessage" class="text-xs"></p>
            </div>
            <button onclick="closeAlert()" class="ml-2 text-white hover:text-gray-200 font-bold text-xl">×</button>
        </div>
    </div>

    <script>
        let fotoKtpUploaded = false;

        function previewKTP(event) {
            const file = event.target.files[0];
            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    showCustomAlert('Ukuran file terlalu besar! Maksimal 2MB.');
                    event.target.value = '';
                    fotoKtpUploaded = false;
                    return;
                }

                if (!file.type.match('image.*')) {
                    showCustomAlert('File harus berupa gambar (JPG, PNG)!');
                    event.target.value = '';
                    fotoKtpUploaded = false;
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('ktpImage').src = e.target.result;
                    document.getElementById('ktpPreview').classList.remove('hidden');
                    fotoKtpUploaded = true;
                }
                reader.readAsDataURL(file);
            }
        }

        const hargaPerHari = {{ $mobil->harga_sewa }};
        const tanggalMulai = document.getElementById('tanggalMulai');
        const tanggalSelesai = document.getElementById('tanggalSelesai');

        function hitungTotal() {
            if (tanggalMulai.value && tanggalSelesai.value) {
                const mulai = new Date(tanggalMulai.value);
                const selesai = new Date(tanggalSelesai.value);
                
                if (selesai >= mulai) {
                    const hariDiff = Math.ceil((selesai - mulai) / (1000 * 60 * 60 * 24));
                    const durasi = Math.max(1, hariDiff);
                    const total = durasi * hargaPerHari;
                    
                    document.getElementById('durasiText').textContent = durasi + ' hari';
                    document.getElementById('totalHarga').textContent = 
                        'Rp ' + total.toLocaleString('id-ID');
                    document.getElementById('totalPreview').classList.remove('hidden');
                } else {
                    document.getElementById('totalPreview').classList.add('hidden');
                }
            }
        }

        tanggalMulai.addEventListener('change', function() {
            tanggalSelesai.min = this.value;
            hitungTotal();
        });

        tanggalSelesai.addEventListener('change', hitungTotal);

        function showCustomAlert(message) {
            const alertBox = document.getElementById('customAlert');
            const alertMessage = document.getElementById('alertMessage');
            
            alertMessage.textContent = message;
            alertBox.classList.remove('hidden');
            
            setTimeout(() => {
                closeAlert();
            }, 5000);
        }

        function closeAlert() {
            document.getElementById('customAlert').classList.add('hidden');
        }

        document.getElementById('formPemesanan').addEventListener('submit', function(e) {
            if (!tanggalMulai.value) {
                e.preventDefault();
                showCustomAlert('Tanggal mulai sewa belum dipilih!');
                tanggalMulai.scrollIntoView({ behavior: 'smooth', block: 'center' });
                tanggalMulai.focus();
                return false;
            }

            if (!tanggalSelesai.value) {
                e.preventDefault();
                showCustomAlert('Tanggal selesai sewa belum dipilih!');
                tanggalSelesai.scrollIntoView({ behavior: 'smooth', block: 'center' });
                tanggalSelesai.focus();
                return false;
            }

            const namaLengkap = document.querySelector('input[name="nama_lengkap"]');
            if (!namaLengkap.value.trim()) {
                e.preventDefault();
                showCustomAlert('Nama lengkap belum diisi!');
                namaLengkap.scrollIntoView({ behavior: 'smooth', block: 'center' });
                namaLengkap.focus();
                return false;
            }

            const nik = document.querySelector('input[name="nik"]');
            if (!nik.value.trim()) {
                e.preventDefault();
                showCustomAlert('NIK belum diisi!');
                nik.scrollIntoView({ behavior: 'smooth', block: 'center' });
                nik.focus();
                return false;
            }
            if (nik.value.length !== 16) {
                e.preventDefault();
                showCustomAlert('NIK harus 16 digit!');
                nik.scrollIntoView({ behavior: 'smooth', block: 'center' });
                nik.focus();
                return false;
            }
            if (!/^[0-9]+$/.test(nik.value)) {
                e.preventDefault();
                showCustomAlert('NIK hanya boleh berisi angka!');
                nik.scrollIntoView({ behavior: 'smooth', block: 'center' });
                nik.focus();
                return false;
            }

            const noTelepon = document.querySelector('input[name="no_telepon"]');
            if (!noTelepon.value.trim()) {
                e.preventDefault();
                showCustomAlert('Nomor telepon belum diisi!');
                noTelepon.scrollIntoView({ behavior: 'smooth', block: 'center' });
                noTelepon.focus();
                return false;
            }
            if (!/^[0-9]+$/.test(noTelepon.value)) {
                e.preventDefault();
                showCustomAlert('Nomor telepon hanya boleh berisi angka!');
                noTelepon.scrollIntoView({ behavior: 'smooth', block: 'center' });
                noTelepon.focus();
                return false;
            }

            const alamat = document.querySelector('textarea[name="alamat"]');
            if (!alamat.value.trim()) {
                e.preventDefault();
                showCustomAlert('Alamat lengkap belum diisi!');
                alamat.scrollIntoView({ behavior: 'smooth', block: 'center' });
                alamat.focus();
                return false;
            }

            if (!fotoKtpUploaded) {
                e.preventDefault();
                showCustomAlert('Foto KTP belum diupload!');
                document.getElementById('fotoKtp').scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'center' 
                });
                return false;
            }

            const checkbox = document.querySelector('input[type="checkbox"]');
            if (!checkbox.checked) {
                e.preventDefault();
                showCustomAlert('Anda belum menyetujui syarat dan ketentuan!');
                checkbox.scrollIntoView({ behavior: 'smooth', block: 'center' });
                checkbox.focus();
                return false;
            }

            return true;
        });
    </script>
</body>
</html>