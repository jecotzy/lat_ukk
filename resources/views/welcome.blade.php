<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <title>Lapor Pak - Sistem PKL Modern</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .gradient-text {
            background: linear-gradient(90deg, #3b82f6, #06b6d4);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero-glass {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        @keyframes gradient-move {
            0%, 100% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
        }
        .animate-gradient-move {
            background-size: 200% 200%;
            animation: gradient-move 8s ease infinite;
        }

    </style>
</head>
<body class="bg-gradient-to-br from-gray-900 via-gray-900 to-gray-900 text-gray-200 antialiased min-h-screen overflow-x-hidden">

    <!-- Animated Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-0 w-64 h-64 bg-blue-500/10 rounded-full filter blur-3xl animate-pulse opacity-20"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-500/10 rounded-full filter blur-3xl animate-pulse opacity-20"></div>
    </div>

    {{-- Navigation --}}
    <nav class="container mx-auto px-6 py-5 flex justify-between items-center relative z-10 animate__animated animate__fadeInDown">
        <div class="flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" class="w-8 h-8">
                <defs>
                <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:#3b82f6;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#06b6d4;stop-opacity:1" />
                </linearGradient>
                </defs>
                <path stroke="url(#grad1)" fill="none" stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25M9 16.5v.75m3-3v3M15 12v5.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
            <span class="text-2xl font-bold gradient-text">LaporPak</span>
        </div>

        <div class="hidden md:flex space-x-8">
            <a href="#features" class="text-gray-300 hover:text-white transition duration-300 font-medium">Fitur</a>
            <a href="#about" class="text-gray-300 hover:text-white transition duration-300 font-medium">Tentang</a>
            <a href="#kontak    " class="text-gray-300 hover:text-white transition duration-300 font-medium">Kontak</a>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('login') }}" class="px-5 py-2 text-blue-400 font-medium hover:text-blue-300 transition duration-300">Masuk</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="px-5 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded-lg font-medium transition duration-300 shadow-lg hover:shadow-xl">
                Daftar
            </a>
            @endif
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="container mx-auto px-10 pt-0 md:py-20 flex flex-col md:flex-row items-center justify-between gap-20 relative z-10">
        <div class="flex flex-col md:w-1/2 text-center md:text-left" data-aos="fade-right" data-aos-duration="800">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                <span class="gradient-text">Lapor Pak</span>
                <span class="text-white block text-2xl md:text-5xl">Mudah & Modern</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-400 mb-8 leading-relaxed max-w-lg">
                Platform digital terintegrasi untuk mengelola seluruh proses Praktik Kerja Lapangan jurusan Sistem Informasi Jaringan dan Aplikasi dengan mudah dan efektif.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                <a href="{{ route('login') }}"
                   class="px-8 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    Masuk Sekarang
                </a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}"
                   class="px-8 py-3 border-2 border-blue-400 text-blue-300 hover:bg-blue-900/30 hover:text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    Daftar Akun
                </a>
                @endif
            </div>
        </div>

        <div class="flex-shrink-0 flex items-center justify-center w-full md:w-1/2 relative z-10" data-aos="fade-left" data-aos-duration="800">
            <div class="relative w-[350px] h-[500px] md:w-[400px] md:h-[500px] group">
                <!-- Gradient Border Effect -->
                <div class="absolute inset-0 rounded-[2rem] animate-gradient-move bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 opacity-20 blur-2xl transition-all duration-700 group-hover:opacity-30 group-hover:blur-[60px]"></div>

                <!-- Hero Image Container -->
                <div class="relative z-10 hero-glass rounded-3xl shadow-2xl flex items-center justify-center overflow-hidden py-2 px-0 w-fit h-fit transition-transform duration-700 group-hover:scale-105">
                    <img src="https://images.unsplash.com/photo-1685517913166-1b97a48b8d0c?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="laptop3"
                        class="w-[350px] h-[500px] object-contain transition-transform duration-700 ease-in-out group-hover:scale-110 rounded-4xl" />
                </div>

            </div>
        </div>
    </section>

