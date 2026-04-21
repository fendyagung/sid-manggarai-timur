@php
    $dpmdProfile = \App\Models\DpmdProfile::first();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>{{ config('app.name', 'Laravel') }} - Pesona Manggarai Timur</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=Lora:wght@400;500;600&family=DM+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script>
        // On page load - Respect system preference if no explicit choice made
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

        /* NAVBAR SCROLLED STATE */
        #navbar.nav-scrolled {
            background-color: rgba(255, 255, 255, 1) !important; 
            padding-top: 0.5rem !important;
            padding-bottom: 0.5rem !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .dark #navbar.nav-scrolled {
            background-color: rgba(15, 23, 42, 1) !important;
            border-color: rgba(255, 255, 255, 0.05);
        }

        .nav-text-white {
           color: #1e293b !important; /* Default dark for light mode */
           transition: all 0.3s ease;
        }

        .dark .nav-text-white {
           color: #f1f5f9 !important; /* White for dark mode */
        }

        /* EXCEPT: On hero pages when at the top (transparent), we want white text even in light mode */
        #navbar.transparent-white-text:not(.nav-scrolled) .nav-text-white {
           color: #ffffff !important;
        }

        #navbar.transparent-white-text:not(.nav-scrolled) .active-nav {
           background-color: rgba(255, 255, 255, 0.15) !important;
           color: #ffffff !important;
        }

        #navbar.nav-scrolled .nav-text-white {
           color: #1e293b !important;
        }

        .dark #navbar.nav-scrolled .nav-text-white {
           color: #f1f5f9 !important;
        }

        .active-nav {
           background-color: rgba(30, 41, 59, 0.05);
           color: #1e293b !important;
        }

        .dark .active-nav {
           background-color: rgba(255, 255, 255, 0.1);
           color: #ffffff !important;
        }

        #navbar.nav-scrolled .active-nav {
           background-color: rgba(30, 41, 59, 0.05) !important;
           color: #0d2818 !important;
        }

        .dark #navbar.nav-scrolled .active-nav {
           background-color: rgba(255, 255, 255, 0.1) !important;
           color: #ffffff !important;
        }
    </style>
</head>

@php
    $profile = \App\Models\DpmdProfile::first();
@endphp

