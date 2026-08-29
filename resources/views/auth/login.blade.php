<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Login - Portofolio & Biodata')</title>

    <!-- Script & Style Vite (Tailwind CSS & Alpine.js) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js via CDN (hapus jika sudah di-import via Vite) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Font Inter & Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4 relative overflow-hidden font-sans">

    <!-- Ornamen Dekorasi Background -->
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-[#800020] rounded-full opacity-10 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-[#6b0d1e] rounded-full opacity-10 blur-3xl pointer-events-none"></div>

    <!-- Container Login Card (Menggunakan Alpine.js untuk state password) -->
    <div x-data="{ showPassword: false }" class="w-full max-w-md bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden relative z-10 transition-all duration-300">
        
        <!-- Header Banner (Maroon Accent) -->
        <div class="bg-gradient-to-r from-[#4a0512] via-[#800020] to-[#6b0d1e] p-8 text-white text-center relative">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/10 backdrop-blur-md mb-3 border border-white/20 shadow-inner">
                <i class="fa-solid fa-user-lock text-2xl text-white"></i>
            </div>
            <h2 class="text-2xl font-bold tracking-tight">Selamat Datang</h2>
            <p class="text-rose-100 text-sm mt-1 font-light">Silakan masuk untuk mengakses sistem</p>
        </div>

        <!-- Form Section -->
        <div class="p-8">

            <!-- Alert Error -->
            @if ($errors->any())
                <div class="mb-5 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm flex items-start gap-3">
                    <i class="fa-solid fa-triangle-exclamation mt-0.5 text-red-500"></i>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Input Email -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">
                        Alamat Email
                    </label>
                    <div class="relative rounded-xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <i class="fa-regular fa-envelope"></i>
                        </div>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                            class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#800020] focus:bg-white focus:ring-2 focus:ring-[#800020]/20 transition-all"
                            placeholder="nama@email.com">
                    </div>
                </div>

                <!-- Input Password (Menggunakan Alpine.js) -->
                <div>
                    <label for="password" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">
                        Kata Sandi
                    </label>
                    <div class="relative rounded-xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <input :type="showPassword ? 'text' : 'password'" name="password" id="password" required
                            class="w-full pl-10 pr-10 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#800020] focus:bg-white focus:ring-2 focus:ring-[#800020]/20 transition-all"
                            placeholder="••••••••">
                        
                        <!-- Toggle Password Visibility -->
                        <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-[#800020] transition-colors">
                            <i class="fa-regular" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                </div>

                <!-- Option Checkbox (Remember Me) -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded text-[#800020] focus:ring-[#800020] border-gray-300">
                        <span class="text-gray-600 text-xs font-medium">Ingat Saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                    class="w-full py-3.5 px-4 bg-[#800020] hover:bg-[#6b0d1e] active:bg-[#4a0512] text-white font-semibold rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                    <span>Masuk Aplikasi</span>
                    <i class="fa-solid fa-arrow-right text-sm"></i>
                </button>
            </form>

            <!-- Footer Info Akun Demo -->
            <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                <p class="text-xs text-gray-400 mb-2">Gunakan Akun Berikut untuk Testing:</p>
                <div class="flex justify-center gap-2 text-xs">
                    <span class="px-2.5 py-1 bg-gray-100 text-gray-600 rounded-md font-mono">admin@gmail.com</span>
                    <span class="px-2.5 py-1 bg-gray-100 text-gray-600 rounded-md font-mono">guest@gmail.com</span>
                </div>
            </div>
            <!-- Tambahan Akses Modul Volleyball -->
            <div class="mt-4 pt-4 border-t border-dashed border-gray-200 text-center">
                <a href="{{ url('/volleyball') }}" class="inline-flex items-center justify-center gap-2 w-full py-2.5 px-4 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-xl transition-all">
                    <i class="fa-solid fa-volleyball text-[#800020]"></i>
                    <span>Akses Papan Skor Volleyball</span>
                </a>
            </div>

        </div>
    </div>

</body>
</html>