<!-- About Section -->
<section id="about" class="py-10 bg-gray-800/50 backdrop-blur-md rounded-3xl container mx-auto px-6 md:px-12 relative z-10" data-aos="fade-up" data-aos-duration="1000">
    <div class="text-center mb-12">
        <h2 class="text-4xl md:text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-cyan-400 leading-snug drop-shadow-md">
            Tentang Lapor Pak
        </h2>
        <div class="mt-4 w-20 h-1 mx-auto bg-cyan-400 rounded-full"></div>
    </div>
    
    <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center gap-10">
        <!-- Icon / Illustration -->
        <div class="flex-shrink-0 w-full md:w-1/2">
            <img src="https://i.ibb.co/QjK4Cb1m/think.png" alt="Lapor Pak Icon" class="w-64 mx-auto animate-fade-in-up" loading="lazy"/>
        </div>

        <!-- Description -->
        <div class="w-full md:w-1/2 text-gray-300 text-lg leading-relaxed space-y-5">
            <p>
                <strong class="text-cyan-300">Lapor Pak</strong> adalah platform digital modern yang dirancang khusus untuk mengelola <span class="text-white font-semibold">Praktik Kerja Lapangan (PKL)</span> di jurusan Sistem Informasi Jaringan dan Aplikasi.
            </p>
            <p>
                Kami menyediakan solusi terpadu — mulai dari <span class="text-white font-semibold">pendaftaran siswa</span>, <span class="text-white font-semibold">pemantauan industri mitra</span>, hingga <span class="text-white font-semibold">penilaian akhir</span> — semua dapat dilakukan secara efisien.
            </p>
            <p>
                Dengan antarmuka yang intuitif dan fitur lengkap, Lapor Pak mendukung proses pelaporan dan administrasi PKL agar lebih mudah dan terstruktur.
            </p>
        </div>
    </div>
