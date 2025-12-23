<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $mobil->merek }} {{ $mobil->model }} - PT Rental Mobil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .thumbnail-active {
            border-color: #1e40af !important;
            transform: scale(1.05);
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
                <h1 class="text-base sm:text-lg font-bold">Rental Mobil</h1>
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
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                
                <!-- LEFT: IMAGE GALLERY - Compact -->
                <div class="space-y-3">
                    <!-- Main Image -->
                    <div id="mainImageContainer" class="bg-white border-2 border-blue-200 rounded-lg shadow-md overflow-hidden">
                        @php
                            $mainPhoto = $mobil->foto_depan ?? $mobil->foto_belakang ?? $mobil->foto_interior ?? $mobil->foto_samping_kiri ?? $mobil->foto_samping_kanan;
                        @endphp
                        
                        @if($mainPhoto)
                            <img id="mainImage" src="{{ asset('storage/' . $mainPhoto) }}" alt="{{ $mobil->model }}" class="w-full h-64 object-contain bg-gradient-to-br from-blue-50 to-indigo-50 p-4">
                        @else
                            <div class="w-full h-64 flex items-center justify-center bg-gradient-to-br from-blue-400 to-indigo-500">
                                <svg class="w-32 h-32 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Thumbnail Gallery -->
                    <div class="grid grid-cols-5 gap-2">
                        @if($mobil->foto_depan)
                            <div class="cursor-pointer rounded overflow-hidden border-2 border-blue-200 hover:border-blue-600 transition thumbnail-item" onclick="changeImage('{{ asset('storage/' . $mobil->foto_depan) }}', this)">
                                <img src="{{ asset('storage/' . $mobil->foto_depan) }}" class="w-full h-16 object-contain bg-gradient-to-br from-blue-50 to-indigo-50 p-1">
                                <p class="text-center text-xs py-1 bg-blue-100 text-blue-950 font-bold">Depan</p>
                            </div>
                        @endif
                        @if($mobil->foto_belakang)
                            <div class="cursor-pointer rounded overflow-hidden border-2 border-blue-200 hover:border-blue-600 transition thumbnail-item" onclick="changeImage('{{ asset('storage/' . $mobil->foto_belakang) }}', this)">
                                <img src="{{ asset('storage/' . $mobil->foto_belakang) }}" class="w-full h-16 object-contain bg-gradient-to-br from-blue-50 to-indigo-50 p-1">
                                <p class="text-center text-xs py-1 bg-blue-100 text-blue-950 font-bold">Belakang</p>
                            </div>
                        @endif
                        @if($mobil->foto_interior)
                            <div class="cursor-pointer rounded overflow-hidden border-2 border-blue-200 hover:border-blue-600 transition thumbnail-item" onclick="changeImage('{{ asset('storage/' . $mobil->foto_interior) }}', this)">
                                <img src="{{ asset('storage/' . $mobil->foto_interior) }}" class="w-full h-16 object-contain bg-gradient-to-br from-blue-50 to-indigo-50 p-1">
                                <p class="text-center text-xs py-1 bg-blue-100 text-blue-950 font-bold">Interior</p>
                            </div>
                        @endif
                        @if($mobil->foto_samping_kiri)
                            <div class="cursor-pointer rounded overflow-hidden border-2 border-blue-200 hover:border-blue-600 transition thumbnail-item" onclick="changeImage('{{ asset('storage/' . $mobil->foto_samping_kiri) }}', this)">
                                <img src="{{ asset('storage/' . $mobil->foto_samping_kiri) }}" class="w-full h-16 object-contain bg-gradient-to-br from-blue-50 to-indigo-50 p-1">
                                <p class="text-center text-xs py-1 bg-blue-100 text-blue-950 font-bold">Kiri</p>
                            </div>
                        @endif
                        @if($mobil->foto_samping_kanan)
                            <div class="cursor-pointer rounded overflow-hidden border-2 border-blue-200 hover:border-blue-600 transition thumbnail-item" onclick="changeImage('{{ asset('storage/' . $mobil->foto_samping_kanan) }}', this)">
                                <img src="{{ asset('storage/' . $mobil->foto_samping_kanan) }}" class="w-full h-16 object-contain bg-gradient-to-br from-blue-50 to-indigo-50 p-1">
                                <p class="text-center text-xs py-1 bg-blue-100 text-blue-950 font-bold">Kanan</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- RIGHT: DETAILS - Compact -->
                <div class="space-y-3">
                    <!-- Title & Plat -->
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">{{ $mobil->merek }}</h1>
                                <p class="text-base text-gray-600">{{ $mobil->model }}</p>
                            </div>
                            <div class="bg-gray-100 px-3 py-1 rounded-lg">
                                <p class="text-xs text-gray-600 font-bold">Plat</p>
                                <p class="text-sm font-bold text-gray-900">{{ $mobil->nomor_plat }}</p>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        @if($mobil->deskripsi)
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mt-3">
                            <p class="text-xs text-gray-700 leading-relaxed">{{ $mobil->deskripsi }}</p>
                        </div>
                        @endif
                    </div>

                    <!-- Spesifikasi -->
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                        <h3 class="font-bold text-gray-900 mb-3 text-sm flex items-center">
                            <div class="bg-blue-900 p-1 rounded mr-2">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            Spesifikasi
                        </h3>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="bg-blue-50 border border-blue-200 rounded p-2">
                                <p class="text-xs text-blue-700 font-bold mb-0.5">Jenis</p>
                                <p class="font-bold text-blue-950 text-sm">{{ $mobil->jenis }}</p>
                            </div>
                            <div class="bg-indigo-50 border border-indigo-200 rounded p-2">
                                <p class="text-xs text-indigo-700 font-bold mb-0.5">Tahun</p>
                                <p class="font-bold text-indigo-950 text-sm">{{ $mobil->tahun }}</p>
                            </div>
                            <div class="bg-purple-50 border border-purple-200 rounded p-2">
                                <p class="text-xs text-purple-700 font-bold mb-0.5">Merek</p>
                                <p class="font-bold text-purple-950 text-sm">{{ $mobil->merek }}</p>
                            </div>
                            <div class="bg-{{ $mobil->status == 'Tersedia' ? 'green' : 'red' }}-50 border border-{{ $mobil->status == 'Tersedia' ? 'green' : 'red' }}-200 rounded p-2">
                                <p class="text-xs text-{{ $mobil->status == 'Tersedia' ? 'green' : 'red' }}-700 font-bold mb-0.5">Status</p>
                                <p class="font-bold text-{{ $mobil->status == 'Tersedia' ? 'green' : 'red' }}-950 text-sm flex items-center">
                                    @if($mobil->status == 'Tersedia')
                                        <svg class="w-3 h-3 mr-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    @else
                                        <svg class="w-3 h-3 mr-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                        </svg>
                                    @endif
                                    {{ $mobil->status }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Harga -->
                    <div class="bg-gradient-to-r from-green-600 to-green-700 border-2 border-green-500 rounded-lg p-4 text-white">
                        <p class="text-xs text-green-100 font-bold mb-0.5">HARGA SEWA PER HARI</p>
                        <p class="text-3xl font-bold">{{ $mobil->harga_format }}</p>
                    </div>

                    <!-- Action Buttons -->
                    @if($mobil->status == 'Tersedia')
                        <div class="space-y-2">
                            <a href="{{ route('pelanggan.pemesanan.create', $mobil->id) }}" class="flex w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-3 rounded-lg text-sm font-bold transition items-center justify-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                                </svg>
                                Sewa Sekarang
                            </a>
                            <button class="flex w-full bg-white border-2 border-blue-600 text-blue-700 hover:bg-blue-50 px-4 py-3 rounded-lg text-sm font-bold transition items-center justify-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                </svg>
                                Hubungi Admin
                            </button>
                        </div>
                    @else
                        <div class="bg-red-50 border-l-4 border-red-600 p-4 rounded-lg">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-red-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <p class="font-bold text-sm text-red-950">Tidak Tersedia</p>
                                    <p class="text-red-800 text-xs font-semibold">Mobil {{ $mobil->status == 'Disewa' ? 'sedang disewa' : 'dalam perawatan' }}.</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Fasilitas -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-4">
                        <h4 class="font-bold text-gray-900 mb-3 text-sm flex items-center">
                            <svg class="w-4 h-4 text-blue-700 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            Termasuk dalam Harga
                        </h4>
                        <ul class="space-y-2 text-gray-800">
                            <li class="flex items-center bg-white rounded p-2 border border-blue-200">
                                <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-semibold text-xs">Antar-Jemput (opsional)</span>
                            </li>
                            <li class="flex items-center bg-white rounded p-2 border border-blue-200">
                                <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-semibold text-xs">Kursi untuk bayi</span>
                            </li>
                            <li class="flex items-center bg-white rounded p-2 border border-blue-200">
                                <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-semibold text-xs">Asuransi kendaraan</span>
                            </li>
                            <li class="flex items-center bg-white rounded p-2 border border-blue-200">
                                <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-semibold text-xs">Perawatan rutin</span>
                            </li>
                            <li class="flex items-center bg-white rounded p-2 border border-blue-200">
                                <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-semibold text-xs">Charger Hp portable</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function changeImage(imageUrl, thumbnail) {
            const mainImage = document.getElementById('mainImage');
            if (mainImage) {
                document.querySelectorAll('.thumbnail-item').forEach(item => {
                    item.classList.remove('thumbnail-active');
                });
                
                if (thumbnail) {
                    thumbnail.classList.add('thumbnail-active');
                }
                
                mainImage.style.opacity = '0';
                setTimeout(() => {
                    mainImage.src = imageUrl;
                    mainImage.style.transition = 'opacity 0.3s ease';
                    mainImage.style.opacity = '1';
                }, 150);
            }
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const firstThumbnail = document.querySelector('.thumbnail-item');
            if (firstThumbnail) {
                firstThumbnail.classList.add('thumbnail-active');
            }
        });
    </script>
</body>
</html>