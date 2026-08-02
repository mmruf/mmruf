<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Script & Style Vite (Tailwind CSS & Alpine.js) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js via CDN (hapus jika sudah di-import via Vite) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">

        <!-- Overlay untuk layar HP -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-20 bg-black/50 lg:hidden"></div>

        <!-- SIDEBAR KIRI (MERAH MAROON & PUTIH) -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-rose-950 text-white transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 flex flex-col justify-between border-r border-rose-900">

            <div>
                <!-- Logo & Brand -->
                <div class="flex items-center justify-between h-16 px-6 bg-rose-900/50 border-b border-rose-900">
                    <a href="#" class="flex items-center gap-2 text-xl font-bold text-white tracking-wide">
                        <svg class="w-7 h-7 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Admin mmruf
                    </a>
                    <!-- Tombol Tutup Mobile -->
                    <button @click="sidebarOpen = false" class="lg:hidden text-rose-300 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Navigasi Menu Dinamis -->
                <nav class="px-4 mt-6 space-y-1.5">

                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition border {{ request()->routeIs('admin.dashboard*') ? 'bg-rose-800 text-white border-rose-600 shadow-sm' : 'text-rose-100/70 hover:bg-rose-900/60 hover:text-white border-transparent' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard*') ? 'text-white' : 'text-rose-300' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    <!-- Educations -->
                    <a href="{{ route('admin.educations.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition border {{ request()->routeIs('admin.educations*') ? 'bg-rose-800 text-white border-rose-600 shadow-sm' : 'text-rose-100/70 hover:bg-rose-900/60 hover:text-white border-transparent' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.educations*') ? 'text-white' : 'text-rose-300' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        </svg>
                        Educations
                    </a>

                    <!-- Experiences -->
                    <a href="{{ route('admin.experiences.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition border {{ request()->routeIs('admin.experiences*') ? 'bg-rose-800 text-white border-rose-600 shadow-sm' : 'text-rose-100/70 hover:bg-rose-900/60 hover:text-white border-transparent' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.experiences*') ? 'text-white' : 'text-rose-300' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Experiences
                    </a>
                    <!-- Profile -->
                    <a href="{{ route('admin.profile.edit') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition border {{ request()->routeIs('admin.profile*') ? 'bg-rose-800 text-white border-rose-600 shadow-sm' : 'text-rose-100/70 hover:bg-rose-900/60 hover:text-white border-transparent' }}">
                        <!-- Ikon User / Profil -->
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.profile*') ? 'text-white' : 'text-rose-300' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profile
                    </a>
                    <!-- Life Years -->
                    <a href="{{ route('admin.life-years.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition border {{ request()->routeIs('admin.life-years*') ? 'bg-rose-800 text-white border-rose-600 shadow-sm' : 'text-rose-100/70 hover:bg-rose-900/60 hover:text-white border-transparent' }}">
                        <!-- Ikon Calendar / Timeline (Life Years) -->
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.life-years*') ? 'text-white' : 'text-rose-300' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Life Years
                    </a>
                    <!-- Life Event -->
                    <a href="{{ route('admin.life-events.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition border {{ request()->routeIs('admin.life-events*') ? 'bg-rose-800 text-white border-rose-600 shadow-sm' : 'text-rose-100/70 hover:bg-rose-900/60 hover:text-white border-transparent' }}">
                        <!-- Ikon Sparkles / Event (Life Event) -->
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.life-events*') ? 'text-white' : 'text-rose-300' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                        Life Event
                    </a>
                </nav>
            </div>

            <!-- Footer Sidebar / User Info -->
            <div class="p-4 border-t border-rose-900 bg-rose-900/30">
                <div class="flex items-center gap-3">
                    <div
                        class="w-9 h-9 rounded-full bg-rose-700 flex items-center justify-center font-bold text-white text-sm shadow">
                        A
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-semibold text-white truncate">Administrator</p>
                        <p class="text-xs text-rose-200/70 truncate">admin@domain.com</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- AREA KONTEN UTAMA -->
        <div class="flex-1 flex flex-col overflow-y-auto bg-slate-50">

            <!-- HEADER ATAS -->
            <header
                class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 sticky top-0 z-10">
                <div class="flex items-center gap-4">
                    <!-- Tombol Toggle Mobile -->
                    <button @click="sidebarOpen = true"
                        class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-lg font-semibold text-slate-800">@yield('page_heading', 'Dashboard')</h1>
                </div>

                <!-- Action Header (Notifikasi & Profil) -->
                <div class="flex items-center gap-3">
                    <button class="p-2 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-100 relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-rose-600 rounded-full"></span>
                    </button>
                </div>
            </header>

            <!-- KONTEN HALAMAN (YIELD) -->
            <main class="p-6">
                @yield('content')
            </main>

        </div>
    </div>

</body>

</html>
