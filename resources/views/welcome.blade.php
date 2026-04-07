@php
    $dpmdProfile = \App\Models\DpmdProfile::first();

    // Dynamic Stats
    // Dynamic Stats (Prioritaskan hitungan sistem jika input manual kosong/0)
    $totalDesa = \App\Models\Desa::count();
    $totalKecamatan = (\App\Models\Kecamatan::count() > 0) ? \App\Models\Kecamatan::count() : 12;
    $desaWisataCount = \App\Models\Desa::where('is_desa_wisata', true)->count();
    $spotWisataCount = $dpmdProfile->stat_spot_wisata ?? 0;
    $wisatawanCount = $dpmdProfile->stat_wisatawan ?? '0';

    // Kepatuhan (Reports this month)
    $desaSudahLaporCount = \App\Models\Laporan::whereYear('tanggal_laporan', now()->year)
        ->whereMonth('tanggal_laporan', now()->month)
        ->distinct('desa_id')
        ->count();
    $kepatuhanPercent = $totalDesa > 0 ? round(($desaSudahLaporCount / $totalDesa) * 100) : 0;

    // Featured Villages
    $featuredDesas = \App\Models\Desa::withCount('potensis')->where('is_desa_wisata', true)->latest()->take(6)->get();

    // Announcements
    $announcements = \App\Models\Pengumuman::where('is_active', true)
        ->where('show_on_public', true)
        ->latest()
        ->take(9)
        ->get();

    // Latest News (Berita)
    $latestNews = \App\Models\Berita::with('user')->where('is_published', true)->latest()->take(9)->get();

    // Latest Potentials (Destinasi)
    $latestPotensi = \App\Models\Potensi::with('desa')->latest()->take(9)->get();

    // Report Status Summary (Current Month)
    $laporanSelesai = \App\Models\Laporan::whereYear('tanggal_laporan', now()->year)
        ->whereMonth('tanggal_laporan', now()->month)
        ->where('status', 'diterima')->count();
    $laporanProses = \App\Models\Laporan::whereYear('tanggal_laporan', now()->year)
        ->whereMonth('tanggal_laporan', now()->month)
        ->where('status', 'pending')->count();
    $belumMelapor = max(0, $totalDesa - $desaSudahLaporCount);
@endphp

