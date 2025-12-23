<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengguna - {{ $user->name }}</title>
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
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h1 class="text-lg font-bold">Detail Pengguna</h1>
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
        <!-- Success/Error Messages - COMPACT -->
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

        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 mb-4 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <p class="font-semibold text-sm">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <div class="max-w-7xl mx-auto">
            <!-- Header Profile - COMPACT -->
            <div class="bg-white border border-blue-200 rounded-lg shadow-md p-4 mb-4">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between">
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="h-16 w-16 rounded-full bg-gradient-to-r from-blue-600 to-purple-600 flex items-center justify-center text-white text-2xl font-bold shadow-lg mr-4 border-2 border-white">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-blue-950 mb-1">{{ $user->name }}</h2>
                            <p class="text-gray-600 text-sm mb-2">{{ $user->email }}</p>
                            <div>
                                @if($user->role == 'admin')
                                    <span class="px-3 py-1 inline-flex text-xs font-bold rounded-lg bg-purple-100 text-purple-800 border border-purple-300">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/>
                                        </svg>
                                        Admin
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs font-bold rounded-lg bg-green-100 text-green-800 border border-green-300">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                        </svg>
                                        Pelanggan
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('admin.users.edit', $user->id) }}" 
                            class="bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-md hover:shadow-lg transition flex items-center justify-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                            </svg>
                            Edit User
                        </a>
                        @if($user->id != auth()->id())
                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus user ini?')"
                                class="w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-md hover:shadow-lg transition flex items-center justify-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                Hapus
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Statistik User - COMPACT -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <div class="bg-white border border-blue-200 rounded-lg shadow-md hover:shadow-lg p-4 transition">
                    <div class="flex flex-col items-center text-center">
                        <div class="bg-blue-100 p-3 rounded-lg mb-2">
                            <svg class="w-8 h-8 text-blue-700" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            </svg>
                        </div>
                        <p class="text-gray-600 text-xs font-bold uppercase mb-1">Total Pemesanan</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $totalPemesanan }}</p>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-300 rounded-lg shadow-md hover:shadow-lg p-4 transition">
                    <div class="flex flex-col items-center text-center">
                        <div class="bg-green-200 p-3 rounded-lg mb-2">
                            <svg class="w-8 h-8 text-green-700" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <p class="text-green-700 text-xs font-bold uppercase mb-1">Selesai</p>
                        <p class="text-2xl font-bold text-green-600">{{ $pemesananSelesai }}</p>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-300 rounded-lg shadow-md hover:shadow-lg p-4 transition">
                    <div class="flex flex-col items-center text-center">
                        <div class="bg-purple-200 p-3 rounded-lg mb-2">
                            <svg class="w-8 h-8 text-purple-700" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <p class="text-purple-700 text-xs font-bold uppercase mb-1">Aktif</p>
                        <p class="text-2xl font-bold text-purple-600">{{ $pemesananAktif }}</p>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 border border-yellow-300 rounded-lg shadow-md hover:shadow-lg p-4 transition">
                    <div class="flex flex-col items-center text-center">
                        <div class="bg-yellow-200 p-3 rounded-lg mb-2">
                            <svg class="w-8 h-8 text-yellow-700" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <p class="text-yellow-700 text-xs font-bold uppercase mb-1">Pending</p>
                        <p class="text-2xl font-bold text-yellow-600">{{ $pemesananPending }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Belanja - COMPACT -->
            <div class="bg-gradient-to-r from-green-600 to-green-700 border-2 border-green-500 text-white rounded-lg shadow-lg p-4 mb-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-xs font-bold uppercase mb-1">Total Belanja</p>
                        <p class="text-3xl font-bold mb-1">Rp {{ number_format($totalBelanja, 0, ',', '.') }}</p>
                        <p class="text-green-100 text-sm font-semibold">Dari pemesanan yang sudah dibayar</p>
                    </div>
                    <div class="bg-green-500 p-4 rounded-lg">
                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Grid Layout - COMPACT -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <!-- Info User - COMPACT -->
                <div class="lg:col-span-1">
                    <div class="bg-white border border-blue-200 rounded-lg shadow-md p-4 mb-4">
                        <h3 class="text-base font-bold text-blue-950 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            </svg>
                            Informasi User
                        </h3>
                        <div class="space-y-3">
                            <div class="border-b border-blue-200 pb-2">
                                <p class="text-gray-600 text-xs font-semibold mb-1">User ID</p>
                                <p class="font-bold text-blue-950 text-sm">#{{ $user->id }}</p>
                            </div>
                            <div class="border-b border-blue-200 pb-2">
                                <p class="text-gray-600 text-xs font-semibold mb-1">Nama Lengkap</p>
                                <p class="font-bold text-blue-950 text-sm">{{ $user->name }}</p>
                            </div>
                            <div class="border-b border-blue-200 pb-2">
                                <p class="text-gray-600 text-xs font-semibold mb-1">Email</p>
                                <p class="font-bold text-blue-950 text-sm">{{ $user->email }}</p>
                            </div>
                            <!-- ============================================ -->
                            <!-- FIELD NO HP (BARU) -->
                            <!-- ============================================ -->
                            <div class="border-b border-blue-200 pb-2">
                                <p class="text-gray-600 text-xs font-semibold mb-1">📱 No HP</p>
                                <p class="font-bold text-blue-950 text-sm">{{ $user->no_hp ?? '-' }}</p>
                            </div>
                            <div class="border-b border-blue-200 pb-2">
                                <p class="text-gray-600 text-xs font-semibold mb-1">Role</p>
                                <p class="font-bold text-blue-950 text-sm">{{ ucfirst($user->role) }}</p>
                            </div>
                            <div class="border-b border-blue-200 pb-2">
                                <p class="text-gray-600 text-xs font-semibold mb-1">Bergabung Sejak</p>
                                <p class="font-bold text-blue-950 text-sm">{{ $user->created_at->format('d M Y') }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $user->created_at->diffForHumans() }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-xs font-semibold mb-1">Terakhir Update</p>
                                <p class="font-bold text-blue-950 text-sm">{{ $user->updated_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats - COMPACT -->
                    <div class="bg-white border border-blue-200 rounded-lg shadow-md p-4">
                        <h3 class="text-base font-bold text-blue-950 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5z"/>
                            </svg>
                            Ringkasan
                        </h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center border-b border-blue-200 pb-2">
                                <span class="text-gray-700 font-semibold text-sm">Total Transaksi</span>
                                <span class="font-bold text-blue-950">{{ $totalPemesanan }}</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-blue-200 pb-2">
                                <span class="text-gray-700 font-semibold text-sm">Sukses Rate</span>
                                <span class="font-bold text-green-600">
                                    {{ $totalPemesanan > 0 ? round(($pemesananSelesai / $totalPemesanan) * 100, 1) : 0 }}%
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700 font-semibold text-sm">Rata-rata</span>
                                <span class="font-bold text-blue-600 text-sm">
                                    Rp {{ $totalPemesanan > 0 ? number_format($totalBelanja / $totalPemesanan, 0, ',', '.') : 0 }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Riwayat Transaksi - COMPACT -->
                <div class="lg:col-span-2">
                    <div class="bg-white border border-blue-200 rounded-lg shadow-md p-4">
                        <h3 class="text-lg font-bold text-blue-950 mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            </svg>
                            Riwayat Transaksi
                        </h3>

                        @if($pemesanans->count() > 0)
                            <div class="space-y-3">
                                @foreach($pemesanans as $pemesanan)
                                <div class="border border-blue-200 rounded-lg p-4 hover:shadow-md transition">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <div class="flex items-center space-x-2 mb-1">
                                                <h4 class="font-bold text-blue-950">#{{ str_pad($pemesanan->id, 6, '0', STR_PAD_LEFT) }}</h4>
                                                {!! $pemesanan->status_badge !!}
                                            </div>
                                            <p class="text-gray-700 font-semibold text-sm">{{ $pemesanan->mobil->merek }} {{ $pemesanan->mobil->model }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-green-600 text-lg">{{ $pemesanan->total_harga_format }}</p>
                                            <p class="text-xs text-gray-500 font-semibold">{{ $pemesanan->durasi }} hari</p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-3 mb-2 text-xs bg-blue-50 p-2 rounded-lg">
                                        <div>
                                            <p class="text-gray-600 font-semibold">Tanggal Sewa</p>
                                            <p class="font-bold text-blue-950">{{ $pemesanan->tanggal_mulai->format('d M Y') }}</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-600 font-semibold">Tanggal Selesai</p>
                                            <p class="font-bold text-blue-950">{{ $pemesanan->tanggal_selesai->format('d M Y') }}</p>
                                        </div>
                                    </div>

                                    <div class="flex justify-between items-center pt-2 border-t border-blue-200">
                                        <p class="text-xs text-gray-500">Dibuat: {{ $pemesanan->created_at->format('d M Y, H:i') }}</p>
                                        <a href="{{ route('admin.pemesanan.show', $pemesanan->id) }}" 
                                            class="text-blue-600 hover:text-blue-800 font-bold text-xs flex items-center">
                                            Lihat Detail
                                            <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- Pagination Info -->
                            <div class="mt-4 text-center text-xs text-gray-600 font-semibold">
                                Menampilkan {{ $pemesanans->count() }} transaksi terbaru
                            </div>
                        @else
                            <div class="text-center py-12">
                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                </svg>
                                <p class="text-gray-500 text-base font-bold mb-1">Belum ada transaksi</p>
                                <p class="text-gray-400 text-sm">User ini belum pernah melakukan pemesanan</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>