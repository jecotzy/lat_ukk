<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <title>Lapor Pak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body class="bg-gradient-to-br from-gray-900 to-gray-800 text-gray-200 antialiased min-h-screen">

    {{-- Navigation --}}
    <nav class="container mx-auto px-8 py-5 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <img src="{{ asset('storage/writing.png') }}" alt="Writing Icon" class="w-8 h-8 filter invert" />
            <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-blue-300">LaporPak</span>
        </div>
        <div class="hidden md:flex space-x-6">
            <a href="#features" class="hover:text-blue-300 transition duration-300">Fitur</a>
            <a href="#about" class="hover:text-blue-300 transition duration-300">Tentang</a>
            <a href="#contact" class="hover:text-blue-300 transition duration-300">Kontak</a>
        </div>
        <div class="md:hidden">
            <!-- Mobile menu button -->
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="container mx-auto px-8 py-30 md:py-30 flex flex-col md:flex-row items-center justify-between gap-12">
        <div class="flex flex-col md:w-1/2 text-center md:text-left animate__animated animate__fadeInLeft">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 leading-tight">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-blue-300">Lapor Pak</span><br>
                Modern & Efisien
            </h1>
            <p class="text-lg md:text-xl text-gray-400 mb-8 leading-relaxed max-w-lg">
                Platform digital terintegrasi untuk mengelola seluruh proses Praktik Kerja Lapangan jurusan Sistem Informasi Jaringan dan Aplikasi dengan mudah dan efektif.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                <a href="{{ route('login') }}"
                   class="px-8 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-300 ">
                    Masuk Sekarang
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="px-8 py-3 border-2 border-blue-400 text-blue-300 hover:bg-blue-900/30 hover:text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-300">
                        Daftar Akun
                    </a>
                @endif
            </div>
        </div>

<div class="flex-shrink-0 flex items-center justify-center w-full md:w-1/2 animate__animated animate__fadeInRight">
    <div class="relative w-[320px] h-[320px]">
        <div class="absolute inset-0 m-8 bg-blue-500/10 rounded-full blur-xl animate-pulse"></div>
        <div class="relative w-full h-full bg-gray-800/50 backdrop-blur-sm rounded-full shadow-2xl border border-gray-700/50 flex items-center justify-center overflow-hidden p-2">
            <img src="{{ asset('storage/boss.gif') }}" alt="Boss Animation" class="w-full h-full object-cover scale-105  transition-transform duration-300" />
        </div>
    </div>
</div>


    </section>


    {{-- Features Section --}}
    <section id="features" class="py-20 bg-gradient-to-b from-gray-800/50 to-gray-900/50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 animate__animated animate__fadeIn">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Fitur Unggulan Sistem</h2>
                <p class="max-w-2xl mx-auto text-gray-400">Solusi lengkap untuk manajemen Praktik Kerja Lapangan</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gray-800/50 backdrop-blur-sm p-8 rounded-xl border border-gray-700/50 hover:border-blue-500/30 transition-all duration-300 hover:-translate-y-2 shadow-lg hover:shadow-xl animate__animated animate__fadeInUp">
                    <div class="w-16 h-16 bg-blue-900/30 rounded-lg flex items-center justify-center mb-6 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-center">Manajemen Siswa</h3>
                    <p class="text-gray-400 text-center">Kelola data siswa PKL secara digital dengan fitur lengkap mulai dari pendaftaran hingga penilaian akhir.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-gray-800/50 backdrop-blur-sm p-8 rounded-xl border border-gray-700/50 hover:border-blue-500/30 transition-all duration-300 hover:-translate-y-2 shadow-lg hover:shadow-xl animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="w-16 h-16 bg-blue-900/30 rounded-lg flex items-center justify-center mb-6 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-center">Industri Mitra</h3>
                    <p class="text-gray-400 text-center">Database industri mitra PKL dengan informasi lengkap dan sistem pemantauan kerjasama.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-gray-800/50 backdrop-blur-sm p-8 rounded-xl border border-gray-700/50 hover:border-blue-500/30 transition-all duration-300 hover:-translate-y-2 shadow-lg hover:shadow-xl animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="w-16 h-16 bg-blue-900/30 rounded-lg flex items-center justify-center mb-6 mx-auto">
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
    <section class="py-20 bg-gray-800/30 backdrop-blur-sm">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="p-6">
                    <div class="text-4xl font-bold text-blue-400 mb-2">500+</div>
                    <div class="text-gray-400">Siswa Terdaftar</div>
                </div>
                <div class="p-6">
                    <div class="text-4xl font-bold text-blue-400 mb-2">50+</div>
                    <div class="text-gray-400">Industri Mitra</div>
                </div>
                <div class="p-6">
                    <div class="text-4xl font-bold text-blue-400 mb-2">100%</div>
                    <div class="text-gray-400">Kepuasan Pengguna</div>
                </div>
                <div class="p-6">
                    <div class="text-4xl font-bold text-blue-400 mb-2">24/7</div>
                    <div class="text-gray-400">Dukungan Sistem</div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-20">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Siap Mengoptimalkan Manajemen PKL Anda?</h2>
            <p class="max-w-2xl mx-auto text-gray-400 mb-8">Bergabunglah dengan ratusan institusi pendidikan yang telah mempercayakan sistem manajemen PKL mereka kepada kami.</p>
            <a href="{{ route('register') }}"
               class="inline-block px-8 py-4 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg font-semibold text-lg shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                Daftar Sekarang - Gratis!
            </a>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-gray-900/50 backdrop-blur-sm border-t border-gray-800 py-12">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-2 mb-6 md:mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-blue-300">SistemPKL</span>
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

</body>
</html>