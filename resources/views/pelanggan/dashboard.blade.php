<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan - PT Rental Mobil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar - SELARAS dengan semua file -->
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
                <h1 class="text-base sm:text-lg font-bold">Portal Pelanggan</h1>
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

    <!-- Main Content - COMPACT -->
    <div class="container mx-auto px-6 py-4">
        <!-- Success Message - SELARAS -->
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

        <!-- Welcome Header - COMPACT -->
        <div class="bg-gradient-to-r from-blue-900 to-blue-800 rounded-lg shadow-md p-5 text-white mb-4">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold mb-1">Selamat Datang, {{ auth()->user()->name }}! 👋</h2>
                    <p class="text-blue-200 text-sm">Nikmati pengalaman rental mobil yang mudah dan nyaman</p>
                </div>
                <div class="hidden md:block">
                    <div class="bg-blue-700 p-4 rounded-lg">
                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Account Info Card - COMPACT -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 border-2 border-blue-500 text-white rounded-lg shadow-md p-4 mb-4">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold mb-2 flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Akun Anda Aktif!
                    </h3>
                    <div class="space-y-1 text-blue-100 text-xs">
                        <p class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            <strong>Email:</strong>&nbsp;{{ auth()->user()->email }}
                        </p>
                        <p class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                            <strong>Bergabung:</strong>&nbsp;{{ auth()->user()->created_at->format('d M Y') }}
                        </p>
                    </div>
                </div>
                <div class="bg-blue-500 p-3 rounded-lg hidden md:block">
                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Quick Menu Grid - COMPACT -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <!-- Card 1: Cari Mobil -->
            <a href="/pelanggan/mobil" class="card-hover bg-white border border-blue-200 rounded-lg shadow-md p-5 cursor-pointer group">
                <div class="flex flex-col items-center text-center">
                    <div class="bg-blue-100 p-4 rounded-lg mb-3 group-hover:bg-blue-200 transition">
                        <svg class="w-10 h-10 text-blue-700" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-gray-900 mb-1">Cari Mobil</h3>
                    <p class="text-gray-600 text-xs mb-3">Lihat dan sewa mobil tersedia</p>
                    <span class="inline-flex items-center bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-2 rounded-lg text-sm font-bold transition">
                        Lihat Mobil
                        <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                </div>
            </a>

            <!-- Card 2: Pesanan Saya -->
            <a href="{{ route('pelanggan.pemesanan.index') }}" class="card-hover bg-white border border-indigo-200 rounded-lg shadow-md p-5 cursor-pointer group">
                <div class="flex flex-col items-center text-center">
                    <div class="bg-indigo-100 p-4 rounded-lg mb-3 group-hover:bg-indigo-200 transition">
                        <svg class="w-10 h-10 text-indigo-700" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-gray-900 mb-1">Pesanan Saya</h3>
                    <p class="text-gray-600 text-xs mb-3">Cek status pesanan Anda</p>
                    <span class="inline-flex items-center bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white px-4 py-2 rounded-lg text-sm font-bold transition">
                        Lihat Pesanan
                        <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                </div>
            </a>
        </div>

        <!-- Statistics Grid - COMPACT -->
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4">
            <!-- Aktivitas Card -->
            <div class="bg-white border border-blue-200 rounded-lg shadow-md p-4">
                <h3 class="text-base font-bold text-gray-900 mb-3 flex items-center">
                    <div class="bg-blue-900 p-1 rounded mr-2">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                        </svg>
                    </div>
                    Aktivitas Anda
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center border-b border-blue-200 pb-3">
                        <div class="flex items-center">
                            <div class="bg-blue-100 p-1.5 rounded mr-2">
                                <svg class="w-4 h-4 text-blue-700" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="text-gray-700 font-semibold text-sm">Total Pesanan</span>
                        </div>
                        <span class="font-bold text-gray-900 text-lg">0</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-blue-200 pb-3">
                        <div class="flex items-center">
                            <div class="bg-green-100 p-1.5 rounded mr-2">
                                <svg class="w-4 h-4 text-green-700" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="text-gray-700 font-semibold text-sm">Pesanan Selesai</span>
                        </div>
                        <span class="font-bold text-green-600 text-lg">0</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="bg-purple-100 p-1.5 rounded mr-2">
                                <svg class="w-4 h-4 text-purple-700" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="text-gray-700 font-semibold text-sm">Total Belanja</span>
                        </div>
                        <span class="font-bold text-purple-600 text-lg">Rp 0</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Banner - COMPACT -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 border-2 border-blue-500 text-white rounded-lg shadow-md p-6 text-center">
            <div class="max-w-3xl mx-auto">
                <div class="bg-blue-500 p-3 rounded-lg inline-block mb-3">
                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-2">Butuh Mobil Sekarang?</h3>
                <p class="text-sm mb-4 text-blue-100">Kami punya berbagai pilihan mobil untuk segala kebutuhan Anda!</p>
                <a href="/pelanggan/mobil" class="inline-flex items-center bg-white text-blue-600 px-6 py-3 rounded-lg text-sm font-bold hover:bg-gray-100 transition">
                    <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                    </svg>
                    Lihat Daftar Mobil Sekarang
                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</body>
</html>