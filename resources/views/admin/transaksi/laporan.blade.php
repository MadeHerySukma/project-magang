<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
        
        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            .print-container { box-shadow: none !important; margin: 0 !important; page-break-after: always; }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar - ALIGNED & NO PRINT -->
    <nav class="bg-gradient-to-r from-blue-900 to-blue-800 text-white shadow-lg sticky top-0 z-50 no-print">
        <div class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <div class="bg-blue-500 p-1.5 rounded-lg">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                        </svg>
                    </div>
                    <h1 class="text-lg font-bold">Laporan Transaksi</h1>
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
        <!-- Filter Periode - COMPACT & NO PRINT -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4 mb-4 no-print">
            <div class="flex items-center mb-3">
                <div class="bg-blue-900 p-1 rounded mr-2">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-gray-900">Pilih Periode Laporan</h3>
            </div>
            
            <form method="GET" action="{{ route('admin.transaksi.laporan') }}" id="formLaporan">
                <!-- Tipe Periode -->
                <div class="mb-3">
                    <label class="block text-gray-900 font-bold mb-2 text-xs uppercase">Tipe Periode</label>
                    <div class="grid grid-cols-3 gap-2">
                        <label class="relative flex items-center justify-center p-2 border-2 rounded-lg cursor-pointer transition {{ $tipe_periode == 'harian' ? 'border-blue-600 bg-blue-50' : 'border-gray-200 hover:border-blue-300' }}">
                            <input type="radio" name="tipe_periode" value="harian" class="sr-only" {{ $tipe_periode == 'harian' ? 'checked' : '' }} onchange="togglePeriode()">
                            <div class="text-center">
                                <svg class="w-5 h-5 mx-auto mb-1 {{ $tipe_periode == 'harian' ? 'text-blue-600' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-bold text-xs {{ $tipe_periode == 'harian' ? 'text-blue-600' : 'text-gray-600' }}">Harian</span>
                            </div>
                        </label>
                        
                        <label class="relative flex items-center justify-center p-2 border-2 rounded-lg cursor-pointer transition {{ $tipe_periode == 'mingguan' ? 'border-green-600 bg-green-50' : 'border-gray-200 hover:border-green-300' }}">
                            <input type="radio" name="tipe_periode" value="mingguan" class="sr-only" {{ $tipe_periode == 'mingguan' ? 'checked' : '' }} onchange="togglePeriode()">
                            <div class="text-center">
                                <svg class="w-5 h-5 mx-auto mb-1 {{ $tipe_periode == 'mingguan' ? 'text-green-600' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-bold text-xs {{ $tipe_periode == 'mingguan' ? 'text-green-600' : 'text-gray-600' }}">Mingguan</span>
                            </div>
                        </label>
                        
                        <label class="relative flex items-center justify-center p-2 border-2 rounded-lg cursor-pointer transition {{ $tipe_periode == 'bulanan' ? 'border-purple-600 bg-purple-50' : 'border-gray-200 hover:border-purple-300' }}">
                            <input type="radio" name="tipe_periode" value="bulanan" class="sr-only" {{ $tipe_periode == 'bulanan' ? 'checked' : '' }} onchange="togglePeriode()">
                            <div class="text-center">
                                <svg class="w-5 h-5 mx-auto mb-1 {{ $tipe_periode == 'bulanan' ? 'text-purple-600' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                                </svg>
                                <span class="font-bold text-xs {{ $tipe_periode == 'bulanan' ? 'text-purple-600' : 'text-gray-600' }}">Bulanan</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Filter Input (Dynamic) -->
                <div class="flex items-end space-x-2">
                    <!-- Input Harian -->
                    <div id="filter-harian" class="flex-1" style="display: {{ $tipe_periode == 'harian' ? 'block' : 'none' }}">
                        <label class="block text-gray-900 font-bold mb-1 text-xs uppercase">Pilih Tanggal</label>
                        <input type="date" name="tanggal" value="{{ $tanggal }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Input Mingguan -->
                    <div id="filter-mingguan" class="flex-1" style="display: {{ $tipe_periode == 'mingguan' ? 'block' : 'none' }}">
                        <label class="block text-gray-900 font-bold mb-1 text-xs uppercase">Pilih Minggu</label>
                        <input type="week" name="minggu" value="{{ $minggu }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500">
                    </div>

                    <!-- Input Bulanan -->
                    <div id="filter-bulanan" class="flex-1 grid grid-cols-2 gap-2" style="display: {{ $tipe_periode == 'bulanan' ? 'grid' : 'none' }}">
                        <div>
                            <label class="block text-gray-900 font-bold mb-1 text-xs uppercase">Bulan</label>
                            <select name="bulan" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-purple-500">
                                @foreach($bulan_list as $key => $bulan_nama)
                                    <option value="{{ $key }}" {{ $bulan == $key ? 'selected' : '' }}>{{ $bulan_nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-900 font-bold mb-1 text-xs uppercase">Tahun</label>
                            <select name="tahun" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-purple-500">
                                @foreach($tahun_list as $tahun_item)
                                    <option value="{{ $tahun_item }}" {{ $tahun == $tahun_item ? 'selected' : '' }}>{{ $tahun_item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Button Submit -->
                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-md hover:shadow-lg transition flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                        </svg>
                        Tampilkan
                    </button>
                    <button onclick="window.print()" class="bg-green-600 hover:bg-green-700 px-3 py-1.5 rounded-lg text-white font-semibold transition flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd"/>
                        </svg>
                        Cetak
                    </button>
                </div>
            </form>
        </div>

        <!-- Laporan Container -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-md print-container p-6">
            
            <!-- Header Laporan - COMPACT -->
            <div class="text-center border-b-2 border-blue-900 pb-4 mb-6">
                <div class="bg-gradient-to-r from-blue-900 to-blue-800 rounded-lg p-4 mb-3">
                    <h1 class="text-2xl font-bold text-white mb-1">📊 LAPORAN TRANSAKSI</h1>
                    <p class="text-lg text-blue-200 font-semibold">
                        @if($tipe_periode == 'harian')
                            Periode: {{ \Carbon\Carbon::parse($tanggal)->isoFormat('dddd, D MMMM YYYY') }}
                        @elseif($tipe_periode == 'mingguan')
                            @php
                                $year = substr($minggu, 0, 4);
                                $week = substr($minggu, 6, 2);
                                $startOfWeek = \Carbon\Carbon::now()->setISODate($year, $week)->startOfWeek();
                                $endOfWeek = \Carbon\Carbon::now()->setISODate($year, $week)->endOfWeek();
                            @endphp
                            Periode: Minggu ke-{{ $week }} ({{ $startOfWeek->format('d M') }} - {{ $endOfWeek->format('d M Y') }})
                        @else
                            Periode: {{ $bulan_list[$bulan] }} {{ $tahun }}
                        @endif
                    </p>
                </div>
                <p class="text-xs text-gray-600 font-semibold">Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}</p>
            </div>

            <!-- Summary Cards - COMPACT -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-gradient-to-br from-blue-600 to-blue-700 border-2 border-blue-500 rounded-lg p-4 text-white shadow-md">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-xs font-bold uppercase mb-1">Total Transaksi</p>
                            <p class="text-3xl font-bold">{{ $total_transaksi }}</p>
                        </div>
                        <div class="bg-blue-500 p-2 rounded-lg">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-green-600 to-green-700 border-2 border-green-500 rounded-lg p-4 text-white shadow-md">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-xs font-bold uppercase mb-1">Terkonfirmasi</p>
                            <p class="text-3xl font-bold">{{ $total_transaksi_terkonfirmasi }}</p>
                        </div>
                        <div class="bg-green-500 p-2 rounded-lg">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-purple-600 to-purple-700 border-2 border-purple-500 rounded-lg p-4 text-white shadow-md">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-xs font-bold uppercase mb-1">Total Pendapatan</p>
                            <p class="text-lg font-bold">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-purple-500 p-2 rounded-lg">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-orange-600 to-orange-700 border-2 border-orange-500 rounded-lg p-4 text-white shadow-md">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-orange-100 text-xs font-bold uppercase mb-1">Rata-rata</p>
                            <p class="text-lg font-bold">Rp {{ $total_transaksi_terkonfirmasi > 0 ? number_format($total_pendapatan / $total_transaksi_terkonfirmasi, 0, ',', '.') : 0 }}</p>
                        </div>
                        <div class="bg-orange-500 p-2 rounded-lg">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Penting - COMPACT -->
            <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4 mb-6 shadow-sm">
                <div class="flex items-start">
                    <div class="bg-blue-100 p-2 rounded-lg mr-2">
                        <svg class="w-5 h-5 text-blue-700" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-blue-800 text-sm mb-1">📌 Catatan Perhitungan:</p>
                        <p class="text-xs text-blue-700 leading-relaxed">
                            Total pendapatan dihitung dari transaksi: <strong>"Dikonfirmasi (Confirmed)"</strong>, <strong>"Sedang Berlangsung (Active)"</strong>, dan <strong>"Selesai (Completed)"</strong>. 
                            Status <strong>"Pending"</strong>, <strong>"Paid"</strong>, dan <strong>"Cancelled"</strong> TIDAK dihitung.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Breakdown per Status - COMPACT -->
            <div class="mb-6">
                <h3 class="text-lg font-bold text-blue-950 mb-3 flex items-center">
                    <div class="bg-blue-950 p-1.5 rounded-lg mr-2">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5z"/>
                        </svg>
                    </div>
                    Breakdown per Status
                </h3>
                <div class="overflow-x-auto border border-gray-200 rounded-lg shadow-sm">
                    <table class="w-full text-sm">
                        <thead class="bg-gradient-to-r from-blue-900 to-blue-800 text-white">
                            <tr>
                                <th class="px-4 py-3 text-left font-bold text-xs uppercase">Status</th>
                                <th class="px-4 py-3 text-right font-bold text-xs uppercase">Jumlah</th>
                                <th class="px-4 py-3 text-right font-bold text-xs uppercase">Total Nilai</th>
                                <th class="px-4 py-3 text-right font-bold text-xs uppercase">%</th>
                                <th class="px-4 py-3 text-center font-bold text-xs uppercase">Masuk?</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach(['pending', 'paid', 'confirmed', 'active', 'completed', 'cancelled'] as $status)
                                @if(isset($per_status[$status]))
                                <tr class="hover:bg-blue-50 transition">
                                    <td class="px-4 py-3">
                                        @if($status == 'pending')
                                            <span class="px-2 py-1 text-xs font-bold rounded-lg bg-yellow-100 text-yellow-800">Menunggu</span>
                                        @elseif($status == 'paid')
                                            <span class="px-2 py-1 text-xs font-bold rounded-lg bg-blue-100 text-blue-800">Konfirmasi</span>
                                        @elseif($status == 'confirmed')
                                            <span class="px-2 py-1 text-xs font-bold rounded-lg bg-green-100 text-green-800">Dikonfirmasi</span>
                                        @elseif($status == 'active')
                                            <span class="px-2 py-1 text-xs font-bold rounded-lg bg-purple-100 text-purple-800">Berlangsung</span>
                                        @elseif($status == 'completed')
                                            <span class="px-2 py-1 text-xs font-bold rounded-lg bg-gray-100 text-gray-800">Selesai</span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-bold rounded-lg bg-red-100 text-red-800">Batal</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-right font-bold text-blue-950">{{ $per_status[$status]['jumlah'] }}</td>
                                    <td class="px-4 py-3 text-right font-bold {{ in_array($status, ['confirmed', 'active', 'completed']) ? 'text-green-600' : 'text-gray-400' }}">
                                        Rp {{ number_format($per_status[$status]['total'], 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-3 text-right font-semibold text-blue-950">{{ $total_transaksi > 0 ? number_format(($per_status[$status]['jumlah'] / $total_transaksi) * 100, 1) : 0 }}%</td>
                                    <td class="px-4 py-3 text-center">
                                        @if(in_array($status, ['confirmed', 'active', 'completed']))
                                            <span class="text-lg">✅</span>
                                        @else
                                            <span class="text-lg">❌</span>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            <tr class="bg-blue-50 font-bold border-t-2 border-blue-300">
                                <td class="px-4 py-3 text-blue-950">TOTAL SEMUA</td>
                                <td class="px-4 py-3 text-right text-blue-950 text-lg">{{ $total_transaksi }}</td>
                                <td class="px-4 py-3 text-right text-gray-500">Rp {{ number_format($transaksis->sum('total_harga'), 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-right text-blue-950">100%</td>
                                <td class="px-4 py-3 text-center">-</td>
                            </tr>
                            <tr class="bg-green-50 font-bold border-t-2 border-green-500">
                                <td class="px-4 py-3 text-green-800">✅ PENDAPATAN</td>
                                <td class="px-4 py-3 text-right text-green-800 text-lg">{{ $total_transaksi_terkonfirmasi }}</td>
                                <td class="px-4 py-3 text-right text-green-600 text-lg">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-right text-green-800">{{ $total_transaksi > 0 ? number_format(($total_transaksi_terkonfirmasi / $total_transaksi) * 100, 1) : 0 }}%</td>
                                <td class="px-4 py-3 text-center text-lg">✅</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Breakdown per Metode Pembayaran - COMPACT -->
            <div class="mb-6">
                <h3 class="text-lg font-bold text-blue-950 mb-3 flex items-center">
                    <div class="bg-blue-950 p-1.5 rounded-lg mr-2">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                        </svg>
                    </div>
                    Breakdown per Metode Pembayaran
                </h3>
                <div class="overflow-x-auto border border-gray-200 rounded-lg shadow-sm">
                    <table class="w-full text-sm">
                        <thead class="bg-gradient-to-r from-blue-900 to-blue-800 text-white">
                            <tr>
                                <th class="px-4 py-3 text-left font-bold text-xs uppercase">Metode Pembayaran</th>
                                <th class="px-4 py-3 text-right font-bold text-xs uppercase">Jumlah</th>
                                <th class="px-4 py-3 text-right font-bold text-xs uppercase">Total Nilai</th>
                                <th class="px-4 py-3 text-right font-bold text-xs uppercase">%</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($per_metode as $metode => $data)
                            <tr class="hover:bg-blue-50 transition">
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs font-bold rounded-lg bg-gray-100">{{ $metode }}</span>
                                </td>
                                <td class="px-4 py-3 text-right font-bold text-blue-950">{{ $data['jumlah'] }}</td>
                                <td class="px-4 py-3 text-right font-bold text-green-600">Rp {{ number_format($data['total'], 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-right font-semibold text-blue-950">{{ $total_transaksi_terkonfirmasi > 0 ? number_format(($data['jumlah'] / $total_transaksi_terkonfirmasi) * 100, 1) : 0 }}%</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                                    <p class="text-sm font-semibold">Tidak ada transaksi terkonfirmasi</p>
                                </td>
                            </tr>
                            @endforelse
                            @if($per_metode->count() > 0)
                            <tr class="bg-green-50 font-bold border-t-2 border-green-500">
                                <td class="px-4 py-3 text-green-800">TOTAL</td>
                                <td class="px-4 py-3 text-right text-green-800 text-lg">{{ $total_transaksi_terkonfirmasi }}</td>
                                <td class="px-4 py-3 text-right text-green-600 text-lg">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-right text-green-800">100%</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Detail Transaksi - COMPACT -->
            <div class="mb-6">
                <h3 class="text-lg font-bold text-blue-950 mb-3 flex items-center">
                    <div class="bg-blue-950 p-1.5 rounded-lg mr-2">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                        </svg>
                    </div>
                    Detail Semua Transaksi
                </h3>
                <div class="overflow-x-auto border border-gray-200 rounded-lg shadow-sm">
                    <table class="w-full text-sm">
                        <thead class="bg-gradient-to-r from-blue-900 to-blue-800 text-white">
                            <tr>
                                <th class="px-4 py-3 text-left font-bold uppercase text-xs">No</th>
                                <th class="px-4 py-3 text-left font-bold uppercase text-xs">Tanggal</th>
                                <th class="px-4 py-3 text-left font-bold uppercase text-xs">Pelanggan</th>
                                <th class="px-4 py-3 text-left font-bold uppercase text-xs">Mobil</th>
                                <th class="px-4 py-3 text-center font-bold uppercase text-xs">Durasi</th>
                                <th class="px-4 py-3 text-right font-bold uppercase text-xs">Total</th>
                                <th class="px-4 py-3 text-center font-bold uppercase text-xs">Status</th>
                                <th class="px-4 py-3 text-center font-bold uppercase text-xs">✓</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($transaksis as $index => $transaksi)
                            <tr class="hover:bg-blue-50 transition {{ in_array($transaksi->status, ['confirmed', 'active', 'completed']) ? 'bg-green-50' : '' }}">
                                <td class="px-4 py-3 font-semibold text-blue-950">{{ ($transaksis->currentPage() - 1) * $transaksis->perPage() + $index + 1 }}</td>
                                <td class="px-4 py-3 font-semibold text-blue-950">{{ $transaksi->created_at->format('d/m/Y') }}</td>
                                <td class="px-4 py-3 font-semibold text-blue-950">{{ $transaksi->nama_lengkap }}</td>
                                <td class="px-4 py-3 font-semibold text-blue-950">{{ $transaksi->mobil->merek }} {{ $transaksi->mobil->model }}</td>
                                <td class="px-4 py-3 text-center font-semibold text-blue-950">{{ $transaksi->durasi }} hari</td>
                                <td class="px-4 py-3 text-right font-bold {{ in_array($transaksi->status, ['confirmed', 'active', 'completed']) ? 'text-green-600' : 'text-gray-400' }}">
                                    Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @if($transaksi->status == 'pending')
                                        <span class="px-2 py-1 text-xs font-bold rounded bg-yellow-100 text-yellow-800">Menunggu</span>
                                    @elseif($transaksi->status == 'paid')
                                        <span class="px-2 py-1 text-xs font-bold rounded bg-blue-100 text-blue-800">Konfirmasi</span>
                                    @elseif($transaksi->status == 'confirmed')
                                        <span class="px-2 py-1 text-xs font-bold rounded bg-green-100 text-green-800">Dikonfirmasi</span>
                                    @elseif($transaksi->status == 'active')
                                        <span class="px-2 py-1 text-xs font-bold rounded bg-purple-100 text-purple-800">Berlangsung</span>
                                    @elseif($transaksi->status == 'completed')
                                        <span class="px-2 py-1 text-xs font-bold rounded bg-gray-900 text-white">Selesai</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-bold rounded bg-red-100 text-red-800">Batal</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @if(in_array($transaksi->status, ['confirmed', 'active', 'completed']))
                                        <span class="text-green-600 font-bold">✅</span>
                                    @else
                                        <span class="text-gray-400">❌</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-4 py-8 text-center text-gray-500">
                                    <p class="text-sm font-semibold">Tidak ada transaksi pada periode ini</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4 no-print">
                    {{ $transaksis->links() }}
                </div>
            </div>

            <!-- Footer - COMPACT -->
            <div class="border-t-2 border-blue-950 pt-4 mt-6">
                <div class="flex justify-between items-center text-sm">
                    <div class="text-gray-700">
                        <p class="font-bold mb-1">📝 Catatan:</p>
                        <p class="text-xs">• Laporan dibuat otomatis oleh sistem</p>
                        <p class="text-xs">• Pendapatan = Confirmed + Active + Completed</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-blue-950">Administrator</p>
                        <p class="text-gray-700 font-semibold text-xs">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">Rental Mobil System</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- JavaScript untuk Toggle Filter -->
    <script>
        function togglePeriode() {
            const tipe = document.querySelector('input[name="tipe_periode"]:checked').value;
            
            document.getElementById('filter-harian').style.display = 'none';
            document.getElementById('filter-mingguan').style.display = 'none';
            document.getElementById('filter-bulanan').style.display = 'none';
            
            if (tipe === 'harian') {
                document.getElementById('filter-harian').style.display = 'block';
            } else if (tipe === 'mingguan') {
                document.getElementById('filter-mingguan').style.display = 'block';
            } else {
                document.getElementById('filter-bulanan').style.display = 'grid';
            }
        }
    </script>
</body>
</html>