<x-layouts.public>
    <style>
        html {
            scroll-behavior: smooth;
        }

        /* Glassmorphism Blobs */
        .blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(5, 150, 105, 0.1) 100%);
            filter: blur(100px);
            border-radius: 50%;
            z-index: 0;
            animation: moveBlob 20s infinite alternate;
        }

        .blob-1 {
            top: -150px;
            right: -100px;
            animation-delay: 0s;
        }

        .blob-2 {
            bottom: -150px;
            left: -100px;
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.12) 0%, rgba(16, 185, 129, 0.1) 100%);
            animation-delay: -5s;
        }

        @keyframes moveBlob {
            0% {
                transform: translate(0, 0) scale(1);
            }

            100% {
                transform: translate(50px, 100px) scale(1.1);
            }
        }

        @keyframes floatDot {

            0%,
            100% {
                transform: translateY(0px) scale(1);
                opacity: .4;
            }

            50% {
                transform: translateY(-25px) scale(1.3);
                opacity: 0.8;
            }
        }

        .hero {
            min-height: 100vh;
            background: linear-gradient(145deg, #0d2818 0%, #1a3d28 40%, #0f3020 70%, #0a2010 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            transition: background 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .dark .hero {
            background: linear-gradient(145deg, #0a1f12 0%, #152e1e 40%, #0c2519 70%, #081a0e 100%);
        }

        .hero-grid {
            position: relative;
            z-index: 10;
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            gap: 80px;
            align-items: center;
            max-width: 1280px;
            margin: 0 auto;
            padding: 120px 40px 80px;
            width: 100%;
        }

        @media (max-width: 1024px) {
            .hero-grid {
                grid-template-columns: 1fr;
                gap: 40px;
                padding-top: 140px;
                text-align: center;
            }

            .hero-grid>div:first-child {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
        }

        .hero-title {
            font-size: clamp(40px, 5vw, 64px);
            font-weight: 900;
            color: #ffffff;
            line-height: 1.05;
            margin-bottom: 24px;
            letter-spacing: -0.02em;
        }

        .dark .hero-title {
            color: #ffffff;
        }

        .hero-title span {
            background: linear-gradient(to right, #f59e0b, #fbbf24);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-title em {
            font-style: italic;
            color: rgba(255, 255, 255, 0.9);
            font-family: 'Playfair Display', serif;
            font-weight: 700;
        }

        .dark .hero-title em {
            color: rgba(255, 255, 255, 0.9);
        }

        /* Premium Glassmorphism Card */
        .vis-card {
            background: rgba(20, 55, 35, 0.85);
            backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 2rem;
            padding: 32px;
            box-shadow: 0 30px 60px -10px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.08);
            position: relative;
            z-index: 2;
            transition: all 0.5s ease;
        }

        .dark .vis-card {
            background: rgba(10, 30, 18, 0.9);
            border-color: rgba(255, 255, 255, 0.08);
            box-shadow: 0 40px 100px -20px rgba(0, 0, 0, 0.6);
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.9);
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .dark .hero-badge {
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(255, 255, 255, 0.15);
            color: rgba(255, 255, 255, 0.85);
        }

        .vc-stat {
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1.25rem;
            padding: 20px 10px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .dark .vc-stat {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.07);
        }

        .vc-stat:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.12);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .dark .vc-stat:hover {
            background: rgba(255, 255, 255, 0.09);
        }

        .vc-desa-row {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            padding: 12px 16px;
            transition: all 0.2s ease;
        }

        .dark .vc-desa-row {
            background: rgba(255, 255, 255, 0.04);
            border-color: rgba(255, 255, 255, 0.07);
        }

        .vc-desa-row:hover {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(245, 158, 11, 0.5);
            transform: scale(1.02);
        }

        .dark .vc-desa-row:hover {
            background: rgba(255, 255, 255, 0.09);
        }

        /* Stats Section Enhancements */
        .stat-item {
            position: relative;
            padding-right: 20px;
        }

        .stat-item:not(:last-child):after {
            content: '';
            position: absolute;
            right: 0;
            top: 20%;
            height: 60%;
            width: 1px;
            background: linear-gradient(to bottom, transparent, rgba(255, 255, 255, 0.15), transparent);
        }

        .dark .stat-item:not(:last-child):after {
            background: linear-gradient(to bottom, transparent, rgba(255, 255, 255, 0.12), transparent);
        }

        /* Buttons Premium */
        .btn-primary {
            background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%);
            box-shadow: 0 10px 30px -5px rgba(217, 119, 6, 0.4);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .btn-primary:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 15px 40px -5px rgba(217, 119, 6, 0.5);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.35);
            color: #ffffff;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.18);
            border-color: rgba(255, 255, 255, 0.6);
            color: #ffffff;
        }

        .dark .btn-secondary {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.25);
            color: #ffffff;
        }

        /* Reveal Animation */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .fitur-card {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 2rem;
            padding: 35px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.02);
            position: relative;
            overflow: hidden;
        }

        .dark .fitur-card {
            background: rgba(15, 23, 42, 0.4);
            border-color: rgba(255, 255, 255, 0.05);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .fitur-card:hover {
            transform: translateY(-10px);
            background: white;
            border-color: #fbbf24;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
        }

        .dark .fitur-card:hover {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(251, 191, 36, 0.3);
        }

        .wisata-card {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 2rem;
            overflow: hidden;
            transition: all 0.4s ease;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.02);
        }

        .dark .wisata-card {
            background: rgba(15, 23, 42, 0.4);
            border-color: rgba(255, 255, 255, 0.05);
        }

        .wisata-card:hover {
            transform: translateY(-12px);
            background: white;
            border-color: #fbbf24;
            box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.15);
        }

        .dark .wisata-card:hover {
            background: rgba(30, 41, 59, 0.6);
        }

        .wisata-hero {
            height: 200px;
            position: relative;
            overflow: hidden;
        }

        .peng-card {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 1.5rem;
            padding: 25px;
            transition: all 0.3s ease;
            cursor: pointer;
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        .dark .peng-card {
            background: rgba(15, 23, 42, 0.4);
            border-color: rgba(255, 255, 255, 0.05);
        }

        .peng-card:hover {
            border-color: #fbbf24;
            background: white;
            transform: scale(1.02) translateX(5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.05);
        }

        .dark .peng-card:hover {
            background: rgba(30, 41, 59, 0.6);
        }

        @media (max-width: 768px) {
            .sub-nav {
                display: none;
            }
        }

        /* New Announcement Styles */
        .ann-card {
            background: white;
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #f1f5f9;
            height: 100%;
            display: flex;
            flex-direction: column;
            padding: 24px;
        }

        .ann-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .dark .ann-card {
            background: #1e293b;
            border-color: rgba(255,255,255,0.05);
        }

        .ann-image-wrapper {
            position: relative;
            height: 220px;
            overflow: hidden;
            background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
        }

        .ann-image-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            text-align: center;
        }

        .ann-image-placeholder svg {
            width: 48px;
            height: 48px;
            color: rgba(255, 255, 255, 0.4);
            margin-bottom: 16px;
        }

        .ann-image-text {
            color: white;
            font-weight: 800;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            line-height: 1.4;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .ann-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: #0f172a;
            color: white;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            z-index: 20;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        }

        .ann-content {
            padding: 24px 0 0;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .ann-title {
            font-size: 1.125rem;
            font-weight: 800;
            color: #0f172a; /* Warna Hitam/Slate-900 */
            line-height: 1.5;
            margin-bottom: 24px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            transition: color 0.3s ease;
        }

        .dark .ann-title {
            color: #f1f5f9;
        }

        .ann-footer {
            margin-top: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 20px;
            border-top: 1px solid #f1f5f9;
            margin-top: 24px;
        }

        .dark .ann-footer {
            border-color: rgba(255, 255, 255, 0.05);
        }

        .ann-readmore {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #eff6ff;
            color: #2563eb;
            padding: 10px 18px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            transition: all 0.3s ease;
        }

        .ann-readmore:hover {
            background: #2563eb;
            color: white;
            transform: scale(1.05);
        }

        .ann-date {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            font-size: 12px;
            font-weight: 600;
        }

        /* NEWS SECTION (BERITA) */
        .news-card {
            background: white;
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #f1f5f9;
            height: 100%;
            display: flex;
            flex-direction: column;
            padding: 24px;
        }

        .news-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .dark .news-card {
            background: #1e293b;
            border-color: rgba(255,255,255,0.05);
        }

        .news-image-wrapper {
            position: relative;
            height: 220px;
            overflow: hidden;
            border-radius: 20px;
        }

        .news-image {
            width: 100%;
            height: 100%;
            object-cover: cover;
            transition: transform 0.7s ease;
        }

        .news-card:hover .news-image {
            transform: scale(1.1);
        }

        .news-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: #0f172a;
            color: white;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            z-index: 20;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        }

        .news-content {
            padding: 24px 0 0;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .news-title {
            font-size: 1.125rem;
            font-weight: 800;
            color: #0f172a; /* Warna Hitam/Slate-900 */
            line-height: 1.5;
            margin-bottom: 24px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            transition: color 0.3s ease;
        }

        .dark .news-title {
            color: #f1f5f9;
        }

        .news-footer {
            margin-top: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 20px;
            border-top: 1px solid #f1f5f9;
            margin-top: 24px;
        }

        .dark .news-footer {
            border-color: rgba(255, 255, 255, 0.05);
        }

        .news-readmore {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #eff6ff;
            color: #2563eb;
            padding: 10px 18px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            transition: all 0.3s ease;
        }

        .news-readmore:hover {
            background: #2563eb;
            color: white;
            transform: scale(1.05);
        }

        .news-date {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            font-size: 12px;
            font-weight: 600;
        }
    </style>

    <!-- HERO -->
    <section class="hero">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>

        <div class="hero-grid">
            <!-- LEFT -->
            <div class="reveal flex flex-col items-center lg:items-start text-center lg:text-left">
                <div class="hero-badge mx-auto lg:mx-0">🌿 DMPD Kab. Manggarai Timur — NTT</div>
                <h1 class="hero-title">
                    Sistem Informasi<br>
                    <span class="text-2xl sm:text-3xl lg:text-4xl block mt-2">pelaporan dari desa dan</span>
                    <em class="text-xl sm:text-2xl lg:text-3xl block mt-1">promosi potensi desa/desa wisata</em>
                </h1>
                <p class="text-white/70 text-lg mb-10 leading-relaxed max-w-xl mx-auto lg:mx-0">
                    Platform digital terpadu milik Dinas Pemberdayaan Masyarakat dan Desa
                    Kabupaten Manggarai Timur untuk monitoring pelaporan seluruh desa
                    dan promosi potensi wisata Flores NTT kepada dunia.
                </p>
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-5 mb-14">
                    <a href="{{ route('login') }}"
                        class="btn-primary px-10 py-5 font-extrabold text-white rounded-2xl flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        MASUK KE SISTEM
                    </a>
                    <a href="#wisata"
                        class="btn-secondary px-10 py-5 font-extrabold rounded-2xl flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        JELAJAHI WISATA
                    </a>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-2 md:grid-cols-5 gap-8 pt-10 border-t border-white/10">
                    <div class="stat-item">
                        <div class="text-3xl font-black text-amber-400 counter" data-target="{{ $totalDesa }}">0</div>
                        <div class="text-[10px] text-white/80 uppercase tracking-widest font-bold mt-2">
                            Total Desa</div>
                    </div>
                    <div class="stat-item">
                        <div class="text-3xl font-black text-amber-400 counter" data-target="{{ $totalKecamatan }}">0
                        </div>
                        <div class="text-[10px] text-white/80 uppercase tracking-widest font-bold mt-2">
                            Kecamatan</div>
                    </div>
                    <div class="stat-item">
                        <div class="text-3xl font-black text-amber-400 counter" data-target="{{ $desaWisataCount }}">0
                        </div>
                        <div class="text-[10px] text-white/80 uppercase tracking-widest font-bold mt-2">
                            Desa Wisata</div>
                    </div>
                    <div class="stat-item">
                        <div class="text-3xl font-black text-amber-400 counter" data-target="{{ $spotWisataCount }}">0
                        </div>
                        <div class="text-[10px] text-white/80 uppercase tracking-widest font-bold mt-2">
                            Spot Wisata</div>
                    </div>
                    <div class="stat-item">
                        <div class="text-3xl font-black text-amber-400">
                            @if(is_numeric(str_replace(['.', ','], '', $wisatawanCount)))
                                <span class="counter" data-target="{{ str_replace(['.', ','], '', $wisatawanCount) }}">0</span>
                            @else
                                {{ $wisatawanCount }}
                            @endif
                        </div>
                        <div class="text-[10px] text-white/80 uppercase tracking-widest font-bold mt-2">
                            Wisatawan</div>
                    </div>
                </div>
            </div>

            <!-- RIGHT — VISUAL CARD -->
            <div class="relative reveal" style="transition-delay: 0.2s">
                <div
                    class="absolute -inset-10 bg-gradient-to-br from-emerald-500/20 to-blue-500/20 rounded-full blur-[100px] opacity-50">
                </div>

                <div class="vis-card">
                    <div class="flex items-center gap-5 mb-10 pb-6 border-b border-white/10">
                        <div
                            class="w-14 h-14 bg-gradient-to-br from-[#d97706] to-[#f59e0b] rounded-2xl flex items-center justify-center text-3xl shadow-xl shadow-amber-500/30 rotate-3">
                            📊
                        </div>
                        <div>
                            <div class="text-white font-black text-lg tracking-tight">Dashboard Pelaporan Desa</div>
                            <div class="text-amber-400 text-xs font-bold uppercase tracking-widest mt-1">
                                Kab. Manggarai Timur — {{ now()->isoFormat('MMM Y') }}
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mb-10">
                        <div class="vc-stat">
                            <div class="text-2xl font-black text-amber-400 counter" data-target="{{ $laporanSelesai }}">
                                0</div>
                            <div class="text-[10px] text-white font-bold uppercase mt-2">Laporan<br>Selesai ✅</div>
                        </div>
                        <div class="vc-stat">
                            <div class="text-2xl font-black text-amber-400 counter" data-target="{{ $laporanProses }}">0
                            </div>
                            <div class="text-[10px] text-white font-bold uppercase mt-2">Sedang<br>Diproses 🔄</div>
                        </div>
                        <div class="vc-stat">
                            <div class="text-2xl font-black text-rose-500 counter" data-target="{{ $belumMelapor }}">0
                            </div>
                            <div class="text-[10px] text-white font-bold uppercase mt-2">Belum<br>Melapor ❗</div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        @php
                            $recentReports = \App\Models\Laporan::with('desa')->latest()->take(3)->get();
                        @endphp
                        @foreach($recentReports as $rp)
                            <div class="vc-desa-row">
                                <div
                                    class="w-2.5 h-2.5 rounded-full {{ $rp->status === 'diterima' ? 'bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.5)]' : 'bg-amber-500 shadow-[0_0_10px_rgba(245,158,11,0.5)]' }} animate-pulse">
                                </div>
                                <div class="flex-1">
                                    <div class="text-white text-xs font-extrabold tracking-tight">
                                        {{ $rp->desa->nama_desa ?? '-' }}
                                    </div>
                                    <div class="text-[10px] text-white font-medium tracking-wide">
                                        Kec. {{ $rp->desa->kecamatan ?? '-' }}
                                    </div>
                                </div>
                                <div
                                    class="px-3 py-1 rounded-full text-[9px] font-black uppercase {{ $rp->status === 'diterima' ? 'bg-emerald-500/20 text-emerald-300' : 'bg-amber-500/20 text-amber-300' }}">
                                    {{ $rp->status === 'diterima' ? '✅ Terkirim' : '🔄 Proses' }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Floating Badge -->
                <div
                    class="absolute -bottom-6 -left-6 bg-[#1a3d28]/90 backdrop-blur-sm p-4 rounded-2xl shadow-2xl border border-white/10 flex items-center gap-3 animate-bounce-subtle">
                    <div
                        class="w-10 h-10 rounded-full bg-emerald-500/20 flex items-center justify-center text-emerald-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-[10px] font-black text-white/40 uppercase leading-none">Keamanan Data</div>
                        <div class="text-xs font-black text-white mt-1">Sistem Terverifikasi</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: FITUR -->
    <section class="py-12 bg-white dark:bg-slate-900" id="fitur">
        <div class="max-w-[1240px] mx-auto px-6">
            <div class="mb-12 reveal">
                <span
                    class="px-4 py-1.5 bg-blue-50 text-[#1e293b] text-[11px] font-black uppercase tracking-widest rounded-full border border-blue-100">⚙️
                    Fitur Sistem</span>
                <h2 class="text-4xl font-black mt-6 font-serif text-slate-900 dark:text-white">Semua yang Dibutuhkan
                    Dalam Satu Platform
                </h2>
                <p class="text-slate-600 dark:text-slate-400 mt-4 max-w-xl">Dirancang khusus untuk kebutuhan pelaporan
                    dan promosi desa di
                    Kabupaten Manggarai Timur, Flores NTT.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @php
                    $features = [
                        ['icon' => '📝', 'title' => 'Input Laporan Desa', 'desc' => 'Admin desa bisa input laporan pembangunan, keuangan, dan infrastruktur secara digital.', 'color' => 'bg-emerald-50'],
                        ['icon' => '✅', 'title' => 'Verifikasi DMPD', 'desc' => 'Admin DMPD dapat meninjau dan memverifikasi laporan dari desa secara real-time.', 'color' => 'bg-amber-50'],
                        ['icon' => '📊', 'title' => 'Dashboard Analitik', 'desc' => 'Pantau tingkat kepatuhan pelaporan per kecamatan dengan visualisasi yang informatif.', 'color' => 'bg-blue-50'],
                        ['icon' => '🏞️', 'title' => 'Promosi Wisata', 'desc' => 'Daftarkan potensi wisata desa untuk dipromosikan kepada publik dan wisatawan.', 'color' => 'bg-emerald-50'],
                        ['icon' => '🗺️', 'title' => 'Peta Sebaran', 'desc' => 'Tampilkan lokasi dan status semua desa dalam peta interaktif Kabupaten Manggarai Timur.', 'color' => 'bg-indigo-50'],
                        ['icon' => '📢', 'title' => 'Berita Utama', 'desc' => 'DMPD bisa kirim berita utama dan pengumuman langsung kepada seluruh admin desa.', 'color' => 'bg-orange-50'],
                    ];
                @endphp
                @foreach($features as $f)
                    <div class="fitur-card reveal">
                        <div
                            class="w-14 h-14 {{ $f['color'] }} rounded-2xl flex items-center justify-center text-2xl mb-6 shadow-sm">
                            {{ $f['icon'] }}
                        </div>
                        <h3 class="text-lg font-bold mb-3 text-slate-900 dark:text-white">{{ $f['title'] }}</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">{{ $f['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-12 dark:bg-slate-900/50" style="background: linear-gradient(to bottom right, #fdfbf7, #f3f4f1);"
        id="cara">
        <div class="max-w-[1240px] mx-auto px-6">
            <div class="text-center mb-12 reveal">
                <span
                    class="px-4 py-1.5 bg-emerald-100 text-emerald-800 text-[11px] font-black uppercase tracking-widest rounded-full border border-emerald-200">⚡
                    Cara Kerja</span>
                <h2 class="text-4xl font-black mt-6 font-serif text-[#064e3b] dark:text-emerald-400">Mudah, Cepat, &
                    <span style="color: #d97706;">Transparan</span>
                </h2>
                <p class="text-slate-600 dark:text-slate-400 mt-4 max-w-2xl mx-auto">Proses pelaporan desa yang
                    sederhana, dapat diakses
                    dari
                    mana saja, dan terpantau langsung oleh DMPD.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @php
                    $steps = [
                        ['num' => '1', 'icon' => '🔐', 'title' => 'Admin Desa Login', 'desc' => 'Login menggunakan username & kode desa yang diberikan DMPD.'],
                        ['num' => '2', 'icon' => '📝', 'title' => 'Input Laporan', 'desc' => 'Isi formulir laporan pembangunan, keuangan, dan wisata desa.'],
                        ['num' => '3', 'icon' => '✅', 'title' => 'Verifikasi DMPD', 'desc' => 'Admin DMPD mereview dan memverifikasi laporan secara real-time.'],
                        ['num' => '4', 'icon' => '📊', 'title' => 'Data Tersedia', 'desc' => 'Data tersimpan aman dan siap dianalisis untuk pembangunan.'],
                    ];
                @endphp
                @foreach($steps as $s)
                    <div
                        class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-2xl p-8 text-center shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all group reveal">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-[#d97706] to-[#f59e0b] rounded-full flex items-center justify-center text-xl font-black text-white mx-auto mb-6 shadow-lg shadow-amber-500/20 group-hover:scale-110 transition-transform font-serif">
                            {{ $s['num'] }}
                        </div>
                        <div class="text-3xl mb-4">{{ $s['icon'] }}</div>
                        <h4 class="text-slate-900 dark:text-white font-bold mb-2">{{ $s['title'] }}</h4>
                        <p class="text-slate-500 dark:text-slate-400 text-xs leading-relaxed">{{ $s['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>



    <!-- SECTION: PENGUMUMAN TERKINI -->
    <section class="py-24 bg-white dark:bg-slate-900/50" id="pengumuman">
        <div class="max-w-[1240px] mx-auto px-6">
            <div class="flex flex-col items-center text-center mb-20 reveal">
                <h2 class="text-3xl md:text-5xl font-black font-serif text-slate-900 dark:text-white">Pengumuman Terkini</h2>
                <div class="w-24 h-1.5 bg-blue-600 mt-6 rounded-full opacity-20"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @forelse($announcements as $an)
                    <div class="reveal">
                        <div class="ann-card">
                            <div class="ann-image-wrapper">
                                <div class="ann-badge">Pengumuman</div>
                                <div class="ann-image-placeholder">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                    </svg>
                                    <div class="ann-image-text">
                                        Informasi Resmi & Pengumuman DMPD
                                    </div>
                                </div>
                            </div>
                            <div class="ann-content">
                                <h3 class="ann-title">{{ $an->judul }}</h3>
                                <div class="ann-footer">
                                    <a href="{{ route('public.pengumuman.detail', $an->id) }}" class="ann-readmore">
                                        READ MORE 
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                    <div class="ann-date">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $an->created_at->isoFormat('MMM DD, Y') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-10 text-center opacity-50 italic text-slate-500">Belum ada pengumuman terbaru dari DMPD.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- SECTION: BERITA TERKINI -->
    <section class="py-24 bg-[#f8fafc] dark:bg-slate-900" id="berita">
        <div class="max-w-[1240px] mx-auto px-6">
            <div class="text-center mb-20 reveal">
                <h2 class="text-3xl md:text-5xl font-black font-serif text-slate-900 dark:text-white">Berita Terkini</h2>
                <div class="w-24 h-1.5 bg-slate-900 mx-auto mt-6 rounded-full opacity-20"></div>
                <div class="mt-8">
                    <a href="{{ route('public.berita') }}"
                        class="text-sm font-black text-slate-500 uppercase tracking-widest hover:text-slate-900 transition-colors">Lihat Semua Berita & Kegiatan →</a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @forelse($latestNews as $news)
                    <div class="reveal">
                        <div class="news-card">
                            <div class="news-image-wrapper">
                                <div class="news-badge">Berita</div>
                                @if($news->foto)
                                    <img src="{{ asset('storage/' . $news->foto) }}" class="news-image" alt="{{ $news->judul }}">
                                @else
                                    <div class="w-full h-full bg-slate-100 flex items-center justify-center text-4xl">📰</div>
                                @endif
                            </div>
                            <div class="news-content">
                                <h3 class="news-title">{{ $news->judul }}</h3>
                                <div class="news-footer">
                                    <a href="{{ route('public.berita.detail', $news->slug) }}" class="news-readmore">
                                        READ MORE 
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                    <div class="news-date">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $news->created_at->isoFormat('MMM DD, Y') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-10 text-center opacity-50 italic">Belum ada berita terbaru.</div>
                @endforelse
            </div>
        </div>
    </section>




    <!-- SECTION: POTENSI WISATA -->
    <section class="py-24 bg-white dark:bg-slate-900/80" id="potensi">
        <div class="max-w-[1240px] mx-auto px-6">
            <div class="flex flex-col items-center text-center mb-12 reveal">
                <div class="max-w-2xl">
                    <span
                        class="px-4 py-1.5 bg-amber-50 text-[#1e293b] text-[11px] font-black uppercase tracking-widest rounded-full border border-amber-100">🌟
                        Eksplorasi</span>
                    <h2 class="text-4xl font-black mt-6 font-serif text-slate-900 dark:text-white">Pesona & Potensi <span
                            style="color: #10b981;">Unggulan</span></h2>
                    <p class="text-slate-600 dark:text-slate-400 mt-4 mx-auto">Pilihan terbaik berbagai keunikan budaya, kerajinan lokal, hingga surga keindahan alam yang menakjubkan di desa-desa Manggarai Timur.</p>
                </div>
                <div class="mt-8">
                    <a href="{{ route('public.potensi-wisata') }}"
                        class="inline-flex items-center gap-2 text-sm font-black text-amber-600 uppercase tracking-widest hover:underline">Lihat Semua Potensi →</a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @forelse($latestPotensi as $item)
                    <a href="{{ route('public.potensi-wisata.detail', $item->id) }}" class="group block reveal bg-white dark:bg-slate-800 rounded-[2.5rem] overflow-hidden shadow-lg border border-slate-100 dark:border-slate-700 hover:shadow-2xl transition-all flex flex-col h-full p-6">
                        <div class="relative h-[220px] overflow-hidden rounded-2xl">
                            @if($item->foto_utama)
                                <img src="{{ asset('storage/' . $item->foto_utama) }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                    alt="{{ $item->nama_potensi }}">
                            @else
                                <div class="w-full h-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-4xl">🏝️</div>
                            @endif
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-amber-500 text-white text-[9px] font-black uppercase tracking-widest rounded-full shadow-lg">{{ $item->kategori }}</span>
                            </div>
                        </div>
                        <div class="pt-6 flex flex-col flex-1">
                            <h3 class="text-lg font-black font-serif text-slate-900 dark:text-white mb-2 group-hover:text-amber-600 transition-colors">{{ $item->nama_potensi }}</h3>
                            <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400 text-xs mb-3">
                                📍 <span class="font-bold">Desa {{ $item->desa->nama_desa ?? 'Manggarai Timur' }}</span>
                            </div>
                            <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed line-clamp-3">
                                {{ strip_tags($item->deskripsi) }}
                            </p>
                            <div class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-700 flex justify-between items-center text-xs font-bold text-amber-600 uppercase tracking-widest mt-auto">
                                <span>Selengkapnya</span>
                                <span>&rarr;</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-10 text-center opacity-50 italic">Belum ada potensi desa yang ditambahkan.</div>
                @endforelse



    <script>
        // Scroll reveal animation
        const reveals = document.querySelectorAll('.reveal');
        const observerOptions = {
            threshold: 0.15,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');

                    // Trigger counters inside this reveal section
                    const counters = entry.target.querySelectorAll('.counter');
                    counters.forEach(counter => {
                        if (!counter.classList.contains('animated')) {
                            animateCounter(counter);
                        }
                    });
                }
            });
        }, observerOptions);

        reveals.forEach(el => observer.observe(el));

        // Counter Animation Function
        function animateCounter(el) {
            el.classList.add('animated');
            const target = +el.getAttribute('data-target');
            const duration = 2000; // 2 seconds
            const stepTime = 20;
            const steps = duration / stepTime;
            const increment = target / steps;
            let current = 0;

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    el.innerText = target;
                    clearInterval(timer);
                } else {
                    el.innerText = Math.floor(current);
                }
            }, stepTime);
        }

        // Navbar Scroll Effect — dark green hero aware
        const navbar = document.getElementById('navbar');
        const navLinks = navbar ? navbar.querySelectorAll('a[id^="nav-"]') : [];
        const navBrand = navbar ? navbar.querySelectorAll('span') : [];
        const heroHeight = document.querySelector('.hero') ? document.querySelector('.hero').offsetHeight : 600;

        function updateNavbar() {
            if (window.scrollY > heroHeight - 100) {
                // Scrolled past hero: switch to light navbar
                navbar.classList.add('bg-white/95', 'dark:bg-slate-900/95', 'shadow-lg', 'border-b', 'border-slate-200');
                navbar.classList.remove('bg-transparent');
                // Update link colors
                navLinks.forEach(link => {
                    link.classList.remove('text-white/80', 'hover:text-white', 'hover:bg-white/10');
                    link.classList.add('text-slate-600', 'hover:text-emerald-700', 'hover:bg-emerald-50');
                });
                navBrand.forEach(s => {
                    s.classList.remove('text-white', 'text-white/60');
                    s.classList.add('text-slate-800', 'dark:text-white', 'text-slate-400');
                });
            } else {
                // On hero: transparent dark
                navbar.classList.remove('bg-white/95', 'dark:bg-slate-900/95', 'shadow-lg', 'border-b', 'border-slate-200');
                navbar.classList.add('bg-transparent');
                navLinks.forEach(link => {
                    link.classList.add('text-white/80', 'hover:text-white', 'hover:bg-white/10');
                    link.classList.remove('text-slate-600', 'hover:text-emerald-700', 'hover:bg-emerald-50');
                });
                navBrand.forEach(s => {
                    s.classList.add('text-white', 'text-white/60');
                    s.classList.remove('text-slate-800', 'dark:text-white', 'text-slate-400');
                });
            }
        }

        window.addEventListener('scroll', updateNavbar);
        updateNavbar(); // run on load
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fslightbox/3.0.9/index.js"></script>
    </body>
</x-layouts.public>