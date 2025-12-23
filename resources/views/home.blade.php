<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['company_name'] ?? 'PT Rental Mobil' }} - {{ $settings['company_tagline'] ?? 'Sewa Mobil Terpercaya' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .hero-gradient { background: linear-gradient(135deg, rgba(30, 58, 138, 0.4) 0%, rgba(30, 64, 175, 0.4) 100%); }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar - COMPACT & ALIGNED -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="bg-blue-900 p-2 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-blue-950">{{ $settings['company_name'] ?? 'PT Rental Mobil' }}</h1>
                        <p class="text-xs text-gray-600">{{ $settings['company_tagline'] ?? 'Sewa Mobil Terpercaya' }}</p>
                    </div>
                </div>
                {{-- Ganti div ini: --}}
                {{-- DENGAN KODE LOGIKA KONDISIONAL INI: --}}

                <div class="flex items-center space-x-3">
                    @auth
                        <div class="group relative flex items-center">
                            <span class="text-sm font-semibold text-blue-950 mr-3">
                                Halo, selamat datang <strong> {{ $user->name }}</strong>
                            </span>
                            
                            <button class="bg-blue-900 hover:bg-blue-800 text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold shadow-md transition">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </button>
                            
                            <div class="absolute right-0 top-full mt-3 w-48 bg-white rounded-lg shadow-xl py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 border border-gray-100">
                                <p class="px-4 py-2 text-xs text-gray-500 border-b mb-1">{{ $user->email }}</p>

                                @if($user->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-sm text-blue-800 hover:bg-blue-50 font-semibold">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                                        Dashboard Admin
                                    </a>
                                @else 
                                    <a href="{{ route('pelanggan.dashboard') }}" class="flex items-center px-4 py-2 text-sm text-blue-800 hover:bg-blue-50 font-semibold">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                                        Dashboard Saya
                                    </a>
                                @endif
                                
                                <a href="{{ route('logout') }}" 
                                onclick="event.preventDefault(); document.getElementById('logout-form-landing').submit();" 
                                class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path></svg>
                                    Logout
                                </a>
                                <form id="logout-form-landing" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @else 
                        <a href="{{ route('login') }}" class="bg-white border-2 border-blue-900 text-blue-900 px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-50 transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-md transition">
                            Daftar Sekarang
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section - SLIDER AUTO & MANUAL -->
    <section class="relative overflow-hidden">
    @php
        // Get all hero images that are not null
        $heroImages = [];
        for ($i = 1; $i <= 5; $i++) {
            if (isset($settings['hero_image_' . $i]) && $settings['hero_image_' . $i]) {
                $heroImages[] = $settings['hero_image_' . $i];
            }
        }
        $hasSlider = count($heroImages) > 0;
    @endphp

    @if($hasSlider)
        <div class="absolute inset-0 z-0" id="heroSlider">
            @foreach($heroImages as $index => $image)
                <div class="hero-slide absolute inset-0 transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}" data-slide="{{ $index }}">
                    <img src="{{ asset('storage/' . $image) }}" alt="Hero {{ $index + 1 }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 hero-gradient"></div>
                </div>
            @endforeach
        </div>
    @else
        <div class="absolute inset-0 z-0 hero-gradient"></div>
    @endif

    {{-- INI ADALAH CONTAINER UTAMA HERO SECTION --}}
    <div class="relative z-10 container mx-auto px-6 py-16 md:py-24">
        <div class="max-w-3xl">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                {{ $settings['company_name'] ?? 'PT Rental Mobil Bali' }}
            </h1>
            <p class="text-xl md:text-2xl text-blue-100 mb-3 font-semibold">
                {{ $settings['company_tagline'] ?? 'Sewa Mobil Terpercaya & Terjangkau' }}
            </p>
            <p class="text-sm md:text-base text-blue-50 mb-8 leading-relaxed">
                {{ $settings['company_description'] ?? 'Nikmati perjalanan Anda dengan armada terbaik kami.' }}
            </p>
            
            <div class="grid grid-cols-2 gap-4 mb-8">
                <div class="bg-white/10 backdrop-blur-md rounded-lg p-4 border border-white/20">
                    <p class="text-3xl font-bold text-white">{{ $totalMobilTersedia }}</p>
                    <p class="text-sm text-blue-100">Mobil Tersedia</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-lg p-4 border border-white/20">
                    <p class="text-3xl font-bold text-white">{{ $totalMobilBelumTersedia }}</p>
                    <p class="text-sm text-blue-100">Belum Tersedia</p>
                </div>
            </div>

            {{-- START: LOGIKA CTA KHUSUS ADMIN/PELANGGAN (POSISI SUDAH DIRAPIKAN) --}}
            @if(Auth::check() && $user->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center bg-white text--blue-900 px-6 py-3 rounded-lg text-sm font-bold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    Masuk ke Dashboard Admin
                </a>
            @else
                <a href="{{ Auth::check() ? route('pelanggan.dashboard') : route('register') }}" 
                class="inline-flex items-center bg-white text-blue-900 px-6 py-3 rounded-lg text-sm font-bold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                    </svg>
                    Mulai Sewa Mobil Sekarang
                </a>
            @endif
            {{-- END: LOGIKA CTA KHUSUS ADMIN/PELANGGAN --}}

        </div>
    </div>
    {{-- PENUTUP CONTAINER UTAMA --}}

    @if(count($heroImages) > 1)
        <button onclick="prevSlide()" class="absolute left-4 top-1/2 -translate-y-1/2 z-20 bg-white/20 hover:bg-white/30 backdrop-blur-md text-white p-3 rounded-full transition">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
        </button>
        <button onclick="nextSlide()" class="absolute right-4 top-1/2 -translate-y-1/2 z-20 bg-white/20 hover:bg-white/30 backdrop-blur-md text-white p-3 rounded-full transition">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
        </button>

        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex space-x-2">
            @foreach($heroImages as $index => $image)
                <button onclick="goToSlide({{ $index }})" class="slider-dot w-3 h-3 rounded-full transition {{ $index === 0 ? 'bg-white' : 'bg-white/40' }}" data-dot="{{ $index }}"></button>
            @endforeach
        </div>
    @endif
</section>

    <!-- Slider JavaScript -->
    @if($hasSlider && count($heroImages) > 1)
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.hero-slide');
        const dots = document.querySelectorAll('.slider-dot');
        const totalSlides = slides.length;
        let autoPlayInterval;

        function showSlide(index) {
            slides.forEach(slide => {
                slide.classList.remove('opacity-100');
                slide.classList.add('opacity-0');
            });
            slides[index].classList.remove('opacity-0');
            slides[index].classList.add('opacity-100');
            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.remove('bg-white/40');
                    dot.classList.add('bg-white');
                } else {
                    dot.classList.remove('bg-white');
                    dot.classList.add('bg-white/40');
                }
            });
            currentSlide = index;
        }

        function nextSlide() {
            let next = (currentSlide + 1) % totalSlides;
            showSlide(next);
            resetAutoPlay();
        }

        function prevSlide() {
            let prev = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(prev);
            resetAutoPlay();
        }

        function goToSlide(index) {
            showSlide(index);
            resetAutoPlay();
        }

        function autoPlay() {
            autoPlayInterval = setInterval(() => {
                nextSlide();
            }, 5000);
        }

        function resetAutoPlay() {
            clearInterval(autoPlayInterval);
            autoPlay();
        }

        autoPlay();
    </script>
    @endif

    <!-- Keunggulan Section - COMPACT -->
    <section class="py-8 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg border border-blue-200">
                    <div class="bg-blue-900 p-3 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-blue-950">Harga Terjangkau</h3>
                        <p class="text-xs text-gray-600">Mulai dari Rp 250.000/hari</p>
                    </div>
                </div>

                <div class="flex items-center p-4 bg-gradient-to-r from-green-50 to-green-100 rounded-lg border border-green-200">
                    <div class="bg-green-600 p-3 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-green-950">Armada Lengkap</h3>
                        <p class="text-xs text-gray-600">{{ $totalMobilTersedia + $totalMobilBelumTersedia }} mobil total</p>
                    </div>
                </div>

                <div class="flex items-center p-4 bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg border border-purple-200">
                    <div class="bg-purple-600 p-3 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-purple-950">Layanan 24/7</h3>
                        <p class="text-xs text-gray-600">Siap melayani kapan saja</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mobil Section - 2 STATUS BERSEBELAHAN - COMPACT -->
    <section class="py-6 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-4">
                <h2 class="text-xl font-bold text-blue-950 mb-1">Armada Kami</h2>
                <p class="text-xs text-gray-600">Lihat status mobil kami saat ini</p>
            </div>

            <!-- 2 Sections Bersebelahan -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                
                <!-- SECTION 1: MOBIL TERSEDIA (HIJAU) -->
                <div class="bg-white rounded-lg shadow-md p-3 border-t-4 border-green-500">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center">
                            <div class="bg-green-500 p-1.5 rounded-lg mr-2">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-green-700">Mobil Tersedia</h3>
                                <p class="text-xs text-gray-600">{{ $totalMobilTersedia }} unit siap disewa</p>
                            </div>
                        </div>
                    </div>

                    @if($mobilTersedia->count() > 0)
                        <div class="space-y-2 overflow-y-auto pr-2" style="max-height: 500px;">
                            @foreach($mobilTersedia as $mobil)
                            <div class="bg-gradient-to-r from-green-50 to-white rounded-lg p-2.5 border border-green-200 hover:shadow-md transition">
                                <div class="flex items-center space-x-2.5">
                                    @if($mobil->foto_depan)
                                        <img src="{{ asset('storage/' . $mobil->foto_depan) }}" alt="{{ $mobil->merek }}" class="w-20 h-20 object-cover rounded-lg flex-shrink-0">
                                    @else
                                        <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-10 h-10 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-bold text-blue-950 truncate">{{ $mobil->merek }} {{ $mobil->model }}</h4>
                                        <p class="text-xs text-gray-600">{{ $mobil->nomor_plat }}</p>
                                        <p class="text-xs font-bold text-green-600 mb-1.5">{{ $mobil->harga_format }}/hari</p>
                                        {{-- Dengan logika kondisional ini: --}}
                                        @if(Auth::check() && $user->role === 'admin')
                                            <a href="{{ route('admin.mobil.index', $mobil->id) }}" class="inline-flex items-center bg-yellow-500 hover:bg-yellow-600 text-white px-2.5 py-1 rounded-md text-xs font-bold transition shadow-sm">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zm-7.53 7.53l-2.828 2.828.793.793 2.828-2.828-.793-.793z"/></svg>
                                                Kelola Mobil
                                            </a>
                                        @else
                                            <a href="{{ Auth::check() ? route('pelanggan.pemesanan.create', $mobil->id) : route('login') }}" class="inline-flex items-center bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-2.5 py-1 rounded-md text-xs font-bold transition shadow-sm">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/></svg>
                                                Sewa Sekarang
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6 bg-gradient-to-br from-gray-50 to-white rounded-lg border-2 border-dashed border-gray-300">
                            <div class="text-2xl mb-2">🚗</div>
                            <p class="text-xs font-semibold text-gray-600">Tidak ada mobil tersedia</p>
                        </div>
                    @endif
                </div>

                <!-- SECTION 2: MOBIL BELUM TERSEDIA (ABU-ABU) - DENGAN TOMBOL WAITING LIST -->
                <div class="bg-gray-100 rounded-lg shadow-md p-3 border-t-4 border-gray-400">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center">
                            <div class="bg-gray-400 p-1.5 rounded-lg mr-2">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-gray-700">Belum Tersedia</h3>
                                <p class="text-xs text-gray-600">{{ $totalMobilBelumTersedia }} unit (disewa/perawatan)</p>
                            </div>
                        </div>
                    </div>

                    @if($mobilBelumTersedia->count() > 0)
                        <div class="space-y-2 overflow-y-auto pr-2" style="max-height: 500px;">
                            @foreach($mobilBelumTersedia as $mobil)
                            <div class="bg-gradient-to-r from-gray-200 to-gray-100 rounded-lg p-2.5 border border-gray-300 hover:shadow-md transition">
                                <div class="flex items-center space-x-2.5">
                                    @if($mobil->foto_depan)
                                        <img src="{{ asset('storage/' . $mobil->foto_depan) }}" alt="{{ $mobil->merek }}" class="w-20 h-20 object-cover rounded-lg grayscale opacity-60 flex-shrink-0">
                                    @else
                                        <div class="w-20 h-20 bg-gray-300 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-10 h-10 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-bold text-gray-700 truncate">{{ $mobil->merek }} {{ $mobil->model }}</h4>
                                        <p class="text-xs text-gray-500">{{ $mobil->nomor_plat }}</p>
                                        <p class="text-xs font-bold text-gray-600 mb-1.5">{{ $mobil->harga_format }}/hari</p>
                                        
                                        {{-- TOMBOL WAITING LIST DENGAN ONCLICK --}}
                                        {{-- Dengan logika kondisional ini: --}}
                                        @if(Auth::check() && $user->role === 'admin')
                                            <a href="{{ route('admin.mobil.index', $mobil->id) }}" class="inline-flex items-center bg-yellow-500 hover:bg-yellow-600 text-white px-2.5 py-1 rounded-md text-xs font-bold transition shadow-sm">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zm-7.53 7.53l-2.828 2.828.793.793 2.828-2.828-.793-.793z"/></svg>
                                                Kelola Mobil
                                            </a>
                                        @else
                                            <button type="button" 
                                                onclick="openWaitingListModal({{ $mobil->id }}, '{{ $mobil->merek }} {{ $mobil->model }}', '{{ $mobil->harga_format }}', '{{ $mobil->foto_depan ? asset('storage/' . $mobil->foto_depan) : '' }}')"
                                                class="inline-flex items-center bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-2.5 py-1 rounded-md text-xs font-bold transition shadow-sm">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                                                Join Waiting List
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6 bg-gradient-to-br from-gray-200 to-gray-100 rounded-lg border-2 border-dashed border-gray-400">
                            <div class="text-2xl mb-2">✓</div>
                            <p class="text-xs font-semibold text-gray-600">Semua mobil tersedia!</p>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </section>

    <!-- Call to Action - COMPACT -->
    <section class="py-12 bg-gradient-to-r from-blue-900 to-blue-800 text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-3">Siap Memulai Perjalanan Anda?</h2>
            <p class="text-sm md:text-base text-blue-100 mb-6">Daftar sekarang dan nikmati kemudahan sewa mobil</p>
            {{-- Dengan logika kondisional ini: --}}
            @if(Auth::check() && $user->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center bg-blue-900 hover:bg-blue-800 text-white px-8 py-3 rounded-lg text-sm font-bold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition">
                    Lanjutkan ke Panel Administrasi
                </a>
            @else
                <a href="{{ Auth::check() ? route('pelanggan.mobil.index') : route('register') }}" class="inline-flex items-center bg-white text-blue-900 px-8 py-3 rounded-lg text-sm font-bold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                    {{ Auth::check() ? 'Lanjutkan ke Pemesanan Mobil' : 'Daftar Gratis Sekarang' }}
                </a>
            @endif
        </div>
    </section>

    <!-- Footer - COMPACT -->
    <footer class="bg-gray-900 text-gray-300 py-8">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <h3 class="text-white font-bold mb-3 text-sm">{{ $settings['company_name'] ?? 'PT Rental Mobil' }}</h3>
                    <p class="text-xs leading-relaxed">{{ $settings['company_description'] ?? 'Layanan sewa mobil terpercaya di Bali.' }}</p>
                </div>
                <div>
                    <h3 class="text-white font-bold mb-3 text-sm">Kontak</h3>
                    <div class="space-y-2 text-xs">
                        <p>📞 {{ $settings['company_phone'] ?? '+62 812-3456-7890' }}</p>
                        <p>✉️ {{ $settings['company_email'] ?? 'info@rental.com' }}</p>
                        <p>📍 {{ $settings['company_address'] ?? 'Denpasar, Bali' }}</p>
                    </div>
                </div>
                <div>
                    <h3 class="text-white font-bold mb-3 text-sm">Quick Links</h3>
                    <div class="space-y-2 text-xs">
                        <a href="{{ route('login') }}" class="block hover:text-white transition">Login</a>
                        <a href="{{ route('register') }}" class="block hover:text-white transition">Daftar</a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-6 text-center text-xs">
                <p>&copy; 2025 {{ $settings['company_name'] ?? 'PT Rental Mobil' }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    {{-- ============================================ --}}
    {{-- MODAL WAITING LIST - SIMPLE VERSION       --}}
    {{-- ============================================ --}}
    <div id="waitingListModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-2xl max-w-md w-full transform transition-all">
                
                <!-- Header Modal -->
                <div class="bg-gradient-to-r from-blue-900 to-blue-800 text-white p-6 rounded-t-xl">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <h3 class="text-xl font-bold">Join Waiting List</h3>
                                <p class="text-xs text-blue-100">Kami akan kabari via WhatsApp jika mobil tersedia</p>
                            </div>
                        </div>
                        <button type="button" onclick="closeWaitingListModal()" class="text-white hover:text-gray-200 transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Body Modal -->
                <div class="p-6">
                    <!-- Info Mobil yang Dipilih -->
                    <div id="modalMobilInfo" class="bg-gradient-to-r from-gray-50 to-gray-100 border border-gray-200 rounded-lg p-4 mb-4">
                        <div class="flex items-center">
                            <img id="modalMobilFoto" src="" alt="" class="w-16 h-16 object-cover rounded-lg mr-3">
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Mobil yang Anda tunggu:</p>
                                <h4 id="modalMobilNama" class="text-base font-bold text-blue-950"></h4>
                                <p id="modalMobilHarga" class="text-sm font-semibold text-green-600"></p>
                            </div>
                        </div>
                    </div>

                    {{-- ============================================ --}}
                    {{-- NOTIFIKASI SUCCESS --}}
                    {{-- ============================================ --}}
                    @if(session('waiting_list_success'))
                    <div class="bg-green-50 border border-green-300 text-green-800 px-4 py-3 rounded-lg mb-4 text-sm">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ session('waiting_list_success') }}</span>
                        </div>
                    </div>
                    @endif

                    {{-- ============================================ --}}
                    {{-- NOTIFIKASI ERROR --}}
                    {{-- ============================================ --}}
                    @if(session('waiting_list_error'))
                    <div class="bg-red-50 border border-red-300 text-red-800 px-4 py-3 rounded-lg mb-4 text-sm">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ session('waiting_list_error') }}</span>
                        </div>
                    </div>
                    @endif

                    {{-- ============================================ --}}
                    {{-- NOTIFIKASI INFO (SUDAH TERDAFTAR) --}}
                    {{-- ============================================ --}}
                    @if(session('waiting_list_info'))
                    <div class="bg-blue-50 border border-blue-300 text-blue-800 px-4 py-3 rounded-lg mb-4 text-sm">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ session('waiting_list_info') }}</span>
                        </div>
                    </div>
                    @endif

                    {{-- ============================================ --}}
                    {{-- FORM WAITING LIST --}}
                    {{-- ============================================ --}}
                    @if(!session('waiting_list_success') && !session('waiting_list_info'))
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-4">
                        <p class="text-xs text-blue-900">
                            <strong>ℹ️ Info:</strong> Masukkan email & password akun yang sudah terdaftar. 
                            Kami akan kirim notifikasi WhatsApp ke nomor HP Anda jika mobil sudah tersedia.
                        </p>
                    </div>

                    <form id="waitingListForm" method="POST" action="{{ route('waiting-list.store') }}" class="space-y-4">
                        @csrf
                        <input type="hidden" name="mobil_id" id="modalMobilId">

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                placeholder="contoh@email.com"
                                value="{{ old('email') }}">
                            @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" name="password" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                placeholder="Masukkan password Anda">
                            @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Info Tambahan -->
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                            <p class="text-xs text-yellow-800">
                                <strong>📱 Penting:</strong> Pastikan nomor WhatsApp Anda sudah terdaftar saat register. 
                                Admin akan menghubungi Anda via WA jika mobil sudah tersedia.
                            </p>
                        </div>

                        <!-- Buttons -->
                        <div class="flex space-x-3 pt-2">
                            <button type="button" onclick="closeWaitingListModal()"
                                class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg text-sm font-bold transition">
                                Batal
                            </button>
                            <button type="submit"
                                class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-lg text-sm font-bold transition shadow-md">
                                Join Waiting List
                            </button>
                        </div>
                    </form>
                    @endif

                    {{-- ============================================ --}}
                    {{-- TOMBOL TUTUP JIKA ADA NOTIFIKASI SUCCESS/INFO --}}
                    {{-- ============================================ --}}
                    @if(session('waiting_list_success') || session('waiting_list_info'))
                    <button type="button" onclick="closeWaitingListModal()"
                        class="w-full bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg text-sm font-bold transition mt-4">
                        Tutup
                    </button>
                    @endif

                    <!-- Link Register -->
                    @if(!session('waiting_list_success') && !session('waiting_list_info'))
                    <div class="text-center mt-4 pt-4 border-t border-gray-200">
                        <p class="text-xs text-gray-600">
                            Belum punya akun? 
                            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-semibold">
                                Daftar Sekarang
                            </a>
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================ --}}
    {{-- JAVASCRIPT UNTUK MODAL WAITING LIST --}}
    {{-- ============================================ --}}
    <script>
        // Global variables untuk store data mobil
        let lastMobilId = null;
        let lastMobilNama = '';
        let lastMobilHarga = '';
        let lastMobilFoto = '';

        /**
         * Function: Open Waiting List Modal
         */
        // function openWaitingListModal(mobilId, mobilNama, mobilHarga, mobilFoto) {
        //     // Simpan data mobil ke global variables
        //     lastMobilId = mobilId;
        //     lastMobilNama = mobilNama;
        //     lastMobilHarga = mobilHarga;
        //     lastMobilFoto = mobilFoto;

        //     // --- AWAL PERBAIKAN ---
            
        //     // 1. Ambil elemen input
        //     const inputMobilId = document.getElementById('modalMobilId');

        //     // 2. Cek apakah elemen input ada (hanya ada jika form ditampilkan)
        //     if (inputMobilId) {
        //         inputMobilId.value = mobilId;
        //     }

        //     // --- AKHIR PERBAIKAN ---

        //     // Set data mobil ke modal (bagian ini aman)
        //     document.getElementById('modalMobilNama').textContent = mobilNama;
        //     document.getElementById('modalMobilHarga').textContent = mobilHarga + '/hari';
        //     document.getElementById('modalMobilFoto').src = mobilFoto || 'https://via.placeholder.com/64';
        //     document.getElementById('modalMobilFoto').alt = mobilNama;
            
        //     // Buka modal
        //     document.getElementById('waitingListModal').classList.remove('hidden');
        //     document.body.style.overflow = 'hidden';
        // }

        function openWaitingListModal(mobilId, mobilNama, mobilHarga, mobilFoto){
            lastMobilId = mobilId;
            lastMobilNama = mobilNama;
            lastMobilHarga = mobilHarga;
            lastMobilFoto = mobilFoto;

            const inputMobilId = document.getElementById('modalMobilId');
            if (inputMobilId) {
                inputMobilId.value = mobilId;
            }

            document.getElementById('modalMobilNama').textContent = mobilNama;
            document.getElementById('modalMobilHarga').textContent = mobilHarga + './hari';
            document.getElementById('modalMobilFoto').src = mobilFoto || 'https://via.placeholder.com/64';
            document.getElementById('modalMobilFoto').alt = mobilNama;

            //buka modal
            document.getElementById('waitingListModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        /**
         * Function: Close Waiting List Modal
         */
        function closeWaitingListModal() {
            document.getElementById('waitingListModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal saat klik di luar modal
        document.getElementById('waitingListModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeWaitingListModal();
            }
        });

        // Close modal dengan ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeWaitingListModal();
            }
        });

        {{-- ============================================ --}}
        {{-- AUTO-OPEN MODAL JIKA ADA NOTIFIKASI --}}
        {{-- ============================================ --}}
        @if(session('modal_open') && session('modal_mobil_id'))
        // Auto-open modal jika ada error/info
        document.addEventListener('DOMContentLoaded', function() {
            const mobilId = {{ session('modal_mobil_id') }};
            const mobilNama = "{{ session('modal_mobil_nama', '') }}";
            const mobilHarga = "{{ session('modal_mobil_harga', '') }}";
            const mobilFoto = "{{ session('modal_mobil_foto', '') }}";
            
            // Buka modal langsung dengan data dari session
            if (mobilId && mobilNama) {
                openWaitingListModal(mobilId, mobilNama, mobilHarga, mobilFoto);
            }
        });
        @endif

        {{-- ============================================ --}}
        {{-- AUTO-CLOSE SUCCESS MESSAGE SETELAH 5 DETIK --}}
        {{-- ============================================ --}}
        @if(session('waiting_list_success'))
        setTimeout(function() {
            closeWaitingListModal();
        }, 5000);
        @endif
    </script>

</body>
</html>