<body
    class="bg-slate-50 text-slate-800 dark:bg-slate-900 dark:text-slate-100 antialiased transition-colors duration-300 overflow-x-hidden">    @php
        $isHeroPage = request()->routeIs('public.home') || 
                      request()->is('/') || 
                      request()->routeIs('public.laporan-desa') || 
                      request()->is('laporan-desa*') ||
                      request()->routeIs('public.panduan') || 
                      request()->routeIs('public.bank-data');
    @endphp

    <!-- Navigation -->
    <nav class="fixed w-full z-50 transition-all duration-300 bg-transparent dark:bg-transparent backdrop-blur-md border-b border-transparent {{ $isHeroPage ? 'transparent-white-text' : '' }}"
        id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center min-w-fit" style="gap: 1.25rem;">
                    <!-- Hamburger / Mobile Menu Button -->
                    <button id="mobile-menu-open" class="lg:hidden p-2 text-white hover:text-white nav-text-white transition-all">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <!-- Logo Section -->
                    <a href="{{ url('/') }}" class="flex items-center gap-3">
                        @if($profile && $profile->logo_website)
                            <img src="{{ asset('storage/' . $profile->logo_website) }}" alt="Logo"
                                class="h-10 md:h-12 w-auto object-contain">
                        @else
                            <div
                                class="w-10 h-10 bg-amber-600 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-amber-600/30">
                                M
                            </div>
                        @endif
                        <div class="flex flex-col justify-center">
                            <span
                                class="block font-bold text-lg md:text-xl tracking-tighter nav-text-white leading-tight">SID Manggarai Timur</span>
                        </div>
                    </a>
                </div>
                <div class="hidden lg:flex items-center h-20 mr-10">
                    @if(!Request::is('dashboard*') && !Request::is('login') && !Request::is('register') && !Request::is('forgot-password') && !Request::is('reset-password*'))
                        <div class="flex items-center gap-4">
                            @if(request()->routeIs('public.home') || request()->is('/') || request()->path() == '/')
                                <div class="flex items-center gap-6 mr-8 transition-all duration-300">
                                    <a href="#fitur"
                                        class="text-[10px] font-black nav-text-white hover:text-amber-400 transition-all tracking-[0.2em] uppercase">Fitur</a>
                                    <a href="#wisata"
                                        class="text-[10px] font-black nav-text-white hover:text-amber-400 transition-all tracking-[0.2em] uppercase">Desa
                                        Wisata</a>
                                    <a href="#pengumuman"
                                        class="text-[10px] font-black nav-text-white hover:text-amber-400 transition-all tracking-[0.2em] uppercase">Berita Utama</a>
                                    <a href="#cara"
                                        class="text-[10px] font-black nav-text-white hover:text-amber-400 transition-all tracking-[0.2em] uppercase">Cara
                                        Kerja</a>
                                </div>
                                <div class="w-px h-6 bg-slate-200 dark:bg-white/10 mr-8"></div>
                            @endif

                            <a href="{{ url('/') }}"
                                class="px-3 py-1.5 mx-0.5 flex items-center font-bold text-[11px] whitespace-nowrap transition-all duration-300 {{ Request::is('/') ? 'active-nav bg-white/15 nav-text-white rounded-lg' : 'nav-text-white hover:bg-white/10 rounded-lg' }}"
                                id="nav-home">
                                BERANDA
                            </a>
                            <a href="{{ route('public.profil') }}"
                                class="px-3 py-1.5 mx-0.5 flex items-center font-bold text-[11px] whitespace-nowrap transition-all duration-300 {{ Request::is('profil') ? 'active-nav bg-white/15 nav-text-white rounded-lg' : 'nav-text-white hover:bg-white/10 rounded-lg' }}"
                                id="nav-profil">
                                PROFIL
                            </a>
                            <a href="{{ route('public.desa-wisata') }}"
                                class="px-3 py-1.5 mx-0.5 flex items-center font-bold text-[11px] whitespace-nowrap transition-all duration-300 {{ Request::is('jelajah/desa-wisata') ? 'active-nav bg-white/15 nav-text-white rounded-lg' : 'nav-text-white hover:bg-white/10 rounded-lg' }}"
                                id="nav-desa-wisata">
                                DESA WISATA
                            </a>
                            <a href="{{ route('public.komoditi') }}"
                                class="px-3 py-1.5 mx-0.5 flex items-center font-bold text-[11px] whitespace-nowrap transition-all duration-300 {{ Request::is('jelajah/komoditi') ? 'active-nav bg-white/15 nav-text-white rounded-lg' : 'nav-text-white hover:bg-white/10 rounded-lg' }}"
                                id="nav-komoditi">
                                KOMODITI
                            </a>
                            <a href="{{ route('public.laporan-desa') }}"
                                class="px-3 py-1.5 mx-0.5 flex items-center font-bold text-[11px] whitespace-nowrap transition-all duration-300 {{ Request::is('laporan-desa') ? 'active-nav bg-white/15 nav-text-white rounded-lg' : 'nav-text-white hover:bg-white/10 rounded-lg' }}"
                                id="nav-laporan">
                                LAPORAN DESA
                            </a>
                            <a href="{{ route('public.bank-data') }}"
                                class="px-3 py-1.5 mx-0.5 flex items-center font-bold text-[11px] whitespace-nowrap transition-all duration-300 {{ Request::is('layanan/bank-data') ? 'active-nav bg-white/15 nav-text-white rounded-lg' : 'nav-text-white hover:bg-white/10 rounded-lg' }}"
                                id="nav-regulasi">
                                REGULASI
                            </a>
                            <a href="{{ route('public.berita') }}"
                                class="px-3 py-1.5 mx-0.5 flex items-center font-bold text-[11px] whitespace-nowrap transition-all duration-300 {{ Request::is('berita') ? 'active-nav bg-white/15 nav-text-white rounded-lg' : 'nav-text-white hover:bg-white/10 rounded-lg' }}"
                                id="nav-berita">
                                KEGIATAN
                            </a>
                            <a href="{{ route('public.kontak') }}"
                                class="px-3 py-1.5 mx-0.5 flex items-center font-bold text-[11px] whitespace-nowrap transition-all duration-300 {{ Request::is('layanan/kontak') ? 'active-nav bg-white/15 nav-text-white rounded-lg' : 'nav-text-white hover:bg-white/10 rounded-lg' }}"
                                id="nav-kontak">
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
                    @if(!Request::is('login') && !Request::is('register') && !Request::is('forgot-password') && !Request::is('reset-password*'))
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
                            <a href="{{ route('dashboard') }}"
                                class="flex items-center gap-2 px-5 py-2 text-[11px] font-black nav-text-white bg-white/10 dark:bg-white/5 hover:bg-white/20 rounded-full transition-all border border-slate-200 dark:border-white/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 nav-text-white" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <span class="nav-text-white">BERANDA</span>
                            </a>

                            <div class="block">
                                <x-theme-switcher />
                            </div>

                            <div class="relative group">
                                <button
                                    class="flex items-center gap-2 nav-text-white hover:text-amber-500 font-bold text-xs tracking-wider transition-colors focus:outline-none uppercase">
                                    <span class="nav-text-white">{{ Auth::user()->name }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 nav-text-white" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <!-- Dropdown -->
                                <div
                                    class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl py-2 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all transform origin-top-right border border-gray-100 z-50">
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
                            <div class="flex items-center gap-2 md:gap-4">
                                <a href="{{ route('login') }}"
                                    style="background: linear-gradient(135deg, #d97706, #f59e0b); color: #ffffff;"
                                    class="px-3 md:px-5 py-2 text-[10px] md:text-xs font-bold rounded-full shadow-lg shadow-amber-600/30 hover:scale-105 transition-all flex items-center gap-2">
                                    <span class="hidden md:inline">🔐 Masuk</span>
                                    <span class="md:hidden">🔐 MASUK</span>
                                </a>
                                <x-theme-switcher />
                            </div>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Slide-over -->
    <div id="mobile-menu-container" class="fixed inset-0 z-[100] invisible">
        <!-- Backdrop -->
        <div id="mobile-menu-backdrop" class="absolute inset-0 bg-navy-950/60 backdrop-blur-sm opacity-0 transition-opacity duration-300 pointer-events-none"></div>
        
        <!-- Sidebar -->
        <div id="mobile-menu-sidebar" class="absolute left-0 top-0 bottom-0 w-[280px] bg-slate-900 shadow-2xl transform -translate-x-full transition-transform duration-300 ease-out flex flex-col">
            <div class="p-6 flex items-center justify-between border-b border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-amber-600 rounded flex items-center justify-center text-white font-bold">M</div>
                    <span class="font-bold text-white tracking-widest text-sm uppercase">Menu NAVIGASI</span>
                </div>
                <button id="mobile-menu-close" class="p-2 text-white/50 hover:text-white transition-all">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <div class="flex-1 overflow-y-auto p-4 space-y-2">
                @php
                    $mobileLinks = [
                        ['Beranda', url('/'), Request::is('/'), 'nav-m-home'],
                        ['Profil', route('public.profil'), Request::is('profil'), 'nav-m-profil'],
                        ['Desa Wisata', route('public.desa-wisata'), Request::is('*desa-wisata*'), 'nav-m-desa'],
                        ['Komoditi', route('public.komoditi'), Request::is('*komoditi*'), 'nav-m-komoditi'],
                        ['Laporan Desa', route('public.laporan-desa'), Request::is('laporan-desa'), 'nav-m-laporan'],
                        ['Regulasi', route('public.bank-data'), Request::is('*bank-data*'), 'nav-m-regulasi'],
                        ['Kegiatan', route('public.berita'), Request::is('berita'), 'nav-m-berita'],
                        ['Kontak', route('public.kontak'), Request::is('*kontak*'), 'nav-m-kontak'],
                    ];
                @endphp
                
                @foreach($mobileLinks as $ml)
                    <a href="{{ $ml[1] }}" class="block px-4 py-3.5 rounded-xl text-sm font-bold tracking-widest uppercase transition-all {{ $ml[2] ? 'bg-amber-600 text-white shadow-lg shadow-amber-600/30' : 'text-white/60 hover:text-white hover:bg-white/5' }}">
                        {{ $ml[0] }}
                    </a>
                @endforeach
            </div>
            
            <div class="p-6 border-t border-white/10">
                <p class="text-[10px] text-white/30 uppercase tracking-[0.2em] font-black">Kab. Manggarai Timur</p>
                <p class="text-[9px] text-white/20 mt-1">Provinsi Nusa Tenggara Timur</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>
    @if(!Request::is('dashboard*') && !Request::is('login') && !Request::is('register') && !Request::is('forgot-password') && !Request::is('reset-password*'))
        <!-- Footer: Wide & Slim Government Design [MATCHING REFERENCE B] -->
        <footer class="text-white relative overflow-hidden" style="background: #0a1a0e !important; padding-top: 6rem; padding-bottom: 4rem;">
            <!-- Subtle Glow -->
            <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-blue-500/5 rounded-full blur-[120px] pointer-events-none"></div>

            <div class="max-w-none mx-auto px-6 md:px-12 lg:px-10 relative z-10">
                <!-- Main Grid Layout: 2 Columns Wide (2x2 Structure) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 items-start mb-10" style="column-gap: 3rem; row-gap: 2.5rem;">
                    
                    <!-- TOP LEFT: BRANDING -->
                    <div class="flex flex-col space-y-6">
                        <div class="flex items-center gap-8 group cursor-default">
                            @if($profile && $profile->logo_website)
                                <img src="{{ asset('storage/' . $profile->logo_website) }}" alt="Logo" class="h-16 w-auto object-contain drop-shadow-2xl">
                            @else
                                <div class="w-14 h-14 bg-amber-600 rounded-xl flex items-center justify-center text-white font-black text-2xl shadow-xl">M</div>
                            @endif
                            <div class="flex flex-col">
                                <span class="font-bold text-3xl tracking-tight text-white italic">SID</span>
                                <span class="text-[11px] font-black text-amber-500 tracking-[0.3em] uppercase ml-0.5">Manggarai Timur</span>
                            </div>
                        </div>
                        <p class="text-slate-400 text-sm leading-relaxed max-w-lg opacity-80">
                            Sistem Informasi Digital Terpadu Kabupaten Manggarai Timur. Mewujudkan tata kelola desa yang modern, transparan, dan kompetitif di era global.
                        </p>
                    </div>

                    <!-- TOP RIGHT: JELAJAH SITUS -->
                    <div>
                        <h3 class="font-serif text-2xl text-white mb-8 italic font-bold tracking-wide">Jelajah Situs</h3>
                        <ul class="space-y-4">
                            <li><a href="{{ route('public.desa-wisata') }}" class="text-slate-400 hover:text-white transition-all text-sm font-bold flex items-center gap-3 group uppercase tracking-widest">
                                <span class="opacity-40 group-hover:opacity-100 group-hover:translate-x-1 transition-all">→</span> Desa Wisata
                            </a></li>
                            <li><a href="{{ route('public.komoditi') }}" class="text-slate-400 hover:text-white transition-all text-sm font-bold flex items-center gap-3 group uppercase tracking-widest">
                                <span class="opacity-40 group-hover:opacity-100 group-hover:translate-x-1 transition-all">→</span> Komoditi Unggulan
                            </a></li>
                            <li><a href="{{ route('public.laporan-desa') }}" class="text-slate-400 hover:text-white transition-all text-sm font-bold flex items-center gap-3 group uppercase tracking-widest">
                                <span class="opacity-40 group-hover:opacity-100 group-hover:translate-x-1 transition-all">→</span> Laporan Desa
                            </a></li>
                            <li><a href="{{ route('public.berita') }}" class="text-slate-400 hover:text-white transition-all text-sm font-bold flex items-center gap-3 group uppercase tracking-widest">
                                <span class="opacity-40 group-hover:opacity-100 group-hover:translate-x-1 transition-all">→</span> Berita Terbaru
                            </a></li>
                        </ul>
                    </div>

                    <!-- BOTTOM LEFT: LAYANAN PUBLIK -->
                    <div class="lg:mt-0">
                        <h3 class="font-serif text-2xl text-white mb-8 italic font-bold tracking-wide">Layanan Publik</h3>
                        <ul class="space-y-4">
                            <li><a href="{{ route('public.bank-data') }}" class="text-slate-400 hover:text-white transition-all text-sm font-bold flex items-center gap-3 group uppercase tracking-widest">
                                <span class="opacity-40 group-hover:opacity-100 group-hover:translate-x-1 transition-all">→</span> Data & Regulasi
                            </a></li>
                            <li><a href="{{ url('/login') }}" class="text-slate-400 hover:text-white transition-all text-sm font-bold flex items-center gap-3 group uppercase tracking-widest">
                                <span class="opacity-40 group-hover:opacity-100 group-hover:translate-x-1 transition-all">→</span> Portal Admin
                            </a></li>
                            <li><a href="{{ route('public.kontak') }}" class="text-slate-400 hover:text-white transition-all text-sm font-bold flex items-center gap-3 group uppercase tracking-widest">
                                <span class="opacity-40 group-hover:opacity-100 group-hover:translate-x-1 transition-all">→</span> Hubungi Bantuan
                            </a></li>
                        </ul>
                    </div>

                    <!-- BOTTOM RIGHT: KONTAK & SOCIAL -->
                    <div class="flex flex-col space-y-8 lg:mt-0">
                        <h3 class="font-serif text-2xl text-white mb-4 italic font-bold tracking-wide">Kontak Kami</h3>
                        <div class="space-y-5">
                            <div class="flex items-start gap-4 text-sm text-slate-400 font-bold leading-relaxed group">
                                <div class="w-10 h-10 flex-shrink-0 bg-white/5 rounded-lg flex items-center justify-center text-amber-500 border border-white/10 group-hover:bg-amber-500 group-hover:text-white transition-all">📍</div>
                                <span>Jl. Trans Flores, Borong, Kab. Manggarai Timur, NTT.</span>
                            </div>
                            <div class="flex items-center gap-4 text-sm text-slate-400 font-bold group">
                                <div class="w-10 h-10 flex-shrink-0 bg-white/5 rounded-lg flex items-center justify-center text-emerald-500 border border-white/10 group-hover:bg-emerald-500 group-hover:text-white transition-all">📞</div>
                                <span>(0385) 123456</span>
                            </div>
                        </div>

                        <!-- Social Bar: Horizontal under Contact -->
                        <div class="flex items-center gap-4 pt-4">
                            <a href="#" class="w-12 h-12 bg-white/5 hover:bg-white/10 rounded-xl flex items-center justify-center text-white transition-all transform hover:-translate-y-1 border border-white/10">
                                <svg class="w-6 h-6 opacity-80" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0 3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" /></svg>
                            </a>
                            <a href="#" class="w-12 h-12 bg-white/5 hover:bg-white/10 rounded-xl flex items-center justify-center text-white transition-all transform hover:-translate-y-1 border border-white/10">
                                <svg class="w-7 h-7 opacity-80" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" /></svg>
                            </a>
                            <!-- YouTube -->
                            <a href="#" class="w-12 h-12 bg-white/5 hover:bg-white/10 rounded-xl flex items-center justify-center text-white transition-all transform hover:-translate-y-1 border border-white/10">
                                <svg class="w-7 h-7 opacity-80" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- SLIM BOTTOM BAR -->
                <div class="border-t border-white/5 flex flex-col md:flex-row justify-between items-center text-[11px] text-slate-500 font-bold space-y-4 md:space-y-0" style="padding-top: 1.5rem; gap: 2rem;">
                    <div class="flex flex-col">
                        <p>&copy; 2026 PEMERINTAH KABUPATEN MANGGARAI TIMUR.</p>
                        <p class="text-[9px] opacity-40">HAK CIPTA DILINDUNGI.</p>
                    </div>
                    <div class="flex items-center uppercase tracking-widest text-[10px]" style="gap: 2rem;">
                        <a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a>
                        <a href="#" class="hover:text-white transition-colors">Syarat dan Ketentuan</a>
                        <a href="#" class="hover:text-white transition-colors">Pusat Keamanan</a>
                    </div>
                </div>
            </div>
        </footer>
    @endif

    <script>
        // Navbar Scroll Effect
        window.addEventListener('scroll', function () {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 30) {
                navbar.classList.add('nav-scrolled');
            } else {
                navbar.classList.remove('nav-scrolled');
            }
        });

        // Mobile Menu Logic
        const mobileMenuOpenBtn = document.getElementById('mobile-menu-open');
        const mobileMenuCloseBtn = document.getElementById('mobile-menu-close');
        const mobileMenuContainer = document.getElementById('mobile-menu-container');
        const mobileMenuBackdrop = document.getElementById('mobile-menu-backdrop');
        const mobileMenuSidebar = document.getElementById('mobile-menu-sidebar');

        function openMobileMenu() {
            mobileMenuContainer.classList.remove('invisible');
            setTimeout(() => {
                mobileMenuBackdrop.classList.add('opacity-100');
                mobileMenuBackdrop.classList.remove('pointer-events-none');
                mobileMenuSidebar.classList.remove('-translate-x-full');
                document.body.style.overflow = 'hidden';
            }, 10);
        }

        function closeMobileMenu() {
            mobileMenuBackdrop.classList.remove('opacity-100');
            mobileMenuBackdrop.classList.add('pointer-events-none');
            mobileMenuSidebar.classList.add('-translate-x-full');
            document.body.style.overflow = '';
            setTimeout(() => {
                mobileMenuContainer.classList.add('invisible');
            }, 300);
        }

        if(mobileMenuOpenBtn) mobileMenuOpenBtn.addEventListener('click', openMobileMenu);
        if(mobileMenuCloseBtn) mobileMenuCloseBtn.addEventListener('click', closeMobileMenu);
        if(mobileMenuBackdrop) mobileMenuBackdrop.addEventListener('click', closeMobileMenu);

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
    <script>
        function showFileName(input, targetId) {
            const display = document.getElementById(targetId);
            if (input.files && input.files[0]) {
                display.innerText = 'File Terpilih: ' + input.files[0].name;
                display.classList.remove('text-slate-500', 'text-slate-400');
                display.classList.add('text-emerald-600', 'font-black');

                // For reports which use blue theme
                if (window.location.href.includes('laporan')) {
                    display.classList.remove('text-emerald-600');
                    display.classList.add('text-blue-600');
                }
            }
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fslightbox/3.0.9/index.js"></script>
</body>

</html>