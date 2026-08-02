<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'MMRUF')</title>

    <!-- Script & Style Vite (Tailwind CSS & Alpine.js) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Animasi Kustom: Teks Slide dari Kiri ke Kanan */
        @keyframes slideFromLeft {
            0% {
                opacity: 0;
                transform: translateX(-100px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-slide-left {
            animation: slideFromLeft 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Warna Custom Maroon jika dibutuhkan */
        .text-maroon {
            color: #800020;
        }

        .bg-maroon {
            background-color: #800020;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col font-sans">

    <!-- INTRO LOADER OVERLAY (Hitam + Text Maroon) -->
    <!-- INTRO LOADER OVERLAY (Hanya Muncul 1x Per Sesi) -->
    <div x-data="{ show: false }" x-init="if (!sessionStorage.getItem('hasSeenIntro')) {
        show = true;
        window.addEventListener('load', () => {
            setTimeout(() => {
                show = false;
                sessionStorage.setItem('hasSeenIntro', 'true');
            }, 1200);
        });
    }" x-show="show"
        x-transition:leave="transition ease-in-out duration-1000 transform"
        x-transition:leave-start="translate-y-0 opacity-100" x-transition:leave-end="translate-y-full opacity-0"
        class="fixed inset-0 z-[9999] flex flex-col items-center justify-center bg-black" x-cloak>
        <div class="relative flex flex-col items-center gap-4">
            <!-- Tulisan MMRUF -->
            <h1
                class="text-6xl md:text-8xl font-black tracking-widest text-[#800020] animate-slide-left drop-shadow-[0_0_25px_rgba(128,0,32,0.6)]">
                MMRUF
            </h1>

            <!-- Loading Line Accent -->
            <div class="w-32 h-1 bg-stone-900 rounded-full overflow-hidden relative mt-2">
                <div
                    class="absolute top-0 bottom-0 w-full bg-gradient-to-r from-transparent via-[#800020] to-transparent animate-pulse">
                </div>
            </div>
        </div>
    </div>
  

    <!-- HEADER / NAVBAR (Tema Putih & Maroon) -->
    <header x-data="{ mobileMenuOpen: false }"
        class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-rose-100 shadow-sm relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                <!-- Logo MMRUF (Kiri) -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="#"
                        class="text-2xl font-black tracking-wider text-[#800020] hover:text-rose-700 transition-colors">
                        MMRUF
                    </a>
                </div>

                <!-- Desktop Menu (Kanan) -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('public.home') }}"
                        class="text-slate-700 hover:text-[#800020] font-semibold transition-colors duration-200">
                        Home
                    </a>
                    <a href="{{ route('public.biodata.index') }}"
                        class="text-slate-700 hover:text-[#800020] font-semibold transition-colors duration-200">
                        Biodata
                    </a>
                    <a href="{{ route('public.life-events.index') }}"
                        class="text-slate-700 hover:text-[#800020] font-semibold transition-colors duration-200">
                        Life Events
                    </a>
                </nav>

                <!-- Hamburger Button (Tampilan Mobile) -->
                <div class="flex md:hidden items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button"
                        class="p-2 rounded-md text-slate-700 hover:text-[#800020] hover:bg-rose-50 focus:outline-none transition-colors"
                        aria-label="Toggle Menu">
                        <!-- Icon Hamburger -->
                        <svg x-show="!mobileMenuOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <!-- Icon Close (X) -->
                        <svg x-show="mobileMenuOpen" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown (Diubah ke absolute agar melayang & tidak mendorong main content) -->
        <div x-show="mobileMenuOpen" @click.outside="mobileMenuOpen = false" x-cloak
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
            class="absolute top-full left-0 w-full md:hidden bg-white border-b border-rose-100 px-4 pt-2 pb-4 space-y-1 shadow-lg z-50">
            <a href="{{ route('public.home') }}"
                class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-[#800020] hover:bg-rose-50 transition-colors">
                Home
            </a>
            <a href="{{ route('public.biodata.index') }}"
                class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-[#800020] hover:bg-rose-50 transition-colors">
                Biodata
            </a>
            <a href="{{ route('public.life-events.index') }}"
                class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-[#800020] hover:bg-rose-50 transition-colors">
                Life Events
            </a>
        </div>
    </header>


    <!-- MAIN CONTENT (Tema Putih & Maroon) -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-10">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-rose-100 py-6 text-center text-sm text-slate-500">
        &copy; {{ date('Y') }} <span class="font-bold text-[#800020]">MMRUF</span>. All rights reserved.
    </footer>

</body>

</html>