</section>


    {{-- Features Section --}}
    <section id="features" class="py-20 relative z-10">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Fitur Unggulan Sistem</h2>
                <p class="max-w-2xl mx-auto text-gray-400">Solusi lengkap untuk manajemen Praktik Kerja Lapangan</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="feature-card bg-gray-800/50 backdrop-blur-sm p-8 rounded-xl border border-gray-700/50 hover:border-blue-500/30 transition-all duration-300 shadow-lg"
                     data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500/20 to-blue-600/20 rounded-lg flex items-center justify-center mb-6 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-center">Manajemen Siswa</h3>
                    <p class="text-gray-400 text-center">Kelola data siswa PKL secara digital dengan fitur lengkap mulai dari pendaftaran hingga penilaian akhir.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="feature-card bg-gray-800/50 backdrop-blur-sm p-8 rounded-xl border border-gray-700/50 hover:border-blue-500/30 transition-all duration-300 shadow-lg"
                     data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500/20 to-blue-600/20 rounded-lg flex items-center justify-center mb-6 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-center">Industri Mitra</h3>
                    <p class="text-gray-400 text-center">Database industri mitra PKL dengan informasi lengkap dan sistem pemantauan kerjasama.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="feature-card bg-gray-800/50 backdrop-blur-sm p-8 rounded-xl border border-gray-700/50 hover:border-blue-500/30 transition-all duration-300 shadow-lg"
                     data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500/20 to-blue-600/20 rounded-lg flex items-center justify-center mb-6 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-center">Monitoring Guru</h3>
                    <p class="text-gray-400 text-center">Sistem pemantauan real-time untuk guru pembimbing dengan laporan dan notifikasi terintegrasi.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="py-20 bg-gradient-to-r from-gray-800/50 to-gray-900/50 backdrop-blur-sm relative z-10">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="p-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="text-4xl font-bold text-blue-400 mb-2 animate-count">100+</div>
                    <div class="text-gray-400">Siswa Terdaftar</div>
                </div>
                <div class="p-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="text-4xl font-bold text-blue-400 mb-2 animate-count">50+</div>
                    <div class="text-gray-400">Industri Mitra</div>
                </div>
                <div class="p-6" data-aos="zoom-in" data-aos-delay="300">
                    <div class="text-4xl font-bold text-blue-400 mb-2 animate-count">100+</div>
                    <div class="text-gray-400">Kepuasan Pengguna</div>
                </div>
                <div class="p-6" data-aos="zoom-in" data-aos-delay="400">
                    <div class="text-4xl font-bold text-blue-400 mb-2">24/7</div>
                    <div class="text-gray-400">Dukungan Sistem</div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-20 relative z-10">
        <div class="container mx-auto px-6 text-center">
            <div class="hero-glass rounded-2xl p-12 shadow-2xl" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Siap Mengoptimalkan Manajemen PKL Anda?</h2>
                <p class="max-w-2xl mx-auto text-gray-400 mb-8">Bergabunglah dengan ratusan institusi pendidikan yang telah mempercayakan sistem manajemen PKL mereka kepada kami.</p>
                <a href="{{ route('register') }}"
                   class="inline-block px-8 py-4 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg font-semibold text-lg shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    Daftar Sekarang - Gratis!
                </a>
            </div>
        </div>
    </section>

    <!-- Kontak -->
    <section id="kontak" class="bg-gradient-to-br from-gray-950 via-gray-900 to-gray-950 py-24 relative overflow-hidden">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-blue-500/10 rounded-full filter blur-3xl animate-float-slow opacity-20"></div>
        <div class="absolute bottom-1/3 right-1/4 w-72 h-72 bg-purple-500/10 rounded-full filter blur-3xl animate-float-medium opacity-20"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        <div class="text-center mb-20" data-aos="fade-up" data-aos-duration="800">
            <h3 class="text-4xl md:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400 mb-4 leading-relaxed">
                Hubungi Kami
            </h3>
            <p class="text-lg text-gray-400 max-w-2xl mx-auto">
                Punya pertanyaan atau butuh bantuan? Tim kami siap membantu Anda kapan saja.
            </p>
        </div>

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
            <!-- Email Card -->
            <div class="group relative bg-gray-800/50 backdrop-blur-sm rounded-2xl p-8 border border-gray-700/50 hover:border-blue-500/30 transition-all duration-500 hover:-translate-y-2 shadow-xl hover:shadow-2xl">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-blue-600/10 opacity-0 group-hover:opacity-100 rounded-2xl transition-opacity duration-500"></div>
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mb-6 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-white mb-2">Email</h4>
                    <a href="mailto:info@laporpak.com" class="text-blue-400 hover:text-blue-300 transition-colors duration-300 inline-block">
                        <span class="hover:underline">info@laporpak.com</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Phone Card -->
            <div class="group relative bg-gray-800/50 backdrop-blur-sm rounded-2xl p-8 border border-gray-700/50 hover:border-green-500/30 transition-all duration-500 hover:-translate-y-2 shadow-xl hover:shadow-2xl">
                <div class="absolute inset-0 bg-gradient-to-br from-green-500/10 to-green-600/10 opacity-0 group-hover:opacity-100 rounded-2xl transition-opacity duration-500"></div>
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center mb-6 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-white mb-2">Telepon</h4>
                    <a href="tel:+6281234567890" class="text-green-400 hover:text-green-300 transition-colors duration-300 inline-block">
                        <span class="hover:underline">+62 812-3456-7890</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Address Card -->
            <div class="group relative bg-gray-800/50 backdrop-blur-sm rounded-2xl p-8 border border-gray-700/50 hover:border-purple-500/30 transition-all duration-500 hover:-translate-y-2 shadow-xl hover:shadow-2xl">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-purple-600/10 opacity-0 group-hover:opacity-100 rounded-2xl transition-opacity duration-500"></div>
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center mb-6 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-white mb-2">Alamat</h4>
                    <p class="text-gray-400 hover:text-gray-300 transition-colors duration-300">
                        Jl. Stm Pembangunan<br>
                        Sleman , Yogyakarta
                    </p>
                    <button class="mt-3 text-purple-400 hover:text-purple-300 text-sm font-medium flex items-center transition-colors duration-300">
                        Lihat di Peta
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Social Media Card -->
            <div class="group relative bg-gray-800/50 backdrop-blur-sm rounded-2xl p-8 border border-gray-700/50 hover:border-pink-500/30 transition-all duration-500 hover:-translate-y-2 shadow-xl hover:shadow-2xl">
                <div class="absolute inset-0 bg-gradient-to-br from-pink-500/10 to-pink-600/10 opacity-0 group-hover:opacity-100 rounded-2xl transition-opacity duration-500"></div>
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-gradient-to-br from-pink-500 to-pink-600 rounded-full flex items-center justify-center mb-6 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-white mb-4">Media Sosial</h4>
                    <div class="flex space-x-4">
                        <a href="https://facebook.com/laporpak" target="_blank" class="w-10 h-10 bg-gray-700 hover:bg-blue-600 rounded-full flex items-center justify-center transition-all duration-300 transform hover:-translate-y-1 shadow hover:shadow-lg" aria-label="Facebook">
                            <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22 12c0-5.522-4.477-10-10-10S2 6.478 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54v-2.89h2.54v-2.207c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.462h-1.26c-1.243 0-1.63.772-1.63 1.562v1.878h2.773l-.443 2.89h-2.33v6.987C18.343 21.128 22 16.991 22 12z"/>
                            </svg>
                        </a>
                        <a href="https://twitter.com/laporpak" target="_blank" class="w-10 h-10 bg-gray-700 hover:bg-blue-400 rounded-full flex items-center justify-center transition-all duration-300 transform hover:-translate-y-1 shadow hover:shadow-lg" aria-label="Twitter">
                            <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                            </svg>
                        </a>
                        <a href="https://instagram.com/laporpak" target="_blank" class="w-10 h-10 bg-gray-700 hover:bg-gradient-to-br hover:from-pink-500 hover:to-orange-400 rounded-full flex items-center justify-center transition-all duration-300 transform hover:-translate-y-1 shadow hover:shadow-lg" aria-label="Instagram">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                                <path d="M16 11.37a4 4 0 11-4.5-4.5 4 4 0 014.5 4.5z"/>
                                <line x1="17.5" y1="6.5" x2="17.5" y2="6.5"/>
                            </svg>
                        </a>
                        <a href="https://linkedin.com/company/laporpak" target="_blank" class="w-10 h-10 bg-gray-700 hover:bg-blue-700 rounded-full flex items-center justify-center transition-all duration-300 transform hover:-translate-y-1 shadow hover:shadow-lg" aria-label="LinkedIn">
                            <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



    {{-- Footer --}}
    <footer class="bg-gray-900/50 backdrop-blur-sm border-t border-gray-800 py-12 relative z-10">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-2 mb-6 md:mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" class="w-8 h-8">
                        <defs>
                        <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" style="stop-color:#3b82f6;stop-opacity:1" />
                            <stop offset="100%" style="stop-color:#06b6d4;stop-opacity:1" />
                        </linearGradient>
                        </defs>
                        <path stroke="url(#grad1)" fill="none" stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25M9 16.5v.75m3-3v3M15 12v5.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    <span class="text-2xl font-bold gradient-text">LaporPak</span>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-blue-300 transition duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-blue-300 transition duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-blue-300 transition duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-500 text-sm mb-4 md:mb-0">&copy; {{ date('Y') }} Sistem PKL. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-500 hover:text-blue-300 text-sm transition duration-300">Privacy Policy</a>
                    <a href="#" class="text-gray-500 hover:text-blue-300 text-sm transition duration-300">Terms of Service</a>
                    <a href="#" class="text-gray-500 hover:text-blue-300 text-sm transition duration-300">Contact Us</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS animation
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
</body>
</html>