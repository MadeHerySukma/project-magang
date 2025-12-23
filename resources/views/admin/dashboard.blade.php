<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Statistik Lengkap</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .stat-card { transition: all 0.3s ease; }
        .stat-card:hover { transform: translateY(-2px); }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar - ALIGNED & COMPACT -->
    <!-- Navbar - RESPONSIVE dengan Mobile Menu -->
<nav class="bg-gradient-to-r from-blue-900 to-blue-800 text-white shadow-lg sticky top-0 z-50">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="flex justify-between items-center py-3">
            <!-- Logo & Brand -->
            <div class="flex items-center space-x-2">
                <div class="bg-blue-500 p-1.5 rounded-lg">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                </div>
                <h1 class="text-base sm:text-lg font-bold">Admin Panel</h1>
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

<!-- JavaScript untuk Mobile Menu -->
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

    <!-- Main Content - COMPACT -->
    <div class="container mx-auto px-6 py-4">
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 mb-4 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <p class="font-semibold text-sm">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Header Section - COMPACT -->
        <div class="mb-6">
            <div class="bg-gradient-to-r from-blue-900 to-blue-800 rounded-lg shadow-md p-4 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-bold mb-1">📊 Dashboard Statistik</h2>
                        <p class="text-blue-200 text-sm">Laporan komprehensif performa rental mobil Anda</p>
                    </div>
                    <div class="text-right">
                        <p class="text-blue-300 text-xs">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Pemesanan Perlu Konfirmasi - COMPACT -->
        @if($perluKonfirmasi->count() > 0)
        <div class="bg-gradient-to-r from-orange-50 to-orange-100 border-l-4 border-orange-500 p-4 mb-4 rounded-lg shadow-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0 bg-orange-500 text-white p-2 rounded-full">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3 flex-1">
                    <h3 class="text-base font-bold text-orange-900 mb-1">{{ $perluKonfirmasi->count() }} Pemesanan Perlu Konfirmasi!</h3>
                    <p class="text-orange-800 text-sm mb-3">Ada pemesanan yang sudah upload bukti pembayaran dan menunggu verifikasi Anda.</p>
                    <a href="{{ route('admin.pemesanan.index') }}?status=paid" 
                        class="inline-flex items-center bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition shadow-md hover:shadow-lg">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                        </svg>
                        Lihat Pemesanan
                    </a>
                </div>
            </div>
        </div>
        @endif

        <!-- ============================================ -->
        <!-- ALERT PENGEMBALIAN HARI INI (BARU)          -->
        <!-- ============================================ -->
        @if(isset($totalPengembalianHariIni) && $totalPengembalianHariIni > 0)
        <div class="bg-gradient-to-r from-orange-50 to-orange-100 border-l-4 border-orange-500 p-4 mb-4 rounded-lg shadow-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0 bg-orange-500 text-white p-2 rounded-full">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3 flex-1">
                    <h3 class="text-base font-bold text-orange-900 mb-1">⏰ {{ $totalPengembalianHariIni }} Mobil Harus Dikembalikan Hari Ini!</h3>
                    <p class="text-orange-800 text-sm mb-3">Ada mobil yang masa sewanya berakhir hari ini. Kirim reminder ke penyewa.</p>
                    
                    <!-- Mini List (3 teratas) -->
                    @if($pengembalianHariIni->count() > 0)
                    <div class="bg-white rounded-lg p-3 mb-3">
                        @foreach($pengembalianHariIni->take(3) as $p)
                        <div class="flex justify-between items-center py-2 border-b border-orange-100 last:border-0">
                            <div>
                                <p class="text-sm font-semibold text-gray-800">{{ $p->nama_lengkap }}</p>
                                <p class="text-xs text-gray-600">{{ $p->mobil->merek }} {{ $p->mobil->model }} - {{ $p->mobil->plat_nomor }}</p>
                            </div>
                            <div class="text-right text-xs text-gray-600">
                                <p>📱 {{ $p->no_telepon }}</p>
                                @if($p->user && $p->user->email)
                                <p>📧 {{ $p->user->email }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    
                    <a href="{{ route('admin.pengembalian.index') }}" 
                        class="inline-flex items-center bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition shadow-md hover:shadow-lg">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        Kelola Pengembalian
                    </a>
                </div>
            </div>
        </div>
        @endif

        <!-- ============================================ -->
        <!-- ALERT WAITING LIST (BARU)                   -->
        <!-- ============================================ -->
        @if(isset($totalWaitingList) && $totalWaitingList > 0)
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 border-l-4 border-blue-500 p-4 mb-4 rounded-lg shadow-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0 bg-blue-500 text-white p-2 rounded-full">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3 flex-1">
                    <h3 class="text-base font-bold text-blue-900 mb-1">{{ $totalWaitingList }} Customer dalam Waiting List!</h3>
                    <p class="text-blue-800 text-sm mb-3">Ada customer yang menunggu mobil tersedia. Kirim notifikasi WhatsApp jika mobil sudah siap.</p>
                    <a href="{{ route('admin.waiting-list.index') }}" 
                        class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition shadow-md hover:shadow-lg">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        Kelola Waiting List
                    </a>
                </div>
            </div>
        </div>
        @endif

        <!-- SECTION 1: LAPORAN PERIODIK - COMPACT -->
        <div class="mb-6">
            <h3 class="text-lg font-bold text-blue-950 mb-4 flex items-center">
                <div class="bg-blue-950 p-1.5 rounded-lg mr-2">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                Laporan Periodik
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Hari Ini -->
                <div class="stat-card bg-white rounded-lg shadow-md hover:shadow-lg overflow-hidden border border-blue-100">
                    <div class="bg-gradient-to-br from-blue-600 to-blue-700 p-4 text-white">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="text-blue-100 text-xs font-bold uppercase">Hari Ini</p>
                                <p class="text-3xl font-bold mt-1">{{ $transaksiHariIni }}</p>
                                <p class="text-blue-100 text-xs mt-1">Transaksi</p>
                            </div>
                            <div class="bg-blue-500 p-2 rounded-lg">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 bg-gradient-to-br from-blue-50 to-white">
                        <p class="text-blue-950 text-xs font-semibold mb-1">Pendapatan</p>
                        <p class="text-lg font-bold text-blue-700 mb-3">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</p>
                        <a href="{{ route('admin.transaksi.index') }}" class="flex items-center justify-center bg-blue-950 hover:bg-blue-900 text-white py-2 rounded-lg text-sm font-semibold transition shadow-md">
                            Lihat Detail
                            <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Minggu Ini -->
                <div class="stat-card bg-white rounded-lg shadow-md hover:shadow-lg overflow-hidden border border-green-100">
                    <div class="bg-gradient-to-br from-green-600 to-green-700 p-4 text-white">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="text-green-100 text-xs font-bold uppercase">Minggu Ini</p>
                                <p class="text-3xl font-bold mt-1">{{ $transaksiMingguIni }}</p>
                                <p class="text-green-100 text-xs mt-1">Transaksi</p>
                            </div>
                            <div class="bg-green-500 p-2 rounded-lg">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 bg-gradient-to-br from-green-50 to-white">
                        <p class="text-green-950 text-xs font-semibold mb-1">Pendapatan</p>
                        <p class="text-lg font-bold text-green-700 mb-3">Rp {{ number_format($pendapatanMingguIni, 0, ',', '.') }}</p>
                        <a href="{{ route('admin.transaksi.laporan') }}" class="flex items-center justify-center bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg text-sm font-semibold transition shadow-md">
                            Lihat Laporan
                            <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Bulan Ini -->
                <div class="stat-card bg-white rounded-lg shadow-md hover:shadow-lg overflow-hidden border border-purple-100">
                    <div class="bg-gradient-to-br from-purple-600 to-purple-700 p-4 text-white">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="text-purple-100 text-xs font-bold uppercase">Bulan Ini</p>
                                <p class="text-3xl font-bold mt-1">{{ $transaksiBulanIni }}</p>
                                <p class="text-purple-100 text-xs mt-1">Transaksi</p>
                            </div>
                            <div class="bg-purple-500 p-2 rounded-lg">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 bg-gradient-to-br from-purple-50 to-white">
                        <p class="text-purple-950 text-xs font-semibold mb-1">Pendapatan</p>
                        <p class="text-lg font-bold text-purple-700 mb-1">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</p>
                        @if($pertumbuhanPendapatan >= 0)
                            <p class="text-xs text-green-600 font-semibold mb-2 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                                +{{ number_format($pertumbuhanPendapatan, 1) }}%
                            </p>
                        @else
                            <p class="text-xs text-red-600 font-semibold mb-2 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                {{ number_format($pertumbuhanPendapatan, 1) }}%
                            </p>
                        @endif
                        <a href="{{ route('admin.transaksi.laporan') }}?bulan={{ date('n') }}&tahun={{ date('Y') }}" class="flex items-center justify-center bg-purple-600 hover:bg-purple-700 text-white py-2 rounded-lg text-sm font-semibold transition shadow-md">
                            Detail Bulan
                            <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Tahun Ini -->
                <div class="stat-card bg-white rounded-lg shadow-md hover:shadow-lg overflow-hidden border border-orange-100">
                    <div class="bg-gradient-to-br from-orange-600 to-orange-700 p-4 text-white">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="text-orange-100 text-xs font-bold uppercase">Tahun {{ date('Y') }}</p>
                                <p class="text-3xl font-bold mt-1">{{ $transaksiTahunIni }}</p>
                                <p class="text-orange-100 text-xs mt-1">Transaksi</p>
                            </div>
                            <div class="bg-orange-500 p-2 rounded-lg">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 bg-gradient-to-br from-orange-50 to-white">
                        <p class="text-orange-950 text-xs font-semibold mb-1">Pendapatan</p>
                        <p class="text-lg font-bold text-orange-700 mb-3">Rp {{ number_format($pendapatanTahunIni, 0, ',', '.') }}</p>
                        <a href="{{ route('admin.transaksi.laporan') }}?tahun={{ date('Y') }}" class="flex items-center justify-center bg-orange-600 hover:bg-orange-700 text-white py-2 rounded-lg text-sm font-semibold transition shadow-md">
                            Laporan Tahunan
                            <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 2 & 3: GRAFIK & MOBIL TERLARIS - COMPACT -->
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 mb-6">
            <!-- Grafik Pendapatan (60%) -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-lg shadow-md p-4 border border-blue-100 h-full">
                    <h3 class="text-base font-bold text-blue-950 mb-4 flex items-center">
                        <div class="bg-blue-950 p-1.5 rounded-lg mr-2">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                            </svg>
                        </div>
                        Grafik Pendapatan 12 Bulan
                    </h3>
                    <div class="bg-gradient-to-br from-blue-50 to-white p-4 rounded-lg">
                        <canvas id="chartPendapatan" height="80"></canvas>
                    </div>
                </div>
            </div>

            <!-- Mobil Terlaris (40%) -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-4 border border-blue-100 h-full">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-base font-bold text-blue-950 flex items-center">
                            <div class="bg-yellow-400 p-1.5 rounded-lg mr-2">
                                <svg class="w-4 h-4 text-yellow-900" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                            <span class="text-sm">Top 5 Mobil</span>
                        </h3>
                        <a href="{{ route('admin.mobil.index') }}" class="text-blue-700 hover:text-blue-900 font-semibold text-xs flex items-center transition">
                            Semua
                            <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>

                    @if($mobilTerlaris->count() > 0)
                        <div class="space-y-2 max-h-80 overflow-y-auto pr-2">
                            @foreach($mobilTerlaris as $index => $mobil)
                            <div class="flex items-center p-2 bg-gradient-to-r from-blue-50 to-white rounded-lg hover:from-blue-100 hover:to-blue-50 transition border border-blue-100 shadow-sm">
                                <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center">
                                    @if($index == 0)
                                        <div class="text-2xl">🥇</div>
                                    @elseif($index == 1)
                                        <div class="text-2xl">🥈</div>
                                    @elseif($index == 2)
                                        <div class="text-2xl">🥉</div>
                                    @else
                                        <div class="bg-blue-950 text-white w-8 h-8 rounded-full flex items-center justify-center">
                                            <span class="text-sm font-bold">#{{ $index + 1 }}</span>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="flex-1 ml-2 min-w-0">
                                    <h4 class="text-xs font-bold text-blue-950 truncate">{{ $mobil->merek }} {{ $mobil->model }}</h4>
                                    <p class="text-xs text-gray-600">{{ $mobil->plat_nomor }}</p>
                                </div>
                                
                                <div class="text-right ml-2">
                                    <div class="bg-blue-950 text-white px-2 py-1 rounded-lg">
                                        <p class="text-lg font-bold">{{ $mobil->pemesanans_count }}</p>
                                        <p class="text-xs text-blue-200">sewa</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500 bg-gradient-to-br from-gray-50 to-white rounded-lg border-2 border-dashed border-gray-300">
                            <div class="text-4xl mb-2">🏁</div>
                            <p class="text-xs font-semibold text-gray-700">Belum ada data</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- SECTION 3: STATISTIK USERS, MOBIL & WAITING LIST - COMPACT -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="stat-card bg-white rounded-lg shadow-md hover:shadow-lg p-4 border border-blue-100">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase">Total Users</p>
                        <p class="text-2xl font-bold text-blue-950 mt-1">{{ $totalUsers }}</p>
                        <p class="text-xs text-gray-600 mt-1">
                            <span class="text-blue-700 font-semibold">{{ $totalAdmin }}</span> Admin • 
                            <span class="text-green-700 font-semibold">{{ $totalPelanggan }}</span> Pelanggan
                        </p>
                    </div>
                    <div class="bg-gradient-to-br from-blue-600 to-blue-700 p-3 rounded-lg">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                    </div>
                </div>
                <a href="{{ route('admin.users.index') }}" class="flex items-center justify-center bg-blue-950 hover:bg-blue-900 text-white py-2 rounded-lg text-sm font-semibold transition shadow-md">
                    Kelola Users
                    <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>

            <div class="stat-card bg-white rounded-lg shadow-md hover:shadow-lg p-4 border border-indigo-100">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase">Total Mobil</p>
                        <p class="text-2xl font-bold text-blue-950 mt-1">{{ $totalMobil }}</p>
                        <p class="text-xs text-gray-600 mt-1">
                            <span class="text-green-700 font-semibold">{{ $mobilTersedia }}</span> Tersedia • 
                            <span class="text-red-700 font-semibold">{{ $mobilDisewa }}</span> Disewa
                        </p>
                    </div>
                    <div class="bg-gradient-to-br from-indigo-600 to-indigo-700 p-3 rounded-lg">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3z"/>
                        </svg>
                    </div>
                </div>
                <a href="{{ route('admin.mobil.index') }}" class="flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg text-sm font-semibold transition shadow-md">
                    Kelola Mobil
                    <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>

            <!-- ============================================ -->
            <!-- CARD WAITING LIST (BARU)                    -->
            <!-- ============================================ -->
            <div class="stat-card bg-white rounded-lg shadow-md hover:shadow-lg p-4 border border-cyan-100">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase">Waiting List</p>
                        <p class="text-2xl font-bold text-blue-950 mt-1">{{ $totalWaitingList ?? 0 }}</p>
                        <p class="text-xs text-gray-600 mt-1">
                            <span class="text-blue-700 font-semibold">{{ $waitingListWaiting ?? 0 }}</span> Menunggu • 
                            <span class="text-green-700 font-semibold">{{ $waitingListNotified ?? 0 }}</span> Dihubungi
                        </p>
                    </div>
                    <div class="bg-gradient-to-br from-cyan-600 to-cyan-700 p-3 rounded-lg">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
                <a href="{{ route('admin.waiting-list.index') }}" class="flex items-center justify-center bg-cyan-600 hover:bg-cyan-700 text-white py-2 rounded-lg text-sm font-semibold transition shadow-md">
                    Kelola Waiting List
                    <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>

            <div class="stat-card bg-gradient-to-br from-green-600 to-teal-600 text-white rounded-lg shadow-md hover:shadow-lg p-4">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <p class="text-green-100 text-xs font-bold uppercase">Total Pendapatan</p>
                        <p class="text-2xl font-bold mt-1">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                        <p class="text-xs text-green-100 mt-1">Dari transaksi selesai</p>
                    </div>
                    <div class="bg-green-500 p-3 rounded-lg">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582z"/>
                        </svg>
                    </div>
                </div>
                <a href="{{ route('admin.transaksi.laporan') }}" class="flex items-center justify-center bg-green-700 hover:bg-green-800 text-white py-2 rounded-lg text-sm font-semibold transition shadow-md">
                    Lihat Laporan
                    <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- SECTION 4: STATISTIK PEMESANAN - COMPACT -->
        <div class="mb-6">
            <h3 class="text-lg font-bold text-blue-950 mb-4 flex items-center">
                <div class="bg-blue-950 p-1.5 rounded-lg mr-2">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3z"/>
                    </svg>
                </div>
                Statistik Pemesanan
            </h3>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3">
                <a href="{{ route('admin.pemesanan.index') }}" class="stat-card bg-white rounded-lg shadow-md hover:shadow-lg p-4 border border-gray-200 text-center">
                    <div class="bg-gray-100 w-10 h-10 rounded-full flex items-center justify-center mx-auto mb-2">
                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                        </svg>
                    </div>
                    <p class="text-gray-600 text-xs font-bold uppercase mb-1">Total</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalPemesanan }}</p>
                </a>

                <a href="{{ route('admin.pemesanan.index') }}?status=pending" class="stat-card bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-lg shadow-md hover:shadow-lg p-4 border border-yellow-200 text-center">
                    <div class="bg-yellow-200 w-10 h-10 rounded-full flex items-center justify-center mx-auto mb-2">
                        <svg class="w-5 h-5 text-yellow-700" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <p class="text-yellow-700 text-xs font-bold uppercase mb-1">Pending</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ $pemesananPending }}</p>
                </a>

                <a href="{{ route('admin.pemesanan.index') }}?status=paid" class="stat-card bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg shadow-md hover:shadow-lg p-4 border border-blue-200 text-center">
                    <div class="bg-blue-200 w-10 h-10 rounded-full flex items-center justify-center mx-auto mb-2">
                        <svg class="w-5 h-5 text-blue-700" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                        </svg>
                    </div>
                    <p class="text-blue-700 text-xs font-bold uppercase mb-1">Konfirmasi</p>
                    <p class="text-2xl font-bold text-blue-600">{{ $pemesananPaid }}</p>
                </a>

                <a href="{{ route('admin.pemesanan.index') }}?status=confirmed" class="stat-card bg-gradient-to-br from-green-50 to-green-100 rounded-lg shadow-md hover:shadow-lg p-4 border border-green-200 text-center">
                    <div class="bg-green-200 w-10 h-10 rounded-full flex items-center justify-center mx-auto mb-2">
                        <svg class="w-5 h-5 text-green-700" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <p class="text-green-700 text-xs font-bold uppercase mb-1">Konfirmasi</p>
                    <p class="text-2xl font-bold text-green-600">{{ $pemesananConfirmed }}</p>
                </a>

                <a href="{{ route('admin.pemesanan.index') }}?status=active" class="stat-card bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg shadow-md hover:shadow-lg p-4 border border-purple-200 text-center">
                    <div class="bg-purple-200 w-10 h-10 rounded-full flex items-center justify-center mx-auto mb-2">
                        <svg class="w-5 h-5 text-purple-700" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                        </svg>
                    </div>
                    <p class="text-purple-700 text-xs font-bold uppercase mb-1">Aktif</p>
                    <p class="text-2xl font-bold text-purple-600">{{ $pemesananActive }}</p>
                </a>

                <a href="{{ route('admin.pemesanan.index') }}?status=completed" class="stat-card bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg shadow-md hover:shadow-lg p-4 border border-gray-200 text-center">
                    <div class="bg-gray-200 w-10 h-10 rounded-full flex items-center justify-center mx-auto mb-2">
                        <svg class="w-5 h-5 text-gray-700" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <p class="text-gray-700 text-xs font-bold uppercase mb-1">Selesai</p>
                    <p class="text-2xl font-bold text-gray-600">{{ $pemesananCompleted }}</p>
                </a>
            </div>
        </div>

        <!-- SECTION 5: QUICK ACTIONS & PEMESANAN TERBARU - COMPACT -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <!-- Quick Actions -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-4 border border-blue-100">
                    <h3 class="text-base font-bold text-blue-950 mb-4 flex items-center">
                        <div class="bg-blue-950 p-1.5 rounded-lg mr-2">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        Quick Actions
                    </h3>
                    <div class="space-y-2">
                        <a href="{{ route('admin.pemesanan.index') }}" class="flex items-center justify-between bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-3 rounded-lg transition shadow-md text-sm">
                            <span class="font-semibold">📦 Kelola Pemesanan</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                        <a href="{{ route('admin.mobil.index') }}" class="flex items-center justify-between bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-4 py-3 rounded-lg transition shadow-md text-sm">
                            <span class="font-semibold">🚗 Manajemen Mobil</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                        <a href="{{ route('admin.waiting-list.index') }}" class="flex items-center justify-between bg-gradient-to-r from-cyan-600 to-cyan-700 hover:from-cyan-700 hover:to-cyan-800 text-white px-4 py-3 rounded-lg transition shadow-md text-sm">
                            <span class="font-semibold">⏳ Waiting List</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                        <a href="{{ route('admin.pemesanan.index') }}?status=paid" class="flex items-center justify-between bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white px-4 py-3 rounded-lg transition shadow-md text-sm">
                            <span class="font-semibold">⚠️ Konfirmasi Pembayaran</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                        <a href="{{ route('admin.transaksi.laporan') }}" class="flex items-center justify-between bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white px-4 py-3 rounded-lg transition shadow-md text-sm">
                            <span class="font-semibold">📊 Laporan Lengkap</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
 
            <!-- Pemesanan Terbaru -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-4 border border-blue-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-base font-bold text-blue-950 flex items-center">
                            <div class="bg-blue-950 p-1.5 rounded-lg mr-2">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                </svg>
                            </div>
                            2 Pemesanan Terbaru
                        </h3>
                        <a href="{{ route('admin.pemesanan.index') }}" class="text-blue-700 hover:text-blue-900 font-semibold text-xs flex items-center transition">
                            Lihat Semua
                            <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>

                    @if($pemesananTerbaru->count() > 0)
                        <div class="space-y-3">
                            @foreach($pemesananTerbaru as $pemesanan)
                            <div class="border-b border-gray-100 pb-3 last:border-b-0 hover:bg-blue-50 p-3 rounded-lg transition">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-2 mb-2">
                                            <span class="bg-blue-950 text-white px-2 py-1 rounded-lg text-xs font-bold">#{{ str_pad($pemesanan->id, 6, '0', STR_PAD_LEFT) }}</span>
                                            {!! $pemesanan->status_badge !!}
                                        </div>
                                        <p class="text-sm text-gray-800 font-semibold">
                                            {{ $pemesanan->user->name }}
                                        </p>
                                        <p class="text-xs text-gray-600 mt-1">
                                            🚗 {{ $pemesanan->mobil->merek }} {{ $pemesanan->mobil->model }}
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            📅 {{ $pemesanan->tanggal_mulai->format('d M') }} - {{ $pemesanan->tanggal_selesai->format('d M Y') }}
                                        </p>
                                    </div>
                                    <div class="text-right ml-3">
                                        <p class="text-lg font-bold text-green-600">{{ $pemesanan->total_harga_format }}</p>
                                        <a href="{{ route('admin.pemesanan.show', $pemesanan->id) }}" 
                                            class="inline-flex items-center text-xs text-blue-700 hover:text-blue-900 font-semibold mt-1 transition">
                                            Detail
                                            <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500 bg-gradient-to-br from-gray-50 to-white rounded-lg">
                            <span class="text-5xl">📦</span>
                            <p class="mt-3 text-sm font-semibold">Belum ada pemesanan</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script>
        const chartLabels = @json($chartLabels);
        const chartData = @json($chartPendapatan);

        const ctx = document.getElementById('chartPendapatan').getContext('2d');
        const chartPendapatan = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: chartData,
                    borderColor: 'rgb(30, 58, 138)',
                    backgroundColor: 'rgba(30, 58, 138, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgb(30, 58, 138)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: { size: 12, weight: 'bold', family: 'Inter' },
                            color: '#172554',
                            padding: 15
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(23, 37, 84, 0.95)',
                        padding: 10,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            },
                            font: { size: 11 },
                            color: '#64748b'
                        },
                        grid: { color: 'rgba(148, 163, 184, 0.1)' }
                    },
                    x: {
                        ticks: { font: { size: 11 }, color: '#64748b' },
                        grid: { display: false }
                    }
                }
            }
        });
    </script>
</body>
</html>