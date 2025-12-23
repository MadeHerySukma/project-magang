<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pemesanan #{{ str_pad($pemesanan->id, 6, '0', STR_PAD_LEFT) }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
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
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                <h1 class="text-base sm:text-lg font-bold">Detail Pemesanan</h1>
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

            <!-- Header dengan Status - Compact -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-md p-5 mb-4">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-1">
                            Pemesanan #{{ str_pad($pemesanan->id, 6, '0', STR_PAD_LEFT) }}
                        </h2>
                        <p class="text-xs text-gray-600 font-semibold flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                            Dibuat pada {{ $pemesanan->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                    <div class="mt-2 md:mt-0">
                        {!! $pemesanan->status_badge !!}
                    </div>
                </div>
            </div>

            <!-- Status Alert - Compact -->
            @if($pemesanan->status == 'pending')
                <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 mb-4 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-8 h-8 text-yellow-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <h3 class="text-base font-bold text-yellow-800 mb-1">Menunggu Pembayaran</h3>
                            <p class="text-xs text-yellow-700 font-semibold mb-3">Silakan lakukan pembayaran untuk mengkonfirmasi pesanan Anda.</p>
                            <a href="{{ route('pelanggan.pemesanan.payment', $pemesanan->id) }}" 
                                class="inline-flex items-center bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white px-4 py-2 rounded-lg text-sm font-bold transition">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                                </svg>
                                Bayar Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            @elseif($pemesanan->status == 'paid')
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-8 h-8 text-blue-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <h3 class="text-base font-bold text-blue-800 mb-1">Menunggu Konfirmasi Admin</h3>
                            <p class="text-xs text-blue-700 font-semibold">Pembayaran Anda sedang diverifikasi. Kami akan menghubungi Anda setelah pembayaran dikonfirmasi.</p>
                        </div>
                    </div>
                </div>
            @elseif($pemesanan->status == 'confirmed')
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-8 h-8 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <h3 class="text-base font-bold text-green-800 mb-1">Pemesanan Dikonfirmasi</h3>
                            <p class="text-xs text-green-700 font-semibold">Pemesanan Anda telah dikonfirmasi! Silakan ambil mobil sesuai jadwal yang telah ditentukan.</p>
                        </div>
                    </div>
                </div>
            @elseif($pemesanan->status == 'active')
                <div class="bg-purple-50 border-l-4 border-purple-500 p-4 mb-4 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-8 h-8 text-purple-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                        </svg>
                        <div>
                            <h3 class="text-base font-bold text-purple-800 mb-1">Sedang Berlangsung</h3>
                            <p class="text-xs text-purple-700 font-semibold">Mobil sedang dalam masa sewa. Jangan lupa untuk mengembalikan mobil tepat waktu!</p>
                        </div>
                    </div>
                </div>
            @elseif($pemesanan->status == 'completed')
                <div class="bg-gray-50 border-l-4 border-gray-500 p-4 mb-4 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-8 h-8 text-gray-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <h3 class="text-base font-bold text-gray-800 mb-1">Pemesanan Selesai</h3>
                            <p class="text-xs text-gray-700 font-semibold">Terima kasih telah menyewa mobil kami. Semoga dapat bekerja sama lagi!</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <!-- LEFT: Detail Mobil & Biaya - Compact -->
                <div class="lg:col-span-1 space-y-4">
                    <!-- Mobil -->
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                        <div class="flex items-center mb-3">
                            <div class="bg-blue-900 p-1 rounded mr-2">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-gray-900">Mobil yang Disewa</h3>
                        </div>
                        
                        @php
                            $foto = $pemesanan->mobil->foto_depan ?? $pemesanan->mobil->foto_belakang ?? $pemesanan->mobil->foto_interior;
                        @endphp
                        
                        <div class="mb-3 bg-gradient-to-br from-teal-400 to-blue-500 rounded-lg overflow-hidden border-2 border-white">
                            @if($foto)
                                <img src="{{ asset('storage/' . $foto) }}" alt="{{ $pemesanan->mobil->model }}" class="w-full h-36 object-contain p-3">
                            @else
                                <div class="w-full h-36 flex items-center justify-center text-white">
                                    <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <h4 class="text-xl font-bold text-gray-900 mb-0.5">{{ $pemesanan->mobil->merek }}</h4>
                        <p class="text-sm text-gray-600 mb-3">{{ $pemesanan->mobil->model }}</p>

                        <div class="space-y-2 text-xs">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 font-semibold">Jenis</span>
                                <span class="px-2 py-0.5 bg-blue-100 text-blue-800 rounded font-bold">{{ $pemesanan->mobil->jenis }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 font-semibold">Tahun</span>
                                <span class="px-2 py-0.5 bg-blue-100 text-blue-800 rounded font-bold">{{ $pemesanan->mobil->tahun }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 font-semibold">Plat Nomor</span>
                                <span class="px-2 py-0.5 bg-gray-100 text-gray-800 rounded font-bold">{{ $pemesanan->mobil->nomor_plat }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Ringkasan Biaya -->
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                        <div class="flex items-center mb-3">
                            <div class="bg-green-600 p-1 rounded mr-2">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-gray-900">Rincian Biaya</h3>
                        </div>
                        
                        <div class="space-y-2 text-xs mb-3">
                            <div class="flex justify-between bg-blue-50 p-2 rounded">
                                <span class="text-blue-900 font-bold">Harga per Hari</span>
                                <span class="font-bold text-blue-950">{{ $pemesanan->harga_per_hari_format }}</span>
                            </div>
                            <div class="flex justify-between bg-purple-50 p-2 rounded">
                                <span class="text-purple-700 font-bold">Durasi Sewa</span>
                                <span class="font-bold text-purple-950">{{ $pemesanan->durasi }} Hari</span>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-3">
                            <div class="bg-gradient-to-r from-green-600 to-green-700 border-2 border-green-500 rounded-lg p-3 text-white">
                                <p class="text-green-100 text-xs font-bold mb-0.5">TOTAL PEMBAYARAN</p>
                                <p class="text-2xl font-bold">{{ $pemesanan->total_harga_format }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT: Detail Pemesanan - Compact -->
                <div class="lg:col-span-2 space-y-4">
                    <!-- Jadwal Sewa -->
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                        <div class="flex items-center mb-3">
                            <div class="bg-blue-900 p-1 rounded mr-2">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-gray-900">Jadwal Sewa</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                            <div class="bg-gradient-to-r from-blue-600 to-blue-700 border-2 border-blue-500 rounded-lg p-4 text-white">
                                <p class="text-xs text-blue-100 font-bold mb-1">TANGGAL MULAI</p>
                                <p class="text-3xl font-bold mb-0.5">{{ $pemesanan->tanggal_mulai->format('d') }}</p>
                                <p class="text-sm">{{ $pemesanan->tanggal_mulai->format('M Y') }}</p>
                            </div>
                            <div class="bg-gradient-to-r from-green-600 to-green-700 border-2 border-green-500 rounded-lg p-4 text-white">
                                <p class="text-xs text-green-100 font-bold mb-1">TANGGAL SELESAI</p>
                                <p class="text-3xl font-bold mb-0.5">{{ $pemesanan->tanggal_selesai->format('d') }}</p>
                                <p class="text-sm">{{ $pemesanan->tanggal_selesai->format('M Y') }}</p>
                            </div>
                        </div>

                        <div class="bg-purple-50 border border-purple-300 rounded-lg p-3">
                            <p class="text-center text-purple-700 text-sm font-semibold">
                                Durasi: <span class="font-bold text-lg text-purple-950">{{ $pemesanan->durasi }} Hari</span>
                            </p>
                        </div>
                    </div>

                    <!-- Data Penyewa -->
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                        <div class="flex items-center mb-3">
                            <div class="bg-blue-900 p-1 rounded mr-2">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-gray-900">Data Penyewa</h3>
                        </div>
                        
                        <div class="space-y-3">
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                                <p class="text-xs text-blue-700 font-bold mb-0.5">NAMA LENGKAP</p>
                                <p class="text-base font-bold text-blue-950">{{ $pemesanan->nama_lengkap }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="bg-purple-50 border border-purple-200 rounded-lg p-3">
                                    <p class="text-xs text-purple-700 font-bold mb-0.5">NIK</p>
                                    <p class="font-bold text-purple-950 text-sm">{{ $pemesanan->nik }}</p>
                                </div>
                                <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                                    <p class="text-xs text-green-700 font-bold mb-0.5">NO. TELEPON</p>
                                    <p class="font-bold text-green-950 text-sm">{{ $pemesanan->no_telepon }}</p>
                                </div>
                                 @if($pemesanan->hasAlternativePhone())
                                <div class="bg-blue-50 border-2 border-blue-300 rounded-lg p-3">
                                    <p class="text-xs text-blue-700 font-bold uppercase mb-0.5 flex items-center">
                                        No. Telepon Alternatif
                                    </p>
                                    <p class="font-bold text-blue-700 text-sm">{{ $pemesanan->no_telepon_alternatif }}</p>
                                </div>
                                @endif
                            </div>
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-3">
                                <p class="text-xs text-gray-700 font-bold mb-0.5">ALAMAT</p>
                                <p class="text-gray-950 font-semibold text-sm">{{ $pemesanan->alamat }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-700 font-bold mb-2">FOTO KTP</p>
                                <img src="{{ asset('storage/' . $pemesanan->foto_ktp) }}" 
                                    alt="KTP" 
                                    class="w-full rounded-lg border-2 border-blue-200 cursor-pointer hover:shadow-lg transition"
                                    onclick="window.open(this.src, '_blank')">
                                <p class="text-xs text-gray-500 mt-1 font-semibold">📌 Klik untuk memperbesar</p>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Pembayaran -->
                    @if($pemesanan->metode_pembayaran)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                        <div class="flex items-center mb-3">
                            <div class="bg-blue-600 p-1 rounded mr-2">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-gray-900">Informasi Pembayaran</h3>
                        </div>
                        
                        <div class="space-y-3">
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                                <p class="text-xs text-blue-700 font-bold mb-0.5">METODE PEMBAYARAN</p>
                                <p class="font-bold text-blue-950 text-sm">
                                    @if($pemesanan->metode_pembayaran == 'transfer_bca') 🏦 Transfer Bank BCA
                                    @elseif($pemesanan->metode_pembayaran == 'transfer_bni') 🏦 Transfer Bank BNI
                                    @elseif($pemesanan->metode_pembayaran == 'transfer_mandiri') 🏦 Transfer Bank Mandiri
                                    @elseif($pemesanan->metode_pembayaran == 'va_bca') 💳 Virtual Account BCA
                                    @elseif($pemesanan->metode_pembayaran == 'va_bni') 💳 Virtual Account BNI
                                    @elseif($pemesanan->metode_pembayaran == 'va_mandiri') 💳 Virtual Account Mandiri
                                    @endif
                                </p>
                            </div>

                            @if($pemesanan->bukti_pembayaran)
                            <div>
                                <p class="text-xs text-gray-700 font-bold mb-2">BUKTI PEMBAYARAN</p>
                                <img src="{{ asset('storage/' . $pemesanan->bukti_pembayaran) }}" 
                                    alt="Bukti Pembayaran" 
                                    class="w-full rounded-lg border-2 border-blue-200 cursor-pointer hover:shadow-lg transition"
                                    onclick="window.open(this.src, '_blank')">
                                <p class="text-xs text-gray-500 mt-1 font-semibold">📌 Klik untuk memperbesar</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Catatan -->
                    @if($pemesanan->catatan)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                        <div class="flex items-center mb-3">
                            <div class="bg-gray-600 p-1 rounded mr-2">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-gray-900">Catatan</h3>
                        </div>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-3">
                            <p class="text-gray-800 text-sm whitespace-pre-line font-semibold">{{ $pemesanan->catatan }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons - Compact -->
            <div class="mt-4 bg-white border border-gray-200 rounded-lg shadow-md p-4">
                <div class="flex flex-wrap gap-3">
                    @if($pemesanan->status == 'pending')
                        <a href="{{ route('pelanggan.pemesanan.payment', $pemesanan->id) }}" 
                            class="flex-1 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white px-4 py-3 rounded-lg text-sm font-bold text-center transition flex items-center justify-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                            </svg>
                            Lanjutkan Pembayaran
                        </a>
                    @endif
                    
                    <a href="{{ route('pelanggan.pemesanan.index') }}" 
                        class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-4 py-3 rounded-lg text-sm font-bold text-center transition flex items-center justify-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                        </svg>
                        Kembali ke Daftar
                    </a>

                    <a href="/pelanggan/mobil" 
                        class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-3 rounded-lg text-sm font-bold text-center transition flex items-center justify-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                        </svg>
                        Sewa Mobil Lain
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>