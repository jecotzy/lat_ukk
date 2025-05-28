<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
    <style>
    .gradient-text {
        background: linear-gradient(90deg, #3b82f6, #06b6d4);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    @keyframes float-slow {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-15px); }
    }

    @keyframes float-medium {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-25px); }
    }

    .animate-float-slow {
      animation: float-slow 6s ease-in-out infinite;
    }

    .animate-float-medium {
      animation: float-medium 8s ease-in-out infinite;
    }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-950 via-gray-900 to-gray-950 text-gray-100 antialiased relative overflow-hidden dark:text-gray-100">

    <!-- Blur circles background -->
    <div class="absolute inset-0 pointer-events-none -z-10 overflow-hidden">
        <div class="absolute top-1/4 left-1/4 w-48 h-48 bg-blue-500/10 rounded-full filter blur-3xl animate-float-slow opacity-20"></div>
        <div class="absolute bottom-1/3 right-1/4 w-56 h-56 bg-purple-500/10 rounded-full filter blur-3xl animate-float-medium opacity-20"></div>
    </div>

    <div class="flex min-h-screen flex-col items-center justify-center gap-6 p-6 md:p-10">
        <div class="flex w-full max-w-sm flex-col gap-2 z-10 relative">
            <a href="{{ route('home') }}" class="flex items-center space-x-2 font-medium" wire:navigate>
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
            </a>

            <div class="flex flex-col gap-6">
                {{ $slot }}
            </div>
        </div>
    </div>

    @fluxScripts
</body>
</html>
