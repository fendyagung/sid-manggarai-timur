@php
    $dpmdProfile = \App\Models\DpmdProfile::first();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Pesona Manggarai Timur</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=Lora:wght@400;500;600&family=DM+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    <style>
        :root {
            --biru-navy: #0f172a;
            --biru-muted: #1e293b;
            --emas: #d97706;
            --emas-muda: #f59e0b;
            --emas-pale: #fffbeb;
            --krem: #f8fafc;
            --putih: #ffffff;
            --abu: #f1f5f9;
            --teks: #0f172a;
            --teks-abu: #475569;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--krem);
            color: var(--teks);
        }

        h1,
        h2,
        h3,
        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        @keyframes bounce-subtle {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        .animate-bounce-subtle {
            animation: bounce-subtle 2s infinite;
        }
    </style>
</head>

@php
    $profile = \App\Models\DpmdProfile::first();
@endphp

<body
    class="bg-slate-50 text-slate-800 dark:bg-slate-900 dark:text-slate-100 antialiased transition-colors duration-300">
    <!-- Navigation -->
    <nav class="fixed w-full z-50 transition-all duration-300 bg-[#fdf8f0]/90 dark:bg-slate-900/90 backdrop-blur-md border-b border-[#e2e8f0] dark:border-slate-800 shadow-sm"
        id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-3 mr-8 min-w-fit">
                    <!-- Logo Section -->
                    <a href="{{ url('/') }}" class="flex items-center gap-3">
                        @if($profile && $profile->logo_website)
                            <img src="{{ asset('storage/' . $profile->logo_website) }}" alt="Logo"
                                class="h-12 w-auto object-contain">
                        @else
                            <div
                                class="w-10 h-10 bg-amber-600 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-amber-600/30">
                                M
                            </div>
                        @endif
                        <div class="flex flex-col justify-center">
                            <span
                                class="block font-bold text-xl tracking-tighter text-slate-800 dark:text-white leading-tight">SID</span>
                            <span
                                class="block text-[9px] font-extrabold text-slate-400 dark:text-slate-500 tracking-[0.15em] whitespace-nowrap uppercase">Manggarai
                                Timur</span>
                        </div>
                    </a>
                </div>
                <div class="hidden lg:flex items-center h-20 mr-10">
                    @if(!Request::is('dashboard*'))
                        <div class="flex items-center gap-4">
                            <a href="{{ url('/') }}"
                                class="px-4 py-2 mx-0.5 flex items-center font-bold text-[13px] whitespace-nowrap transition-all duration-300 {{ Request::is('/') ? 'bg-[#064e3b] dark:bg-emerald-600 text-white shadow-md rounded-lg' : 'text-slate-600 dark:text-slate-300 hover:text-[#064e3b] dark:hover:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-lg' }}">
                                BERANDA
                            </a>
                            <a href="{{ route('public.profil') }}"
                                class="px-4 py-2 mx-0.5 flex items-center font-bold text-[13px] whitespace-nowrap transition-all duration-300 {{ Request::is('profil') ? 'bg-[#064e3b] dark:bg-emerald-600 text-white shadow-md rounded-lg' : 'text-slate-600 dark:text-slate-300 hover:text-[#064e3b] dark:hover:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-lg' }}">
                                PROFIL
                            </a>
                            <a href="{{ route('public.desa-wisata') }}"
                                class="px-4 py-2 mx-0.5 flex items-center font-bold text-[13px] whitespace-nowrap transition-all duration-300 {{ Request::is('jelajah/desa-wisata') ? 'bg-[#064e3b] dark:bg-emerald-600 text-white shadow-md rounded-lg' : 'text-slate-600 dark:text-slate-300 hover:text-[#064e3b] dark:hover:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-lg' }}">
                                DESA WISATA
                            </a>
                            <a href="{{ route('public.komoditi') }}"
                                class="px-4 py-2 mx-0.5 flex items-center font-bold text-[13px] whitespace-nowrap transition-all duration-300 {{ Request::is('jelajah/komoditi') ? 'bg-[#064e3b] dark:bg-emerald-600 text-white shadow-md rounded-lg' : 'text-slate-600 dark:text-slate-300 hover:text-[#064e3b] dark:hover:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-lg' }}">
                                KOMODITI
                            </a>
                            <a href="{{ route('public.laporan-desa') }}"
                                class="px-4 py-2 mx-0.5 flex items-center font-bold text-[13px] whitespace-nowrap transition-all duration-300 {{ Request::is('laporan-desa') ? 'bg-[#064e3b] dark:bg-emerald-600 text-white shadow-md rounded-lg' : 'text-slate-600 dark:text-slate-300 hover:text-[#064e3b] dark:hover:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-lg' }}">
                                LAPORAN DESA
                            </a>
                            <a href="{{ route('public.berita') }}"
                                class="px-4 py-2 mx-0.5 flex items-center font-bold text-[13px] whitespace-nowrap transition-all duration-300 {{ Request::is('berita') ? 'bg-[#064e3b] dark:bg-emerald-600 text-white shadow-md rounded-lg' : 'text-slate-600 dark:text-slate-300 hover:text-[#064e3b] dark:hover:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-lg' }}">
                                BERITA
                            </a>
                            <a href="{{ route('public.kontak') }}"
                                class="px-4 py-2 mx-0.5 flex items-center font-bold text-[13px] whitespace-nowrap transition-all duration-300 {{ Request::is('layanan/kontak') ? 'bg-[#064e3b] dark:bg-emerald-600 text-white shadow-md rounded-lg' : 'text-slate-600 dark:text-slate-300 hover:text-[#064e3b] dark:hover:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-lg' }}">
                                KONTAK
                            </a>
                        </div>
                    @else
                        <div class="px-6 flex items-center border-l border-slate-100">
                            <span class="text-xs font-bold text-slate-400 tracking-widest">PANEL ADMINISTRASI</span>
                        </div>
                    @endif
                </div>
                <div class="flex items-center space-x-4">
                    @if(Request::is('dashboard*'))
                        <a href="{{ url('/') }}"
                            class="hidden md:flex items-center gap-2 px-4 py-2 text-xs font-bold text-[#2b529a] bg-blue-50 rounded-full hover:bg-[#2b529a] hover:text-white transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9" />
                            </svg>
                            LIHAT WEBSITE
                        </a>
                    @endif
                    @auth
                        <div class="relative group">
                            <button
                                class="flex items-center gap-2 text-slate-700 hover:text-emerald-600 font-medium transition-colors focus:outline-none">
                                <span>{{ Auth::user()->name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="hidden md:block">
                                <x-theme-switcher />
                            </div>
                            <!-- Dropdown -->
                            <div
                                class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl py-2 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all transform origin-top-right border border-gray-100 z-50">
                                <a href="{{ route('dashboard') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600">
                                    Dashboard
                                </a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-medium">
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-4">
                            <a href="{{ route('login') }}" style="background-color: #d97706; color: #ffffff;"
                                class="px-4 py-2 text-xs font-bold rounded-full shadow-lg shadow-amber-600/20 hover:scale-105 transition-all">
                                Login Admin
                            </a>
                            <x-theme-switcher />
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    @if(!Request::is('dashboard*'))
        <!-- Footer -->
        <footer class="bg-slate-900 text-white pt-16 pb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                    <div class="col-span-1 md:col-span-1">
                        <div class="flex items-center gap-3 mb-6">
                            @if($profile && $profile->logo_website)
                                <img src="{{ asset('storage/' . $profile->logo_website) }}" alt="Logo"
                                    class="h-10 w-auto object-contain bg-white/10 rounded p-1">
                            @else
                                <div
                                    class="w-10 h-10 bg-emerald-500 rounded-lg flex items-center justify-center text-white font-bold text-xl">
                                    M
                                </div>
                            @endif
                            <span class="font-bold text-xl tracking-tight">SID Manggarai Timur</span>
                        </div>
                        <p class="text-slate-300 text-sm leading-relaxed">
                            Sistem Informasi Profil dan Pelaporan Desa Kabupaten Manggarai Timur. Mengintegrasikan potensi
                            wisata dan administrasi desa dalam satu platform modern.
                        </p>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-4">Jelajah</h3>
                        <ul class="space-y-3 text-slate-300 text-sm">
                            <li><a href="{{ route('public.desa-wisata') }}"
                                    class="hover:text-amber-400 transition-colors">Desa Wisata</a></li>
                            <li><a href="{{ route('public.komoditi') }}"
                                    class="hover:text-amber-400 transition-colors">Komoditi Unggulan</a></li>
                            <li><a href="{{ route('public.kuliner') }}"
                                    class="hover:text-amber-400 transition-colors">Kuliner Khas</a></li>
                            <li><a href="{{ route('public.kerajinan') }}"
                                    class="hover:text-amber-400 transition-colors">Kerajinan Tangan</a></li>
                            <li><a href="{{ route('public.event') }}" class="hover:text-amber-400 transition-colors">Event
                                    Budaya</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-4">Layanan</h3>
                        <ul class="space-y-3 text-slate-300 text-sm">
                            <li><a href="{{ route('login') }}" class="hover:text-amber-500 transition-colors">Login Admin
                                    Desa</a></li>
                            <li><a href="{{ route('login') }}" class="hover:text-amber-500 transition-colors">Login Admin
                                    DPMD</a></li>
                            <li><a href="{{ route('public.panduan') }}"
                                    class="hover:text-amber-500 transition-colors">Panduan Pelaporan</a></li>
                            <li><a href="{{ route('public.kontak') }}" class="hover:text-amber-500 transition-colors">Kontak
                                    Bantuan</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-4">DPMD Manggarai Timur</h3>
                        <p class="text-slate-300 text-sm leading-relaxed mb-4">
                            {{ $dpmdProfile->alamat ?? 'Jl. Trans Flores, Borong, Kabupaten Manggarai Timur, Nusa Tenggara Timur.' }}
                            <br>
                            {{ $dpmdProfile->telepon ?? '(0385) 123456' }} • {{ $dpmdProfile->email ??
                            'info@dpmdmatim.go.id' }}
                        </p>
                        <div class="flex space-x-4">
                            <a href="#"
                                class="w-10 h-10 bg-gradient-to-tr from-[#f9ce34] via-[#ee2a7b] to-[#6228d7] rounded-full flex items-center justify-center text-white transition-all transform hover:-translate-y-1 shadow-lg hover:shadow-purple-500/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-[#1877F2] rounded-full flex items-center justify-center text-white transition-all transform hover:-translate-y-1 shadow-lg hover:shadow-blue-500/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-[#FF0000] rounded-full flex items-center justify-center text-white transition-all transform hover:-translate-y-1 shadow-lg hover:shadow-red-500/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.377.505 9.377.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.930-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div
                    class="border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-slate-500">
                    <p>&copy; 2026 DPMD Kabupaten Manggarai Timur. Developed by Mahasiswa Magang.</p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#" class="hover:text-slate-300">Privacy Policy</a>
                        <a href="#" class="hover:text-slate-300">Terms of Service</a>
                    </div>
                </div>
            </div>
        </footer>
    @endif

    <script>
        // Navbar Scroll Effect
        window.addEventListener('scroll', function () {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 20) {
                navbar.classList.add('shadow-md');
            } else {
                navbar.classList.remove('shadow-md');
            }
        });

        // Scroll Reveal Animation (Intersection Observer)
        const revealCallback = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    // Once visible, no need to observe anymore
                    // observer.unobserve(entry.target);
                }
            });
        };

        const revealObserver = new IntersectionObserver(revealCallback, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        document.querySelectorAll('.reveal').forEach(el => {
            revealObserver.observe(el);
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fslightbox/3.0.9/index.js"></script>
</body>

</html>