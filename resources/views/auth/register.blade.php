<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - PT Rental Mobil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 50%, #3b82f6 100%); }
        .logo-shadow { filter: drop-shadow(0 8px 15px rgba(0, 0, 0, 0.2)); }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-5xl grid md:grid-cols-2 gap-6 items-center">
        
        <!-- Left Side - Branding - COMPACT -->
        <div class="hidden md:block text-white">
            <div class="mb-6 logo-shadow">
                {{-- Membungkus seluruh elemen logo dan teks di dalam tag <a> dengan class 'group' --}}
                <a href="{{ url('/') }}" class="flex items-center group">
                    
                    {{-- Ikon Mobil: Tambahkan group-hover:shadow-lg dan group-hover:scale-105 untuk indikasi klik --}}
                    <div class="bg-white p-3 rounded-xl shadow-lg transition duration-200 group-hover:shadow-xl group-hover:scale-105 transform">
                        <svg class="w-12 h-12 text-blue-950" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                        </svg>
                    </div>
                    
                    <div class="ml-3">
                        {{-- Teks: Tambahkan group-hover:text-blue-100 dan transition --}}
                        <h1 class="text-2xl font-bold transition duration-200 group-hover:text-blue-100">PT Rental Mobil</h1>
                        <p class="text-blue-200 text-sm">Your Trusted Car Rental Partner</p>
                    </div>
                </a>
            </div>
            
            <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 border border-white/20">
                <h2 class="text-2xl font-bold mb-3">Bergabunglah Bersama Kami! 🎉</h2>
                <p class="text-blue-100 text-sm mb-4 leading-relaxed">
                    Daftar sekarang di <strong>PT Rental Mobil</strong> dan nikmati kemudahan menyewa mobil 
                    dengan layanan terbaik, harga kompetitif, dan armada lengkap untuk segala kebutuhan Anda.
                </p>
                
                <div class="space-y-3">
                    <div class="flex items-start">
                        <div class="bg-green-500 p-1.5 rounded-lg mr-2 flex-shrink-0">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-sm">Gratis & Mudah</p>
                            <p class="text-blue-200 text-xs">Pendaftaran cepat tanpa biaya apapun</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-green-500 p-1.5 rounded-lg mr-2 flex-shrink-0">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-sm">Promo Spesial</p>
                            <p class="text-blue-200 text-xs">Dapatkan diskon untuk member baru</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-green-500 p-1.5 rounded-lg mr-2 flex-shrink-0">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-sm">Akses Penuh</p>
                            <p class="text-blue-200 text-xs">Kelola booking dan riwayat transaksi Anda</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="bg-green-500 p-1.5 rounded-lg mr-2 flex-shrink-0">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-sm">Data Aman</p>
                            <p class="text-blue-200 text-xs">Privasi dan keamanan data terjamin</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Register Form - COMPACT -->
        <div class="bg-white rounded-2xl shadow-xl p-5 md:p-6">
            <!-- Mobile Logo - COMPACT -->
            <div class="md:hidden text-center mb-4">
            {{-- Membungkus seluruh elemen logo dan teks di dalam tag <a> --}}
            <a href="{{ url('/') }}" class="inline-block text-center group"> 
                
                {{-- Ikon Mobil: Tambahkan group-hover:bg-blue-800 untuk indikasi klik --}}
                <div class="inline-flex items-center justify-center bg-blue-950 p-2.5 rounded-xl mb-2 transition duration-200 group-hover:bg-blue-800">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                    </svg>
                </div>
                
                <h2 class="text-xl font-bold text-blue-950 transition duration-200 group-hover:text-blue-700">PT Rental Mobil</h2>
                <p class="text-gray-600 text-xs">Your Trusted Partner</p>
            </a>
        </div>

            <div class="text-center mb-4">
                <h1 class="text-xl font-bold text-blue-950 mb-1">Daftar Akun Baru</h1>
                <p class="text-xs text-gray-600">Buat akun pelanggan untuk memulai</p>
            </div>

            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-3 rounded-lg mb-3">
                    <div class="flex items-start">
                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <div class="flex-1">
                            @foreach($errors->all() as $error)
                                <p class="font-semibold text-xs">{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="/register" class="space-y-3">
                @csrf
                
                <div>
                    <label class="block text-blue-950 text-xs font-bold mb-1 uppercase tracking-wide" for="name">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            class="w-full pl-10 pr-3 py-2 text-sm border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                            placeholder="Masukkan nama lengkap"
                            value="{{ old('name') }}" 
                            required 
                            autofocus>
                    </div>
                </div>

                <div>
                    <label class="block text-blue-950 text-xs font-bold mb-1 uppercase tracking-wide" for="email">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                        </div>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            class="w-full pl-10 pr-3 py-2 text-sm border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="nama@email.com"
                            value="{{ old('email') }}" 
                            required>
                    </div>
                </div>

                <div>
                    <label class="block text-blue-950 text-xs font-bold mb-1 uppercase tracking-wide" for="no_hp">
                        No HP / WhatsApp <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                        </div>
                        <input 
                            type="tel" 
                            name="no_hp" 
                            id="no_hp" 
                            pattern="[0-9]{10,15}"
                            class="w-full pl-10 pr-3 py-2 text-sm border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="08123456789"
                            value="{{ old('no_hp') }}" 
                            required>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Nomor yang bisa dihubungi via WhatsApp (10-15 digit)</p>
                </div>

                <div>
                    <label class="block text-blue-950 text-xs font-bold mb-1 uppercase tracking-wide" for="password">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            class="w-full pl-10 pr-3 py-2 text-sm border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Min. 8 karakter"
                            required>
                    </div>
                </div>

                <div>
                    <label class="block text-blue-950 text-xs font-bold mb-1 uppercase tracking-wide" for="password_confirmation">
                        Konfirmasi Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation" 
                            class="w-full pl-10 pr-3 py-2 text-sm border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Ulangi password"
                            required>
                    </div>
                </div>

                <!-- Terms & Conditions - COMPACT -->
                <div class="bg-blue-50 border-2 border-blue-200 rounded-lg p-2">
                    <p class="text-xs text-gray-700 leading-snug">
                        Dengan mendaftar, Anda menyetujui <strong>Syarat & Ketentuan</strong> serta <strong>Kebijakan Privasi</strong> PT Rental Mobil.
                    </p>
                </div>

                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-2.5 px-4 rounded-lg text-sm transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    <span class="flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                        Daftar Sekarang
                    </span>
                </button>
            </form>

            <div class="mt-3 text-center">
                <p class="text-xs text-gray-600">Sudah punya akun? 
                    <a href="/login" class="text-blue-600 hover:text-blue-800 font-bold underline">Login Sekarang</a>
                </p>
            </div>

            <!-- Footer - COMPACT -->
            <div class="mt-4 pt-3 border-t border-gray-200 text-center">
                <p class="text-gray-500 text-xs">© 2025 PT Rental Mobil. All rights reserved.</p>
                <p class="text-gray-400 text-xs mt-0.5">Denpasar, Bali - Indonesia</p>
            </div>
        </div>
    </div>
</body>
</html>