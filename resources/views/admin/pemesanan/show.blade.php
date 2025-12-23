<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pemesanan #{{ str_pad($pemesanan->id, 6, '0', STR_PAD_LEFT) }} - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar - ALIGNED -->
    <nav class="bg-gradient-to-r from-blue-900 to-blue-800 text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <div class="bg-blue-500 p-1.5 rounded-lg">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h1 class="text-lg font-bold">Detail Pemesanan</h1>
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
        <div class="max-w-7xl mx-auto">
            <!-- Success/Error Messages -->
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

            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 mb-4 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <p class="font-semibold text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <!-- Header - COMPACT -->
            <div class="bg-gradient-to-r from-blue-900 to-blue-800 rounded-lg shadow-md p-4 text-white mb-4">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div>
                        <h2 class="text-xl font-bold mb-1">
                            Pemesanan #{{ str_pad($pemesanan->id, 6, '0', STR_PAD_LEFT) }}
                        </h2>
                        <p class="text-blue-200 text-sm">{{ $pemesanan->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="mt-2 md:mt-0">
                        {!! $pemesanan->status_badge !!}
                    </div>
                </div>
            </div>

            <!-- Action Buttons - COMPACT -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4 mb-4">
                <h3 class="text-base font-bold text-blue-950 mb-3 flex items-center">
                    <div class="bg-blue-900 p-1 rounded mr-2">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    Tindakan Cepat
                </h3>
                <div class="flex flex-wrap gap-2">
                    @if($pemesanan->status == 'paid')
                        <form method="POST" action="{{ route('admin.pemesanan.konfirmasi', $pemesanan->id) }}" class="inline">
                            @csrf
                            <button type="submit" onclick="return confirm('Konfirmasi pembayaran ini?')"
                                class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-4 py-2 rounded-lg font-bold text-sm shadow-md hover:shadow-lg transition flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Konfirmasi
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.pemesanan.tolak', $pemesanan->id) }}" class="inline">
                            @csrf
                            <button type="submit" onclick="return confirm('Tolak pembayaran ini?')"
                                class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-4 py-2 rounded-lg font-bold text-sm shadow-md hover:shadow-lg transition flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd"/>
                                </svg>
                                Tolak
                            </button>
                        </form>
                    @endif

                    @if($pemesanan->status == 'confirmed')
                        <form method="POST" action="{{ route('admin.pemesanan.mulai', $pemesanan->id) }}" class="inline">
                            @csrf
                            <button type="submit" onclick="return confirm('Mulai sewa ini?')"
                                class="bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white px-4 py-2 rounded-lg font-bold text-sm shadow-md hover:shadow-lg transition flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                                </svg>
                                Mulai Sewa
                            </button>
                        </form>
                    @endif

                    @if($pemesanan->status == 'active')
                        <form method="POST" action="{{ route('admin.pemesanan.selesai', $pemesanan->id) }}" class="inline">
                            @csrf
                            <button type="submit" onclick="return confirm('Selesaikan sewa ini?')"
                                class="bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white px-4 py-2 rounded-lg font-bold text-sm shadow-md hover:shadow-lg transition flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Selesaikan
                            </button>
                        </form>
                    @endif

                    @if(in_array($pemesanan->status, ['pending', 'paid', 'confirmed']))
                        <form method="POST" action="{{ route('admin.pemesanan.batal', $pemesanan->id) }}" class="inline">
                            @csrf
                            <button type="submit" onclick="return confirm('Batalkan pemesanan ini?')"
                                class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-4 py-2 rounded-lg font-bold text-sm shadow-md hover:shadow-lg transition flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd"/>
                                </svg>
                                Batalkan
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <!-- LEFT COLUMN - COMPACT -->
                <div class="lg:col-span-1 space-y-4">
                    <!-- Info Pelanggan -->
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                        <h3 class="text-base font-bold text-blue-950 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                            Info Pelanggan
                        </h3>
                        <div class="space-y-3">
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                                <p class="text-xs text-blue-700 font-bold uppercase mb-0.5">Nama User</p>
                                <p class="font-bold text-blue-950 text-sm">{{ $pemesanan->user->name }}</p>
                            </div>
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                                <p class="text-xs text-blue-700 font-bold uppercase mb-0.5">Email</p>
                                <p class="font-semibold text-blue-950 text-sm">{{ $pemesanan->user->email }}</p>
                            </div>
                            
                            <!-- NOMOR TELEPON UTAMA -->
                            <div class="bg-green-50 border-2 border-green-300 rounded-lg p-3">
                                <p class="text-xs text-green-700 font-bold uppercase mb-0.5 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                    </svg>
                                    No. Telepon Utama
                                </p>
                                <p class="font-bold text-green-700 text-base">{{ $pemesanan->no_telepon }}</p>
                                <small class="text-green-600 text-xs">Nomor terdaftar WhatsApp</small>
                            </div>

                            <!-- NOMOR TELEPON ALTERNATIF (jika ada) -->
                            @if($pemesanan->hasAlternativePhone())
                            <div class="bg-blue-50 border-2 border-blue-300 rounded-lg p-3">
                                <p class="text-xs text-blue-700 font-bold uppercase mb-0.5 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                    </svg>
                                    No. Telepon Alternatif
                                </p>
                                <p class="font-bold text-blue-700 text-base">{{ $pemesanan->no_telepon_alternatif }}</p>
                                <small class="text-blue-600 text-xs">Nomor kontak cadangan</small>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Mobil - COMPACT -->
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                        <h3 class="text-base font-bold text-blue-950 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                            </svg>
                            Mobil
                        </h3>
                        
                        @php
                            $foto = $pemesanan->mobil->foto_depan ?? $pemesanan->mobil->foto_belakang ?? $pemesanan->mobil->foto_interior;
                        @endphp
                        
                        <div class="mb-3 bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg overflow-hidden shadow-sm">
                            @if($foto)
                                <img src="{{ asset('storage/' . $foto) }}" alt="{{ $pemesanan->mobil->model }}" class="w-full h-32 object-cover">
                            @else
                                <div class="w-full h-32 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <h4 class="text-lg font-bold text-blue-950">{{ $pemesanan->mobil->merek }}</h4>
                        <p class="text-gray-600 mb-3 text-sm">{{ $pemesanan->mobil->model }}</p>

                        <div class="space-y-2">
                            <div class="flex justify-between items-center bg-blue-50 border border-blue-200 rounded p-2">
                                <span class="text-blue-700 font-semibold text-xs">Jenis</span>
                                <span class="font-bold text-blue-950 text-sm">{{ $pemesanan->mobil->jenis }}</span>
                            </div>
                            <div class="flex justify-between items-center bg-blue-50 border border-blue-200 rounded p-2">
                                <span class="text-blue-700 font-semibold text-xs">Tahun</span>
                                <span class="font-bold text-blue-950 text-sm">{{ $pemesanan->mobil->tahun }}</span>
                            </div>
                            <div class="flex justify-between items-center bg-blue-50 border border-blue-200 rounded p-2">
                                <span class="text-blue-700 font-semibold text-xs">Plat Nomor</span>
                                <span class="font-bold text-blue-950 text-sm">{{ $pemesanan->mobil->nomor_plat }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Biaya - COMPACT -->
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                        <h3 class="text-base font-bold text-blue-950 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                            </svg>
                            Rincian Biaya
                        </h3>
                        
                        <div class="space-y-2 mb-3">
                            <div class="flex justify-between items-center bg-blue-50 border border-blue-200 rounded p-2">
                                <span class="text-blue-700 font-semibold text-xs">Harga/Hari</span>
                                <span class="font-bold text-blue-950 text-sm">{{ $pemesanan->harga_per_hari_format }}</span>
                            </div>
                            <div class="flex justify-between items-center bg-blue-50 border border-blue-200 rounded p-2">
                                <span class="text-blue-700 font-semibold text-xs">Durasi</span>
                                <span class="font-bold text-blue-950 text-sm">{{ $pemesanan->durasi }} Hari</span>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-green-600 to-green-700 border-2 border-green-500 rounded-lg p-4 shadow-md">
                            <p class="text-green-100 text-xs font-bold mb-0.5 uppercase">Total Pembayaran</p>
                            <p class="text-2xl font-bold text-white">{{ $pemesanan->total_harga_format }}</p>
                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN - COMPACT -->
                <div class="lg:col-span-2 space-y-4">
                    <!-- Jadwal - COMPACT -->
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                        <h3 class="text-base font-bold text-blue-950 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                            Jadwal Sewa
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg p-4 shadow-md text-white">
                                <p class="text-blue-200 text-xs font-bold uppercase mb-1">Tanggal Mulai</p>
                                <p class="text-3xl font-bold mb-0.5">{{ $pemesanan->tanggal_mulai->format('d') }}</p>
                                <p class="text-base font-semibold">{{ $pemesanan->tanggal_mulai->format('M Y') }}</p>
                            </div>
                            <div class="bg-gradient-to-br from-green-600 to-green-700 rounded-lg p-4 shadow-md text-white">
                                <p class="text-green-200 text-xs font-bold uppercase mb-1">Tanggal Selesai</p>
                                <p class="text-3xl font-bold mb-0.5">{{ $pemesanan->tanggal_selesai->format('d') }}</p>
                                <p class="text-base font-semibold">{{ $pemesanan->tanggal_selesai->format('M Y') }}</p>
                            </div>
                        </div>

                        <div class="mt-3 bg-blue-50 border border-blue-300 rounded-lg p-3 text-center">
                            <p class="text-blue-700 font-semibold text-xs mb-0.5">Durasi Total</p>
                            <p class="text-2xl font-bold text-blue-950">{{ $pemesanan->durasi }} Hari</p>
                        </div>
                    </div>

                    <!-- Data Penyewa - COMPACT -->
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                        <h3 class="text-base font-bold text-blue-950 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                            </svg>
                            Data Penyewa
                        </h3>
                        
                        <div class="space-y-3">
                            <div class="grid grid-cols-2 gap-3">
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                                    <p class="text-xs text-blue-700 font-bold uppercase mb-1">Nama Lengkap</p>
                                    <p class="font-bold text-blue-950 text-sm">{{ $pemesanan->nama_lengkap }}</p>
                                </div>
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                                    <p class="text-xs text-blue-700 font-bold uppercase mb-1">NIK</p>
                                    <p class="font-bold text-blue-950 text-sm">{{ $pemesanan->nik }}</p>
                                </div>
                            </div>
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                                <p class="text-xs text-blue-700 font-bold uppercase mb-1">Alamat</p>
                                <p class="text-gray-800 text-sm">{{ $pemesanan->alamat }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-blue-950 font-bold mb-2 uppercase">Foto KTP</p>
                                <img src="{{ asset('storage/' . $pemesanan->foto_ktp) }}" 
                                    alt="KTP" 
                                    class="w-full rounded-lg shadow-md cursor-pointer hover:shadow-lg transition border border-blue-200"
                                    onclick="window.open(this.src, '_blank')">
                                <p class="text-xs text-blue-600 mt-1 font-semibold">💡 Klik gambar untuk memperbesar</p>
                            </div>
                        </div>
                    </div>

                    <!-- Pembayaran - COMPACT -->
                    @if($pemesanan->metode_pembayaran)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                        <h3 class="text-base font-bold text-blue-950 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                            </svg>
                            Info Pembayaran
                        </h3>
                        
                        <div class="space-y-3">
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                                <p class="text-xs text-blue-700 font-bold uppercase mb-1">Metode Pembayaran</p>
                                <p class="font-bold text-blue-950 text-sm">
                                    @if($pemesanan->metode_pembayaran == 'transfer_bca') Transfer Bank BCA
                                    @elseif($pemesanan->metode_pembayaran == 'transfer_bni') Transfer Bank BNI
                                    @elseif($pemesanan->metode_pembayaran == 'transfer_mandiri') Transfer Bank Mandiri
                                    @elseif($pemesanan->metode_pembayaran == 'va_bca') Virtual Account BCA
                                    @elseif($pemesanan->metode_pembayaran == 'va_bni') Virtual Account BNI
                                    @elseif($pemesanan->metode_pembayaran == 'va_mandiri') Virtual Account Mandiri
                                    @endif
                                </p>
                            </div>

                            @if($pemesanan->bukti_pembayaran)
                            <div>
                                <p class="text-xs text-blue-950 font-bold mb-2 uppercase">Bukti Pembayaran</p>
                                <img src="{{ asset('storage/' . $pemesanan->bukti_pembayaran) }}" 
                                    alt="Bukti Pembayaran" 
                                    class="w-full rounded-lg shadow-md cursor-pointer hover:shadow-lg transition border border-blue-200"
                                    onclick="window.open(this.src, '_blank')">
                                <p class="text-xs text-blue-600 mt-1 font-semibold">💡 Klik gambar untuk memperbesar</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Catatan -->
                    @if($pemesanan->catatan)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                        <h3 class="text-base font-bold text-blue-950 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                            </svg>
                            Catatan
                        </h3>
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                            <p class="text-gray-800 text-sm whitespace-pre-line">{{ $pemesanan->catatan }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Timeline - COMPACT -->
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                        <h3 class="text-base font-bold text-blue-950 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                            Timeline Status
                        </h3>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-white mr-3 flex-shrink-0 shadow-sm">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="flex-1 bg-green-50 border border-green-200 rounded p-3">
                                    <p class="font-bold text-green-900 text-sm">Pemesanan Dibuat</p>
                                    <p class="text-xs text-green-700">{{ $pemesanan->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>

                            @if($pemesanan->status !== 'pending')
                            <div class="flex items-start">
                                <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-white mr-3 flex-shrink-0 shadow-sm">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="flex-1 bg-green-50 border border-green-200 rounded p-3">
                                    <p class="font-bold text-green-900 text-sm">Pembayaran Diterima</p>
                                    <p class="text-xs text-green-700">Status: {{ $pemesanan->status_text }}</p>
                                </div>
                            </div>
                            @endif

                            @if(in_array($pemesanan->status, ['confirmed', 'active', 'completed']))
                            <div class="flex items-start">
                                <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-white mr-3 flex-shrink-0 shadow-sm">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="flex-1 bg-green-50 border border-green-200 rounded p-3">
                                    <p class="font-bold text-green-900 text-sm">Pembayaran Dikonfirmasi</p>
                                    <p class="text-xs text-green-700">Oleh Admin</p>
                                </div>
                            </div>
                            @endif

                            @if(in_array($pemesanan->status, ['active', 'completed']))
                            <div class="flex items-start">
                                <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-white mr-3 flex-shrink-0 shadow-sm">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="flex-1 bg-green-50 border border-green-200 rounded p-3">
                                    <p class="font-bold text-green-900 text-sm">Sewa Dimulai</p>
                                    <p class="text-xs text-green-700">Mobil sedang disewa</p>
                                </div>
                            </div>
                            @endif

                            @if($pemesanan->status == 'completed')
                            <div class="flex items-start">
                                <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-white mr-3 flex-shrink-0 shadow-sm">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="flex-1 bg-green-50 border border-green-200 rounded p-3">
                                    <p class="font-bold text-green-900 text-sm">Sewa Selesai</p>
                                    <p class="text-xs text-green-700">{{ $pemesanan->updated_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                            @endif

                            @if($pemesanan->status == 'cancelled')
                            <div class="flex items-start">
                                <div class="w-8 h-8 rounded-full bg-red-500 flex items-center justify-center text-white mr-3 flex-shrink-0 shadow-sm">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="flex-1 bg-red-50 border border-red-200 rounded p-3">
                                    <p class="font-bold text-red-900 text-sm">Dibatalkan</p>
                                    <p class="text-xs text-red-700">{{ $pemesanan->updated_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>