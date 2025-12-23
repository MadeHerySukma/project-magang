<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Mobil - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-2px); }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar - ALIGNED WITH CUSTOMER -->
    <nav class="bg-gradient-to-r from-blue-900 to-blue-800 text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <div class="bg-blue-500 p-1.5 rounded-lg">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                        </svg>
                    </div>
                    <h1 class="text-lg font-bold">Manajemen Mobil</h1>
                </div>
                            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center space-x-3">
                @if(request()->routeIs('admin.dashboard'))
                    <a href="/admin/dashboard" 
                       class="text-white bg-blue-700 px-3 py-1.5 rounded-lg font-semibold text-sm transition">
                        Dashboard
                    </a>
                @else
                    <a href="/admin/dashboard" 
                       class="hover:text-blue-200 text-sm font-medium transition">
                        Dashboard
                    </a>
                @endif

                @if(request()->routeIs('admin.transaksi.*'))
                    <a href="{{ route('admin.transaksi.index') }}" 
                       class="text-white bg-blue-700 px-3 py-1.5 rounded-lg font-semibold text-sm transition">
                        Transaksi
                    </a>
                @else
                    <a href="{{ route('admin.transaksi.index') }}" 
                       class="hover:text-blue-200 text-sm font-medium transition">
                        Transaksi
                    </a>
                @endif

                @if(request()->routeIs('admin.mobil.*'))
                    <a href="{{ route('admin.mobil.index') }}" 
                       class="text-white bg-blue-700 px-3 py-1.5 rounded-lg font-semibold text-sm transition">
                        Mobil
                    </a>
                @else
                    <a href="{{ route('admin.mobil.index') }}" 
                       class="hover:text-blue-200 text-sm font-medium transition">
                        Mobil
                    </a>
                @endif

                @if(request()->routeIs('admin.pemesanan.*'))
                    <a href="{{ route('admin.pemesanan.index') }}" 
                       class="text-white bg-blue-700 px-3 py-1.5 rounded-lg font-semibold text-sm transition">
                        Pemesanan
                    </a>
                @else
                    <a href="{{ route('admin.pemesanan.index') }}" 
                       class="hover:text-blue-200 text-sm font-medium transition">
                        Pemesanan
                    </a>
                @endif

                @if(request()->routeIs('admin.users.*'))
                    <a href="{{ route('admin.users.index') }}" 
                       class="text-white bg-blue-700 px-3 py-1.5 rounded-lg font-semibold text-sm transition">
                        Pengguna
                    </a>
                @else
                    <a href="{{ route('admin.users.index') }}" 
                       class="hover:text-blue-200 text-sm font-medium transition">
                        Pengguna
                    </a>
                @endif

                @if(request()->routeIs('admin.waiting-list.*'))
                    <a href="{{ route('admin.waiting-list.index') }}" 
                       class="text-white bg-blue-700 px-3 py-1.5 rounded-lg font-semibold text-sm transition">
                        ⏳ Waiting List
                    </a>
                @else
                    <a href="{{ route('admin.waiting-list.index') }}" 
                       class="hover:text-blue-200 text-sm font-medium transition">
                        ⏳ Waiting List
                    </a>
                @endif

                @if(request()->routeIs('admin.pengembalian.*'))
                    <a href="{{ route('admin.pengembalian.index') }}" 
                    class="text-white bg-blue-700 px-3 py-1.5 rounded-lg font-semibold text-sm transition">
                        ⏰ Pengembalian
                    </a>
                @else
                    <a href="{{ route('admin.pengembalian.index') }}" 
                    class="hover:text-blue-200 text-sm font-medium transition">
                        ⏰ Pengembalian
                    </a>
                @endif

                @if(request()->routeIs('admin.settings.*'))
                    <a href="{{ route('admin.settings.index') }}" 
                       class="text-white bg-blue-700 px-3 py-1.5 rounded-lg font-semibold text-sm transition">
                        ⚙️ Settings
                    </a>
                @else
                    <a href="{{ route('admin.settings.index') }}" 
                       class="hover:text-blue-200 text-sm font-medium transition">
                        ⚙️ Settings
                    </a>
                @endif

                <div class="relative pl-3 border-l border-blue-700">
                    <button id="userDropdownBtn" class="flex items-center space-x-2 hover:bg-blue-700 px-3 py-1.5 rounded-lg transition">
                        <div class="bg-blue-700 p-1.5 rounded-full">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold">{{ auth()->user()->name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    <!-- Dropdown Menu Desktop -->
                    <div id="userDropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50">
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
            <button id="mobileMenuBtn" class="lg:hidden text-white focus:outline-none">
                <svg id="menuOpenIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="menuCloseIcon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden lg:hidden pb-4">
            <div class="flex flex-col space-y-2">
                @if(request()->routeIs('admin.dashboard'))
                    <a href="/admin/dashboard" 
                       class="text-white bg-blue-700 px-4 py-2 rounded-lg font-semibold text-sm">
                        📊 Dashboard
                    </a>
                @else
                    <a href="/admin/dashboard" 
                       class="text-white hover:bg-blue-700 px-4 py-2 rounded-lg text-sm transition">
                        📊 Dashboard
                    </a>
                @endif

                @if(request()->routeIs('admin.transaksi.*'))
                    <a href="{{ route('admin.transaksi.index') }}" 
                       class="text-white bg-blue-700 px-4 py-2 rounded-lg font-semibold text-sm">
                        💰 Transaksi
                    </a>
                @else
                    <a href="{{ route('admin.transaksi.index') }}" 
                       class="text-white hover:bg-blue-700 px-4 py-2 rounded-lg text-sm transition">
                        💰 Transaksi
                    </a>
                @endif

                @if(request()->routeIs('admin.mobil.*'))
                    <a href="{{ route('admin.mobil.index') }}" 
                       class="text-white bg-blue-700 px-4 py-2 rounded-lg font-semibold text-sm">
                        🚗 Mobil
                    </a>
                @else
                    <a href="{{ route('admin.mobil.index') }}" 
                       class="text-white hover:bg-blue-700 px-4 py-2 rounded-lg text-sm transition">
                        🚗 Mobil
                    </a>
                @endif

                @if(request()->routeIs('admin.pemesanan.*'))
                    <a href="{{ route('admin.pemesanan.index') }}" 
                       class="text-white bg-blue-700 px-4 py-2 rounded-lg font-semibold text-sm">
                        📦 Pemesanan
                    </a>
                @else
                    <a href="{{ route('admin.pemesanan.index') }}" 
                       class="text-white hover:bg-blue-700 px-4 py-2 rounded-lg text-sm transition">
                        📦 Pemesanan
                    </a>
                @endif

                @if(request()->routeIs('admin.users.*'))
                    <a href="{{ route('admin.users.index') }}" 
                       class="text-white bg-blue-700 px-4 py-2 rounded-lg font-semibold text-sm">
                        👥 Pengguna
                    </a>
                @else
                    <a href="{{ route('admin.users.index') }}" 
                       class="text-white hover:bg-blue-700 px-4 py-2 rounded-lg text-sm transition">
                        👥 Pengguna
                    </a>
                @endif

                @if(request()->routeIs('admin.waiting-list.*'))
                    <a href="{{ route('admin.waiting-list.index') }}" 
                       class="text-white bg-blue-700 px-4 py-2 rounded-lg font-semibold text-sm">
                        ⏳ Waiting List
                    </a>
                @else
                    <a href="{{ route('admin.waiting-list.index') }}" 
                       class="text-white hover:bg-blue-700 px-4 py-2 rounded-lg text-sm transition">
                        ⏳ Waiting List
                    </a>
                @endif

                @if(request()->routeIs('admin.pengembalian.*'))
                    <a href="{{ route('admin.pengembalian.index') }}" 
                    class="text-white bg-blue-700 px-4 py-2 rounded-lg font-semibold text-sm">
                        ⏰ Pengembalian
                    </a>
                @else
                    <a href="{{ route('admin.pengembalian.index') }}" 
                    class="text-white hover:bg-blue-700 px-4 py-2 rounded-lg text-sm transition">
                        ⏰ Pengembalian
                    </a>
                @endif

                @if(request()->routeIs('admin.settings.*'))
                    <a href="{{ route('admin.settings.index') }}" 
                       class="text-white bg-blue-700 px-4 py-2 rounded-lg font-semibold text-sm">
                        ⚙️ Settings
                    </a>
                @else
                    <a href="{{ route('admin.settings.index') }}" 
                       class="text-white hover:bg-blue-700 px-4 py-2 rounded-lg text-sm transition">
                        ⚙️ Settings
                    </a>
                @endif

                <div class="border-t border-blue-700 pt-3 mt-2">
                    <button id="mobileUserDropdownBtn" class="w-full flex items-center justify-between px-4 py-2 text-white hover:bg-blue-700 rounded-lg transition">
                        <div class="flex items-center space-x-2">
                            <div class="bg-blue-700 p-1.5 rounded-full">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="text-sm font-semibold">{{ auth()->user()->name }}</span>
                        </div>
                        <svg id="mobileDropdownIcon" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    <!-- Mobile Dropdown Content -->
                    <div id="mobileUserDropdownMenu" class="hidden mt-2 space-y-2">
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
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const menuOpenIcon = document.getElementById('menuOpenIcon');
    const menuCloseIcon = document.getElementById('menuCloseIcon');

    mobileMenuBtn.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');
        menuOpenIcon.classList.toggle('hidden');
        menuCloseIcon.classList.toggle('hidden');
    });

    // Desktop user dropdown
    const userDropdownBtn = document.getElementById('userDropdownBtn');
    const userDropdownMenu = document.getElementById('userDropdownMenu');

    userDropdownBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        userDropdownMenu.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!userDropdownBtn.contains(e.target) && !userDropdownMenu.contains(e.target)) {
            userDropdownMenu.classList.add('hidden');
        }
    });

    // Mobile user dropdown
    const mobileUserDropdownBtn = document.getElementById('mobileUserDropdownBtn');
    const mobileUserDropdownMenu = document.getElementById('mobileUserDropdownMenu');
    const mobileDropdownIcon = document.getElementById('mobileDropdownIcon');

    mobileUserDropdownBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        mobileUserDropdownMenu.classList.toggle('hidden');
        mobileDropdownIcon.classList.toggle('rotate-180');
    });
