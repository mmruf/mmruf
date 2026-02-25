<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login | MMRUF Admin Panel</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            font-family: 'Instrument Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 antialiased">
    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">

        <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
            <h1 class="text-4xl font-extrabold tracking-tighter text-blue-600 italic">
                MMRUF<span class="text-slate-800 not-italic">.</span>
            </h1>
            <h2 class="mt-4 text-2xl font-bold tracking-tight text-slate-900">
                Masuk ke Panel Admin
            </h2>
            <p class="mt-2 text-sm text-slate-500">
                Silakan masukkan kredensial Anda untuk melanjutkan.
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div
                class="bg-white py-10 px-6 shadow-xl shadow-slate-200/50 sm:rounded-2xl sm:px-10 border border-slate-100">

                <div x-data="{ loading: false, showPassword: false }">
                    <form action="{{ route('login.post') }}" method="POST" @submit="loading = true" class="space-y-6">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-semibold text-slate-700">Alamat
                                Email</label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" autocomplete="email" required
                                    value="{{ old('email') }}" placeholder="nama@perusahaan.com"
                                    class="block w-full rounded-xl border-0 p-2.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition duration-200 @error('email') ring-red-500 @enderror">
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <div class="flex items-center justify-between">
                                <label for="password"
                                    class="block text-sm font-semibold text-slate-700">Password</label>
                                <div class="text-sm">
                                    <a href="#" class="font-medium text-blue-600 hover:text-blue-500">Lupa
                                        password?</a>
                                </div>
                            </div>
                            <div class="mt-2 relative">
                                <input id="password" :type="showPassword ? 'text' : 'password'" name="password"
                                    required placeholder="••••••••"
                                    class="block w-full rounded-xl border-0 p-2.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition duration-200 @error('password') ring-red-500 @enderror">

                                <button type="button" @click="showPassword = !showPassword"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">
                                    <svg x-show="!showPassword" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                    </svg>
                                    <svg x-show="showPassword" x-cloak class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 010-.644m17.642 12.123A10.537 10.537 0 0012 18.75a10.545 10.545 0 00-7.678-3.414m17.642-4.066a10.537 10.537 0 01-1.391 2.323m-4.243 4.243a3 3 0 01-4.243-4.243m-4.243 4.243l-4.243-4.243m1.391-2.323a10.537 10.537 0 011.391-2.323" />
                                        <circle cx="12" cy="12" r="3" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox"
                                class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-600">
                            <label for="remember_me" class="ml-3 block text-sm text-slate-600">Ingat perangkat
                                ini</label>
                        </div>

                        <div>
                            <button type="submit"
                                class="flex w-full justify-center items-center rounded-xl bg-slate-900 px-3 py-3 text-sm font-bold leading-6 text-white shadow-sm hover:bg-slate-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-900 transition-all duration-200"
                                :class="loading ? 'opacity-70 cursor-not-allowed' : ''" :disabled="loading">

                                <svg x-show="loading" x-cloak class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>

                                <span x-show="!loading">Masuk Sekarang</span>
                                <span x-show="loading" x-cloak>Memverifikasi...</span>
                            </button>
                        </div>
                    </form>
                </div>

            </div>

            <p class="mt-10 text-center text-sm text-slate-500">
                Bukan Admin?
                <a href="{{ route('dashboard.index') }}"
                    class="font-semibold leading-6 text-blue-600 hover:text-blue-500">
                    Kembali ke Dashboard Utama
                </a>
            </p>
        </div>
    </div>
</body>

</html>
