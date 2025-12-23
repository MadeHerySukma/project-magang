<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk #{{ $transaksi->id }} - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
        
        @media print {
            .no-print { display: none !important; }
            body { background: white; margin: 0; padding: 0; }
            .print-container { box-shadow: none !important; margin: 0 !important; border: none !important; max-width: 100% !important; }
            @page { margin: 0.5cm; }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar (No Print) - ALIGNED -->
    <nav class="bg-gradient-to-r from-blue-900 to-blue-800 text-white shadow-lg sticky top-0 z-50 no-print">
        <div class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <div class="bg-blue-500 p-1.5 rounded-lg">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                        </svg>
                    </div>
                    <h1 class="text-lg font-bold">Struk Transaksi #{{ str_pad($transaksi->id, 6, '0', STR_PAD_LEFT) }}</h1>
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

    <div class="container mx-auto px-6 py-4 no-print">
        <!-- Action Buttons (No Print) - COMPACT -->
        <div class="mb-4 flex space-x-2">
            <a href="{{ route('admin.transaksi.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow-md hover:shadow-lg transition flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                </svg>
                Kembali
            </a>
            <button onclick="window.print()" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow-md hover:shadow-lg transition flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd"/>
                </svg>
                Cetak Struk
            </button>
        </div>
    </div>

    <!-- Struk Container - ULTRA COMPACT -->
    <div class="max-w-4xl mx-auto bg-white border border-gray-200 rounded-lg shadow-lg print-container p-4">
        
        <!-- Header Struk - COMPACT -->
        <div class="text-center border-b-2 border-blue-900 pb-3 mb-4">
            <div class="bg-gradient-to-r from-blue-900 to-blue-800 rounded-lg p-3 mb-2">
                <div class="flex items-center justify-center mb-1">
                    <svg class="w-8 h-8 text-white mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3z"/>
                    </svg>
                    <h1 class="text-2xl font-bold text-white">RENTAL MOBIL</h1>
                </div>
                <p class="text-blue-200 text-xs font-semibold">Jl. Contoh No. 123, Denpasar, Bali | Telp: (0361) 123456</p>
            </div>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-2 inline-block">
                <p class="text-xs text-blue-800 font-bold uppercase">Struk Transaksi</p>
                <p class="text-xl font-bold text-blue-950">#{{ str_pad($transaksi->id, 6, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>

        <!-- Info Grid - COMPACT -->
        <div class="grid grid-cols-2 gap-3 mb-4">
            <!-- Informasi Transaksi -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                <h3 class="text-sm font-bold text-blue-950 mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                    </svg>
                    Informasi Transaksi
                </h3>
                <table class="w-full text-xs">
                    <tr class="border-b border-blue-200">
                        <td class="py-1 text-gray-700 font-semibold">No. Transaksi</td>
                        <td class="py-1 font-bold text-blue-950">: #{{ str_pad($transaksi->id, 6, '0', STR_PAD_LEFT) }}</td>
                    </tr>
                    <tr class="border-b border-blue-200">
                        <td class="py-1 text-gray-700 font-semibold">Tanggal</td>
                        <td class="py-1 font-semibold text-blue-950">: {{ $transaksi->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr class="border-b border-blue-200">
                        <td class="py-1 text-gray-700 font-semibold">Status</td>
                        <td class="py-1">: 
                            @if($transaksi->status == 'pending')
                                <span class="px-2 py-0.5 text-xs font-bold rounded bg-yellow-100 text-yellow-800">Menunggu</span>
                            @elseif($transaksi->status == 'paid')
                                <span class="px-2 py-0.5 text-xs font-bold rounded bg-blue-100 text-blue-800">Konfirmasi</span>
                            @elseif($transaksi->status == 'confirmed')
                                <span class="px-2 py-0.5 text-xs font-bold rounded bg-green-100 text-green-800">Dikonfirmasi</span>
                            @elseif($transaksi->status == 'active')
                                <span class="px-2 py-0.5 text-xs font-bold rounded bg-purple-100 text-purple-800">Berlangsung</span>
                            @elseif($transaksi->status == 'completed')
                                <span class="px-2 py-0.5 text-xs font-bold rounded bg-gray-100 text-gray-800">Selesai</span>
                            @else
                                <span class="px-2 py-0.5 text-xs font-bold rounded bg-red-100 text-red-800">Batal</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="py-1 text-gray-700 font-semibold">Metode</td>
                        <td class="py-1 font-semibold text-blue-950">: 
                            @if($transaksi->metode_pembayaran == 'transfer_bca') Transfer BCA
                            @elseif($transaksi->metode_pembayaran == 'transfer_bni') Transfer BNI
                            @elseif($transaksi->metode_pembayaran == 'transfer_mandiri') Transfer Mandiri
                            @elseif($transaksi->metode_pembayaran == 'va_bca') VA BCA
                            @elseif($transaksi->metode_pembayaran == 'va_bni') VA BNI
                            @elseif($transaksi->metode_pembayaran == 'va_mandiri') VA Mandiri
                            @else {{ $transaksi->metode_pembayaran }}
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Data Pelanggan -->
            <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                <h3 class="text-sm font-bold text-green-900 mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                    Data Pelanggan
                </h3>
                <table class="w-full text-xs">
                    <tr class="border-b border-green-200">
                        <td class="py-1 text-gray-700 font-semibold">Nama</td>
                        <td class="py-1 font-bold text-green-900">: {{ $transaksi->nama_lengkap }}</td>
                    </tr>
                    <tr class="border-b border-green-200">
                        <td class="py-1 text-gray-700 font-semibold">Email</td>
                        <td class="py-1 font-semibold text-green-900">: {{ $transaksi->user->email }}</td>
                    </tr>
                    <tr class="border-b border-green-200">
                        <td class="py-1 text-gray-700 font-semibold">Telepon</td>
                        <td class="py-1 font-semibold text-green-900">: {{ $transaksi->no_telepon }}</td>
                    </tr>
                    <tr>
                        <td class="py-1 text-gray-700 font-semibold">Alamat</td>
                        <td class="py-1 font-semibold text-green-900">: {{ $transaksi->alamat }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Detail Mobil - COMPACT -->
        <div class="mb-4">
            <h3 class="text-base font-bold text-blue-950 mb-2 flex items-center">
                <div class="bg-blue-950 p-1 rounded-lg mr-2">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                    </svg>
                </div>
                Detail Mobil
            </h3>
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-300 rounded-lg p-3">
                <div class="flex items-center">
                    @if($transaksi->mobil->foto_depan)
                        <img src="{{ asset('storage/' . $transaksi->mobil->foto_depan) }}" 
                             alt="{{ $transaksi->mobil->model }}" 
                             class="w-32 h-20 object-cover rounded-lg border-2 border-white shadow-md mr-4">
                    @else
                        <div class="w-32 h-20 bg-gray-200 rounded-lg border-2 border-white shadow-md mr-4 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                            </svg>
                        </div>
                    @endif
                    <div>
                        <h4 class="text-lg font-bold text-blue-950 mb-1">{{ $transaksi->mobil->merek }} {{ $transaksi->mobil->model }}</h4>
                        <div class="flex items-center space-x-2 text-gray-700 mb-1">
                            <span class="px-2 py-0.5 bg-white rounded-lg font-semibold text-xs border border-blue-200">{{ $transaksi->mobil->jenis }}</span>
                            <span class="px-2 py-0.5 bg-white rounded-lg font-semibold text-xs border border-blue-200">{{ $transaksi->mobil->tahun }}</span>
                        </div>
                        <p class="text-gray-700 font-semibold text-sm">Plat: <span class="text-blue-950 font-bold">{{ $transaksi->mobil->nomor_plat }}</span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Sewa - COMPACT -->
        <div class="mb-4">
            <h3 class="text-base font-bold text-blue-950 mb-2 flex items-center">
                <div class="bg-blue-950 p-1 rounded-lg mr-2">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                Detail Penyewaan
            </h3>
            <div class="overflow-x-auto border border-gray-200 rounded-lg shadow-sm">
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="bg-blue-50 border-b border-blue-200">
                            <td class="px-4 py-2 font-bold text-blue-950">Tanggal Mulai</td>
                            <td class="px-4 py-2 font-semibold text-blue-950">{{ \Carbon\Carbon::parse($transaksi->tanggal_mulai)->format('d/m/Y') }}</td>
                        </tr>
                        <tr class="bg-white border-b border-blue-200">
                            <td class="px-4 py-2 font-bold text-blue-950">Tanggal Selesai</td>
                            <td class="px-4 py-2 font-semibold text-blue-950">{{ \Carbon\Carbon::parse($transaksi->tanggal_selesai)->format('d/m/Y') }}</td>
                        </tr>
                        <tr class="bg-blue-50 border-b border-blue-200">
                            <td class="px-4 py-2 font-bold text-blue-950">Durasi Sewa</td>
                            <td class="px-4 py-2 text-blue-600 font-bold">{{ $transaksi->durasi }} Hari</td>
                        </tr>
                        <tr class="bg-white">
                            <td class="px-4 py-2 font-bold text-blue-950">Harga per Hari</td>
                            <td class="px-4 py-2 font-bold text-green-600">Rp {{ number_format($transaksi->mobil->harga_sewa, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Total Pembayaran - COMPACT -->
        <div class="border-t-2 border-blue-900 pt-3 mb-3">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-2">
                <div class="flex justify-between items-center">
                    <span class="text-sm font-bold text-gray-700">Subtotal ({{ $transaksi->durasi }} hari × Rp {{ number_format($transaksi->mobil->harga_sewa, 0, ',', '.') }})</span>
                    <span class="text-base font-bold text-blue-950">Rp {{ number_format($transaksi->mobil->harga_sewa * $transaksi->durasi, 0, ',', '.') }}</span>
                </div>
            </div>
            <div class="bg-gradient-to-r from-green-500 to-green-600 border-2 border-green-400 rounded-lg p-4 shadow-lg">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-green-100 text-xs font-bold uppercase mb-1">Total Pembayaran</p>
                        <p class="text-2xl font-bold text-white">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-green-400 p-3 rounded-lg">
                        <svg class="w-8 h-8 text-green-900" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer - COMPACT -->
        <div class="border-t-2 border-blue-900 pt-3">
            <div class="text-center">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-2">
                    <p class="text-sm font-bold text-blue-950 mb-1">✨ Terima kasih telah menggunakan layanan kami! ✨</p>
                    <p class="text-xs text-gray-700 mb-1">Dicetak: <strong>{{ now()->format('d/m/Y H:i:s') }}</strong></p>
                    <p class="text-xs text-gray-700">Admin: <strong>{{ auth()->user()->name }}</strong></p>
                </div>
                <p class="text-gray-600 italic text-xs">~ Sewa mobil dengan nyaman dan aman ~</p>
            </div>
        </div>

    </div>

    <script>
        // Auto print dialog jika ada parameter print
        if (window.location.search.includes('print=1')) {
            window.onload = function() {
                setTimeout(function() {
                    window.print();
                }, 500);
            }
        }
    </script>
</body>
</html>