</script>

    <div class="container mx-auto px-6 py-4">
        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 mb-4 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <p class="font-semibold text-sm">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Header - Compact -->
        <div class="bg-gradient-to-r from-blue-900 to-blue-800 rounded-lg shadow-md p-4 text-white mb-4 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                    </svg>
                    Daftar Mobil
                </h2>
                <p class="text-blue-200 text-sm">Kelola armada rental mobil Anda</p>
            </div>
            <button onclick="openModal('addModal')" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
                Tambah Mobil
            </button>
        </div>

        <!-- Search & Filter - COMPACT -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4 mb-4">
            <div class="flex items-center mb-3">
                <div class="bg-blue-900 p-1 rounded mr-2">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-gray-900">Cari & Filter Mobil</h3>
            </div>
            
            <form method="GET" action="{{ route('admin.mobil.index') }}">
                <div class="grid grid-cols-2 md:grid-cols-6 gap-3">
                    <div class="col-span-2">
                        <label class="block text-gray-900 font-bold mb-1 text-xs">Cari Mobil</label>
                        <input type="text" name="search" value="{{ request('search') }}" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="Cari merek/model/plat...">
                    </div>
                    <div>
                        <label class="block text-gray-900 font-bold mb-1 text-xs">Jenis</label>
                        <select name="jenis" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua</option>
                            @foreach($jenis_list as $jenis)
                                <option value="{{ $jenis }}" {{ request('jenis') == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-900 font-bold mb-1 text-xs">Merek</label>
                        <select name="merek" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua</option>
                            @foreach($merek_list as $merek)
                                <option value="{{ $merek }}" {{ request('merek') == $merek ? 'selected' : '' }}>{{ $merek }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-900 font-bold mb-1 text-xs">Status</label>
                        <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua</option>
                            <option value="Tersedia" {{ request('status') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="Disewa" {{ request('status') == 'Disewa' ? 'selected' : '' }}>Disewa</option>
                            <option value="Dalam Perawatan" {{ request('status') == 'Dalam Perawatan' ? 'selected' : '' }}>Perawatan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-900 font-bold mb-1 text-xs">Urutkan</label>
                        <select name="sort" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                            <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                            <option value="harga_asc" {{ request('sort') == 'harga_asc' ? 'selected' : '' }}>Harga ↑</option>
                            <option value="harga_desc" {{ request('sort') == 'harga_desc' ? 'selected' : '' }}>Harga ↓</option>
                        </select>
                    </div>
                </div>
                <div class="flex gap-2 mt-3">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-2 rounded-lg text-sm font-bold transition flex items-center justify-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                        </svg>
                        Cari
                    </button>
                    <a href="{{ route('admin.mobil.index') }}" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-bold text-center transition flex items-center justify-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                        </svg>
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Results Count -->
        <div class="mb-4">
            <p class="text-gray-700 text-sm font-semibold">
                Ditemukan <span class="text-blue-700 font-bold text-lg">{{ $mobils->total() }}</span> mobil
            </p>
        </div>

        <!-- Cars Grid - COMPACT -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($mobils as $mobil)
            <div class="card-hover bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
                <!-- Image -->
                <div class="relative h-40 bg-gradient-to-br from-blue-400 to-indigo-500">
                    @php
                        $mainPhoto = $mobil->foto_depan ?? $mobil->foto_belakang ?? $mobil->foto_interior ?? $mobil->foto_samping_kiri ?? $mobil->foto_samping_kanan;
                    @endphp
                    
                    @if($mainPhoto)
                        <img src="{{ asset('storage/' . $mainPhoto) }}" alt="{{ $mobil->model }}" class="w-full h-full object-contain p-3">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-white">
                            <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                            </svg>
                        </div>
                    @endif
                    
                    <!-- Photo Indicator -->
                    <div class="absolute bottom-2 left-2 flex space-x-1 bg-white bg-opacity-90 px-2 py-1 rounded">
                        @if($mobil->foto_depan)<div class="w-1.5 h-1.5 bg-blue-600 rounded-full"></div>@endif
                        @if($mobil->foto_belakang)<div class="w-1.5 h-1.5 bg-blue-600 rounded-full"></div>@endif
                        @if($mobil->foto_interior)<div class="w-1.5 h-1.5 bg-blue-600 rounded-full"></div>@endif
                        @if($mobil->foto_samping_kiri)<div class="w-1.5 h-1.5 bg-blue-600 rounded-full"></div>@endif
                        @if($mobil->foto_samping_kanan)<div class="w-1.5 h-1.5 bg-blue-600 rounded-full"></div>@endif
                    </div>
                    
                    <!-- Status Badge -->
                    <div class="absolute top-2 right-2">
                        @if($mobil->status == 'Tersedia')
                            <span class="px-2 py-1 text-xs font-bold rounded-lg bg-green-600 text-white flex items-center">
                                <svg class="w-3 h-3 mr-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Tersedia
                            </span>
                        @elseif($mobil->status == 'Disewa')
                            <span class="px-2 py-1 text-xs font-bold rounded-lg bg-red-600 text-white flex items-center">
                                <svg class="w-3 h-3 mr-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                Disewa
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs font-bold rounded-lg bg-yellow-600 text-white flex items-center">
                                <svg class="w-3 h-3 mr-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                Perawatan
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Content -->
                <div class="p-4">
                    <div class="mb-3">
                        <h3 class="text-lg font-bold text-gray-900">{{ $mobil->merek }}</h3>
                        <p class="text-sm text-gray-600">{{ $mobil->model }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-2 mb-3">
                        <div class="bg-blue-50 border border-blue-200 rounded p-2">
                            <p class="text-xs text-blue-700 font-bold mb-0.5">Jenis</p>
                            <p class="font-bold text-blue-950 text-sm">{{ $mobil->jenis }}</p>
                        </div>
                        <div class="bg-indigo-50 border border-indigo-200 rounded p-2">
                            <p class="text-xs text-indigo-700 font-bold mb-0.5">Tahun</p>
                            <p class="font-bold text-indigo-950 text-sm">{{ $mobil->tahun }}</p>
                        </div>
                        <div class="bg-gray-50 border border-gray-200 rounded p-2 col-span-2">
                            <p class="text-xs text-gray-700 font-bold mb-0.5">Plat Nomor</p>
                            <p class="font-bold text-gray-950 text-sm">{{ $mobil->nomor_plat }}</p>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-3 mb-3">
                        <p class="text-gray-600 text-xs mb-0.5 font-semibold">Harga Sewa</p>
                        <p class="text-2xl font-bold text-blue-700">{{ $mobil->harga_format }}</p>
                        <p class="text-xs text-gray-600 font-semibold">per hari</p>
                    </div>

                    <!-- Actions -->
                    <div class="flex space-x-2">
                        <button onclick='openEditModal(@json($mobil))' class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg text-sm font-bold transition flex items-center justify-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                            </svg>
                            Edit
                        </button>
                        <form method="POST" action="{{ route('admin.mobil.destroy', $mobil->id) }}" class="flex-1" onsubmit="return confirm('Yakin hapus mobil ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-sm font-bold transition flex items-center justify-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 bg-white border border-gray-200 rounded-lg shadow-md p-12 text-center">
                <div class="bg-blue-100 p-6 rounded-full inline-block mb-4">
                    <svg class="w-20 h-20 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <p class="text-gray-600 text-lg font-bold mb-2">Mobil Tidak Ditemukan</p>
                <p class="text-gray-500 mb-5 text-sm">Coba ubah filter pencarian Anda</p>
                <a href="{{ route('admin.mobil.index') }}" class="inline-flex items-center bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-lg text-sm font-bold transition">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                    </svg>
                    Lihat Semua Mobil
                </a>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $mobils->links() }}
        </div>
    </div>

    <!-- MODAL TAMBAH - ULTRA COMPACT -->
    <div id="addModal" class="hidden fixed inset-0 bg-black bg-opacity-60 overflow-y-auto h-full w-full z-50">
        <div class="relative top-4 mx-auto p-4 w-full max-w-3xl bg-white rounded-lg shadow-2xl my-4">
            <div class="flex justify-between items-center mb-3 border-b border-blue-100 pb-2">
                <h3 class="text-lg font-bold text-blue-950 flex items-center">
                    <div class="bg-green-600 p-1 rounded mr-2">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    Tambah Mobil Baru
                </h3>
                <button onclick="closeModal('addModal')" class="text-gray-400 hover:text-gray-600 p-1 rounded transition">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>

            <form method="POST" action="{{ route('admin.mobil.store') }}" enctype="multipart/form-data" class="max-h-[75vh] overflow-y-auto pr-2">
                @csrf
                
                <!-- Data Mobil -->
                <div class="mb-3">
                    <h4 class="text-sm font-bold text-blue-950 mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-1 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                        </svg>
                        Informasi Mobil
                    </h4>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-gray-900 font-bold mb-1 text-xs">Merek *</label>
                            <input type="text" name="merek" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500" placeholder="Toyota">
                        </div>
                        <div>
                            <label class="block text-gray-900 font-bold mb-1 text-xs">Model *</label>
                            <input type="text" name="model" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500" placeholder="Avanza">
                        </div>
                        <div>
                            <label class="block text-gray-900 font-bold mb-1 text-xs">Jenis *</label>
                            <select name="jenis" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Jenis</option>
                                <option value="Sedan">Sedan</option>
                                <option value="SUV">SUV</option>
                                <option value="MPV">MPV</option>
                                <option value="Hatchback">Hatchback</option>
                                <option value="Pickup">Pickup</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-900 font-bold mb-1 text-xs">Nomor Plat *</label>
                            <input type="text" name="nomor_plat" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500" placeholder="B 1234 XYZ">
                        </div>
                        <div>
                            <label class="block text-gray-900 font-bold mb-1 text-xs">Tahun *</label>
                            <input type="number" name="tahun" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500" value="{{ date('Y') }}">
                        </div>
                        <div>
                            <label class="block text-gray-900 font-bold mb-1 text-xs">Harga/Hari *</label>
                            <input type="number" name="harga_sewa" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500" placeholder="250000">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-gray-900 font-bold mb-1 text-xs">Status *</label>
                            <select name="status" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                                <option value="Tersedia">Tersedia</option>
                                <option value="Disewa">Disewa</option>
                                <option value="Dalam Perawatan">Dalam Perawatan</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- 5 Foto -->
                <div class="mb-3">
                    <h4 class="text-sm font-bold text-blue-950 mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-1 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                        </svg>
                        Upload Foto Mobil (5 Foto)
                    </h4>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-blue-50 border border-blue-200 rounded p-2">
                            <label class="block text-blue-950 font-bold mb-1 text-xs">📷 Foto Depan</label>
                            <input type="file" name="foto_depan" accept="image/*" class="w-full px-2 py-1 border border-gray-300 rounded text-xs">
                        </div>
                        <div class="bg-blue-50 border border-blue-200 rounded p-2">
                            <label class="block text-blue-950 font-bold mb-1 text-xs">📷 Foto Belakang</label>
                            <input type="file" name="foto_belakang" accept="image/*" class="w-full px-2 py-1 border border-gray-300 rounded text-xs">
                        </div>
                        <div class="bg-blue-50 border border-blue-200 rounded p-2">
                            <label class="block text-blue-950 font-bold mb-1 text-xs">🪑 Foto Interior</label>
                            <input type="file" name="foto_interior" accept="image/*" class="w-full px-2 py-1 border border-gray-300 rounded text-xs">
                        </div>
                        <div class="bg-blue-50 border border-blue-200 rounded p-2">
                            <label class="block text-blue-950 font-bold mb-1 text-xs">← Foto Samping Kiri</label>
                            <input type="file" name="foto_samping_kiri" accept="image/*" class="w-full px-2 py-1 border border-gray-300 rounded text-xs">
                        </div>
                        <div class="col-span-2 bg-blue-50 border border-blue-200 rounded p-2">
                            <label class="block text-blue-950 font-bold mb-1 text-xs">→ Foto Samping Kanan</label>
                            <input type="file" name="foto_samping_kanan" accept="image/*" class="w-full px-2 py-1 border border-gray-300 rounded text-xs">
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label class="block text-gray-900 font-bold mb-1 text-xs">Deskripsi</label>
                    <textarea name="deskripsi" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500" placeholder="Tambahkan deskripsi mobil..."></textarea>
                </div>

                <!-- Buttons -->
                <div class="flex space-x-3 border-t border-blue-100 pt-3">
                    <button type="button" onclick="closeModal('addModal')" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-bold transition">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-bold transition">
                        Simpan Mobil
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT - ULTRA COMPACT (Same structure as Add Modal) -->
    <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-60 overflow-y-auto h-full w-full z-50">
        <div class="relative top-4 mx-auto p-4 w-full max-w-3xl bg-white rounded-lg shadow-2xl my-4">
            <div class="flex justify-between items-center mb-3 border-b border-blue-100 pb-2">
                <h3 class="text-lg font-bold text-blue-950 flex items-center">
                    <div class="bg-yellow-500 p-1 rounded mr-2">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                        </svg>
                    </div>
                    Edit Mobil
                </h3>
                <button onclick="closeModal('editModal')" class="text-gray-400 hover:text-gray-600 p-1 rounded transition">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>

            <form id="editForm" method="POST" enctype="multipart/form-data" class="max-h-[75vh] overflow-y-auto pr-2">
                @csrf
                @method('PUT')
                
                <!-- Same structure as Add Modal -->
                <div class="mb-3">
                    <h4 class="text-sm font-bold text-blue-950 mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-1 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                        </svg>
                        Informasi Mobil
                    </h4>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-gray-900 font-bold mb-1 text-xs">Merek *</label>
                            <input type="text" name="merek" id="edit_merek" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                        </div>
                        <div>
                            <label class="block text-gray-900 font-bold mb-1 text-xs">Model *</label>
                            <input type="text" name="model" id="edit_model" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                        </div>
                        <div>
                            <label class="block text-gray-900 font-bold mb-1 text-xs">Jenis *</label>
                            <select name="jenis" id="edit_jenis" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                                <option value="Sedan">Sedan</option>
                                <option value="SUV">SUV</option>
                                <option value="MPV">MPV</option>
                                <option value="Hatchback">Hatchback</option>
                                <option value="Pickup">Pickup</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-900 font-bold mb-1 text-xs">Nomor Plat *</label>
                            <input type="text" name="nomor_plat" id="edit_nomor_plat" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                        </div>
                        <div>
                            <label class="block text-gray-900 font-bold mb-1 text-xs">Tahun *</label>
                            <input type="number" name="tahun" id="edit_tahun" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                        </div>
                        <div>
                            <label class="block text-gray-900 font-bold mb-1 text-xs">Harga/Hari *</label>
                            <input type="number" name="harga_sewa" id="edit_harga_sewa" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-gray-900 font-bold mb-1 text-xs">Status *</label>
                            <select name="status" id="edit_status" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                                <option value="Tersedia">Tersedia</option>
                                <option value="Disewa">Disewa</option>
                                <option value="Dalam Perawatan">Dalam Perawatan</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- 5 Foto UPDATE -->
                <div class="mb-3">
                    <h4 class="text-sm font-bold text-blue-950 mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-1 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                        </svg>
                        Update Foto (Opsional)
                    </h4>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-yellow-50 border border-yellow-200 rounded p-2">
                            <label class="block text-gray-900 font-bold mb-1 text-xs">📷 Foto Depan Baru</label>
                            <input type="file" name="foto_depan" accept="image/*" class="w-full px-2 py-1 border border-gray-300 rounded text-xs">
                        </div>
                        <div class="bg-yellow-50 border border-yellow-200 rounded p-2">
                            <label class="block text-gray-900 font-bold mb-1 text-xs">📷 Foto Belakang Baru</label>
                            <input type="file" name="foto_belakang" accept="image/*" class="w-full px-2 py-1 border border-gray-300 rounded text-xs">
                        </div>
                        <div class="bg-yellow-50 border border-yellow-200 rounded p-2">
                            <label class="block text-gray-900 font-bold mb-1 text-xs">🪑 Foto Interior Baru</label>
                            <input type="file" name="foto_interior" accept="image/*" class="w-full px-2 py-1 border border-gray-300 rounded text-xs">
                        </div>
                        <div class="bg-yellow-50 border border-yellow-200 rounded p-2">
                            <label class="block text-gray-900 font-bold mb-1 text-xs">← Foto Samping Kiri Baru</label>
                            <input type="file" name="foto_samping_kiri" accept="image/*" class="w-full px-2 py-1 border border-gray-300 rounded text-xs">
                        </div>
                        <div class="col-span-2 bg-yellow-50 border border-yellow-200 rounded p-2">
                            <label class="block text-gray-900 font-bold mb-1 text-xs">→ Foto Samping Kanan Baru</label>
                            <input type="file" name="foto_samping_kanan" accept="image/*" class="w-full px-2 py-1 border border-gray-300 rounded text-xs">
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label class="block text-gray-900 font-bold mb-1 text-xs">Deskripsi</label>
                    <textarea name="deskripsi" id="edit_deskripsi" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm"></textarea>
                </div>

                <!-- Buttons -->
                <div class="flex space-x-3 border-t border-blue-100 pt-3">
                    <button type="button" onclick="closeModal('editModal')" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-bold transition">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm font-bold transition">
                        Update Mobil
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function openEditModal(mobil) {
            document.getElementById('editForm').action = `/admin/mobil/${mobil.id}`;
            document.getElementById('edit_merek').value = mobil.merek;
            document.getElementById('edit_model').value = mobil.model;
            document.getElementById('edit_jenis').value = mobil.jenis;
            document.getElementById('edit_nomor_plat').value = mobil.nomor_plat;
            document.getElementById('edit_tahun').value = mobil.tahun;
            document.getElementById('edit_harga_sewa').value = mobil.harga_sewa;
            document.getElementById('edit_status').value = mobil.status;
            document.getElementById('edit_deskripsi').value = mobil.deskripsi || '';
            openModal('editModal');
        }

        window.onclick = function(event) {
            if (event.target.id === 'addModal' || event.target.id === 'editModal') {
                closeModal('addModal');
                closeModal('editModal');
            }
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal('addModal');
                closeModal('editModal');
            }
        });
    </script>
</body>
</html>