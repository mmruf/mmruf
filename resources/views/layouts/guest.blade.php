<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MMRUF | Portal</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Instrument Sans', sans-serif; overflow: hidden; }
        [x-cloak] { display: none !important; }
        
        /* Background Pattern: Titik-titik halus (Dot Matrix) */
        .bg-dot-pattern {
            background-image: radial-gradient(#e5e7eb 1px, transparent 1px);
            background-size: 24px 24px;
        }

        /* Animasi masuk untuk Card */
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="h-full w-full select-none bg-white text-slate-900" x-data="{ mobileMenu: false }">

    <div class="relative h-screen w-screen overflow-hidden flex flex-col bg-dot-pattern">
        
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-blue-50/50 rounded-full blur-3xl -z-10 -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-indigo-50/50 rounded-full blur-3xl -z-10 translate-x-1/4 translate-y-1/4"></div>

        <header class="relative z-50">
            <nav class="max-w-7xl mx-auto px-6 py-6 flex items-center justify-between">
                <div class="flex items-center">
                    <h1 class="text-3xl font-extrabold tracking-tighter text-slate-900 italic leading-none">
                        MMRUF<span class="text-blue-600 not-italic">.</span>
                    </h1>
                </div>

                <div class="hidden md:flex items-center space-x-10">
                    <a href="/" class="text-slate-500 hover:text-slate-900 font-medium transition duration-300">Dashboard</a>
                    <a href="{{ route('apps.index') }}" class="text-slate-500 hover:text-slate-900 font-medium transition duration-300">Aplikasi</a>
                    <a href="{{ route('login') }}" class="px-6 py-2 bg-slate-900 hover:bg-slate-800 text-white rounded-full font-bold transition shadow-lg shadow-slate-200">
                        Masuk
                    </a>
                </div>

                <div class="md:hidden">
                    <button @click="mobileMenu = !mobileMenu" class="text-slate-900 focus:outline-none p-2 bg-slate-100 rounded-lg">
                        <svg x-show="!mobileMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="mobileMenu" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </nav>

            <div x-show="mobileMenu" x-cloak x-transition class="absolute top-20 left-6 right-6 bg-white border border-slate-100 rounded-2xl shadow-2xl p-6 md:hidden">
                <div class="flex flex-col space-y-4">
                    <a href="/" class="text-slate-800 font-bold py-2 border-b border-slate-50">Dashboard</a>
                    <a href="{{ route('apps.index') }}" class="text-slate-800 font-bold py-2 border-b border-slate-50">Aplikasi</a>
                    <a href="{{ route('login') }}" class="w-full text-center bg-slate-900 text-white py-3 rounded-xl font-bold">Masuk Sekarang</a>
                </div>
            </div>
        </header>

        <main class="flex-1 flex items-center justify-center relative z-10 px-4">
            @yield('content')
        </main>

        <footer class="relative z-10 py-8 text-center">
            <p class="text-slate-400 text-xs tracking-[0.3em] font-medium uppercase">MMRUF Ecosystem &bull; 2026</p>
        </footer>
    </div>
</body>
</html>