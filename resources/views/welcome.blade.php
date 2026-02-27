@php
    $dpmdProfile = \App\Models\DpmdProfile::first();

    // Dynamic Stats
    $totalDesa = $dpmdProfile->stat_total_desa ?? \App\Models\Desa::count();
    $totalKecamatan = $dpmdProfile->stat_kecamatan ?? \DB::table('kecamatans')->count();
    $desaWisataCount = $dpmdProfile->stat_desa_wisata ?? \App\Models\Desa::where('is_desa_wisata', true)->count();

    // Kepatuhan (Reports this month)
    $desaSudahLaporCount = \App\Models\Laporan::whereYear('tanggal_laporan', now()->year)
        ->whereMonth('tanggal_laporan', now()->month)
        ->distinct('desa_id')
        ->count();
    $kepatuhanPercent = $totalDesa > 0 ? round(($desaSudahLaporCount / $totalDesa) * 100) : 0;

    // Featured Villages
    $featuredDesas = \App\Models\Desa::with('potensis')->where('is_desa_wisata', true)->latest()->take(6)->get();

    // Announcements
    $announcements = \App\Models\Pengumuman::where('is_active', true)->latest()->take(4)->get();

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
        /* Floating ornament dots & Blobs */
        .dot-field {
            position: absolute;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
            z-index: 1;
        }

        /* Glassmorphism Blobs */
        .blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(59, 130, 246, 0.2) 100%);
            filter: blur(80px);
            border-radius: 50%;
            z-index: 0;
            animation: moveBlob 20s infinite alternate;
        }

        .blob-1 {
            top: -100px;
            right: -100px;
            animation-delay: 0s;
        }

        .blob-2 {
            bottom: -100px;
            left: -100px;
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.15) 0%, rgba(239, 68, 68, 0.15) 100%);
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

        .dot {
            position: absolute;
            border-radius: 50%;
            background: rgba(217, 119, 6, 0.2);
            animation: floatDot 8s ease-in-out infinite;
        }

        .dot:nth-child(1) {
            width: 8px;
            height: 8px;
            top: 20%;
            left: 15%;
            animation-delay: 0s;
        }

        .dot:nth-child(2) {
            width: 5px;
            height: 5px;
            top: 35%;
            left: 55%;
            animation-delay: 1.5s;
        }

        .dot:nth-child(3) {
            width: 10px;
            height: 10px;
            top: 60%;
            left: 30%;
            animation-delay: 3s;
            background: rgba(56, 176, 106, 0.3);
        }

        .dot:nth-child(4) {
            width: 6px;
            height: 6px;
            top: 75%;
            left: 70%;
            animation-delay: 2s;
        }

        .dot:nth-child(5) {
            width: 12px;
            height: 12px;
            top: 15%;
            left: 80%;
            animation-delay: 4s;
            background: rgba(56, 176, 106, 0.25);
        }

        .dot:nth-child(6) {
            width: 4px;
            height: 4px;
            top: 50%;
            left: 90%;
            animation-delay: 0.5s;
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
            background: #ffffff;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            transition: background 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .dark .hero {
            background: #020617;
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
            color: #0f172a;
            line-height: 1.05;
            margin-bottom: 24px;
            letter-spacing: -0.02em;
        }

        .dark .hero-title {
            color: #f8fafc;
        }

        .hero-title span {
            background: linear-gradient(to right, #d97706, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-title em {
            font-style: italic;
            color: #059669;
            font-family: 'Playfair Display', serif;
            font-weight: 700;
        }

        .dark .hero-title em {
            color: #10b981;
        }

        /* Premium Glassmorphism Card */
        .vis-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 2.5rem;
            padding: 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 2;
            transition: all 0.5s ease;
        }

        .dark .vis-card {
            background: rgba(15, 23, 42, 0.6);
            border-color: rgba(255, 255, 255, 0.1);
            box-shadow: 0 40px 100px -20px rgba(0, 0, 0, 0.5);
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #fef3c7;
            border: 1px solid #fbbf24;
            color: #92400e;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(217, 119, 6, 0.1);
        }

        .dark .hero-badge {
            background: rgba(251, 191, 36, 0.1);
            border-color: rgba(251, 191, 36, 0.2);
            color: #fbbf24;
        }

        .vc-stat {
            background: rgba(255, 255, 255, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 1.25rem;
            padding: 20px 10px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .dark .vc-stat {
            background: rgba(255, 255, 255, 0.03);
            border-color: rgba(255, 255, 255, 0.05);
        }

        .vc-stat:hover {
            transform: translateY(-5px);
            background: white;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .dark .vc-stat:hover {
            background: rgba(255, 255, 255, 0.07);
        }

        .vc-desa-row {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 1rem;
            padding: 12px 16px;
            transition: all 0.2s ease;
        }

        .dark .vc-desa-row {
            background: rgba(255, 255, 255, 0.03);
            border-color: rgba(255, 255, 255, 0.05);
        }

        .vc-desa-row:hover {
            background: white;
            border-color: #fbbf24;
            transform: scale(1.02);
        }

        .dark .vc-desa-row:hover {
            background: rgba(255, 255, 255, 0.08);
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
            background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.1), transparent);
        }

        .dark .stat-item:not(:last-child):after {
            background: linear-gradient(to bottom, transparent, rgba(255, 255, 255, 0.1), transparent);
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
            background: rgba(16, 185, 129, 0.05);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #065f46;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: rgba(16, 185, 129, 0.1);
            border-color: #10b981;
            color: #047857;
        }

        .dark .btn-secondary {
            background: rgba(16, 185, 129, 0.1);
            border-color: rgba(16, 185, 129, 0.2);
            color: #34d399;
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
    </style>

    <!-- HERO -->
    <section class="hero">
        <!-- Decoration Background -->
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="dot-field">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>

        <div class="hero-grid">
            <!-- LEFT -->
            <div class="reveal">
                <div class="hero-badge">🌿 DMPD Kab. Manggarai Timur — NTT</div>
                <h1 class="hero-title">
                    Sistem Informasi<br>
                    <span>Pelaporan Desa</span><br>
                    <em>& Promosi Wisata</em>
                </h1>
                <p class="text-slate-600 dark:text-slate-400 text-lg mb-10 leading-relaxed max-w-xl">
                    Platform digital terpadu milik Dinas Pemberdayaan Masyarakat dan Desa
                    Kabupaten Manggarai Timur untuk monitoring pelaporan seluruh desa
                    dan promosi potensi wisata Flores NTT kepada dunia.
                </p>
                <div class="flex flex-wrap gap-5 mb-14">
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
                <div
                    class="grid grid-cols-2 sm:grid-cols-4 gap-8 pt-10 border-t border-slate-200 dark:border-slate-800">
                    <div class="stat-item">
                        <div class="text-3xl font-black text-amber-600 dark:text-amber-400 counter"
                            data-target="{{ $totalDesa }}">0</div>
                        <div
                            class="text-[10px] text-slate-500 dark:text-slate-400 uppercase tracking-widest font-bold mt-2">
                            Total Wilayah</div>
                    </div>
                    <div class="stat-item">
                        <div class="text-3xl font-black text-amber-600 dark:text-amber-400 counter"
                            data-target="{{ $totalKecamatan }}">0</div>
                        <div
                            class="text-[10px] text-slate-500 dark:text-slate-400 uppercase tracking-widest font-bold mt-2">
                            Kecamatan</div>
                    </div>
                    <div class="stat-item">
                        <div class="text-3xl font-black text-amber-600 dark:text-amber-400 counter"
                            data-target="{{ $desaWisataCount }}">0</div>
                        <div
                            class="text-[10px] text-slate-500 dark:text-slate-400 uppercase tracking-widest font-bold mt-2">
                            Desa Wisata</div>
                    </div>
                    <div class="stat-item">
                        <div class="text-3xl font-black text-amber-600 dark:text-amber-400"><span class="counter"
                                data-target="{{ $kepatuhanPercent }}">0</span>%</div>
                        <div
                            class="text-[10px] text-slate-500 dark:text-slate-400 uppercase tracking-widest font-bold mt-2">
                            Kepatuhan</div>
                    </div>
                </div>
            </div>

            <!-- RIGHT — VISUAL CARD -->
            <div class="relative reveal" style="transition-delay: 0.2s">
                <div
                    class="absolute -inset-10 bg-gradient-to-br from-emerald-500/20 to-blue-500/20 rounded-full blur-[100px] opacity-50">
                </div>

                <div class="vis-card">
                    <div class="flex items-center gap-5 mb-10 pb-6 border-b border-black/5 dark:border-white/5">
                        <div
                            class="w-14 h-14 bg-gradient-to-br from-[#d97706] to-[#f59e0b] rounded-2xl flex items-center justify-center text-3xl shadow-xl shadow-amber-500/20 rotate-3">
                            📊
                        </div>
                        <div>
                            <div class="text-slate-900 dark:text-white font-black text-lg tracking-tight">Status
                                Pelaporan Desa</div>
                            <div
                                class="text-amber-600 dark:text-amber-400 text-xs font-bold uppercase tracking-widest mt-1">
                                PERIODE {{ now()->isoFormat('MMMM Y') }}
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mb-10">
                        <div class="vc-stat">
                            <div class="text-2xl font-black text-emerald-600 dark:text-emerald-400 underline decoration-emerald-500/30 underline-offset-4 counter"
                                data-target="{{ $laporanSelesai }}">0</div>
                            <div class="text-[10px] text-slate-500 dark:text-slate-400 font-bold uppercase mt-2">Selesai
                            </div>
                        </div>
                        <div class="vc-stat">
                            <div class="text-2xl font-black text-amber-600 dark:text-amber-500 underline decoration-amber-500/30 underline-offset-4 counter"
                                data-target="{{ $laporanProses }}">0</div>
                            <div class="text-[10px] text-slate-500 dark:text-slate-400 font-bold uppercase mt-2">Proses
                            </div>
                        </div>
                        <div class="vc-stat">
                            <div class="text-2xl font-black text-red-600 dark:text-red-400 underline decoration-red-500/30 underline-offset-4 counter"
                                data-target="{{ $belumMelapor }}">0</div>
                            <div class="text-[10px] text-slate-500 dark:text-slate-400 font-bold uppercase mt-2">Belum
                            </div>
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
                                    <div class="text-slate-800 dark:text-slate-200 text-xs font-extrabold tracking-tight">
                                        {{ $rp->desa->nama_desa ?? '-' }}
                                    </div>
                                    <div class="text-[10px] text-slate-500 dark:text-slate-400 font-medium tracking-wide">
                                        Kec. {{ $rp->desa->kecamatan ?? '-' }}
                                    </div>
                                </div>
                                <div
                                    class="px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-[9px] font-black uppercase {{ $rp->status === 'diterima' ? 'text-emerald-600 dark:text-emerald-400' : 'text-amber-600 dark:text-amber-500' }}">
                                    {{ $rp->status === 'diterima' ? 'Terkirim' : 'Review' }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Floating Badge -->
                <div
                    class="absolute -bottom-6 -left-6 bg-white dark:bg-slate-800 p-4 rounded-2xl shadow-2xl border border-black/5 dark:border-white/10 flex items-center gap-3 animate-bounce-subtle">
                    <div
                        class="w-10 h-10 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-[10px] font-black text-slate-400 uppercase leading-none">Keamanan Data</div>
                        <div class="text-xs font-black text-slate-800 dark:text-white mt-1">Sistem Terverifikasi</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: FITUR -->
    <section class="py-24 bg-white dark:bg-slate-900" id="fitur">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-16 reveal">
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
                        ['icon' => '📢', 'title' => 'Broadcast Info', 'desc' => 'DMPD bisa kirim pengumuman dan notifikasi langsung kepada seluruh admin desa.', 'color' => 'bg-orange-50'],
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

    <section class="py-24 dark:bg-slate-900/50" style="background: linear-gradient(to bottom right, #fdfbf7, #f3f4f1);"
        id="cara">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16 reveal">
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

    <!-- SECTION: DESA WISATA -->
    <section class="py-24 bg-[#fdf8f0] dark:bg-slate-900/50" id="wisata">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16 reveal">
                <span
                    class="px-4 py-1.5 bg-blue-50 dark:bg-blue-900/20 text-[#1e293b] dark:text-blue-300 text-[11px] font-black uppercase tracking-widest rounded-full border border-blue-100 dark:border-blue-800">🏞️
                    Desa Wisata</span>
                <h2 class="text-4xl font-black mt-6 font-serif text-slate-900 dark:text-white">Potensi Wisata <span
                        style="color: #d97706;">Manggarai
                        Timur</span></h2>
                <p class="text-slate-600 dark:text-slate-400 mt-4 max-w-2xl mx-auto">Flores menyimpan kekayaan alam dan
                    budaya yang luar
                    biasa. Berikut destinasi unggulan yang bisa Anda jelajahi.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($featuredDesas as $desa)
                    <a href="{{ route('public.desa.profil', $desa->id) }}" class="wisata-card block reveal">
                        <div class="wisata-hero relative h-48 overflow-hidden">
                            @if($desa->foto_profil)
                                <img src="{{ asset('storage/' . $desa->foto_profil) }}"
                                    class="w-full h-full object-cover transition-transform duration-700 hover:scale-110"
                                    alt="{{ $desa->nama_desa }}">
                            @elseif($desa->potensis->isNotEmpty() && $desa->potensis->first()->foto_utama)
                                <img src="{{ asset('storage/' . $desa->potensis->first()->foto_utama) }}"
                                    class="w-full h-full object-cover transition-transform duration-700 hover:scale-110"
                                    alt="{{ $desa->nama_desa }}">
                            @else
                                <div class="w-full h-full bg-[#064e3b]/10 flex items-center justify-center text-4xl">🏞️</div>
                            @endif
                            <div class="absolute inset-x-0 bottom-0 p-4 bg-gradient-to-t from-black/60 to-transparent">
                                <span
                                    class="px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-[10px] font-black uppercase tracking-widest rounded-full">⭐
                                    Unggulan</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-black font-serif text-slate-900 dark:text-white">{{ $desa->nama_desa }}
                            </h3>
                            <div class="text-xs text-slate-500 dark:text-slate-400 mt-2 mb-4 flex items-center gap-2">📍
                                Kec.
                                {{ $desa->kecamatan }}
                            </div>
                            <div class="flex flex-wrap gap-2">
                                @forelse($desa->potensis->unique('kategori')->take(2) as $p)
                                    <span
                                        class="px-2 py-1 bg-white dark:bg-slate-800 text-[9px] font-bold text-slate-400 dark:text-slate-500 rounded-full border border-slate-100 dark:border-slate-700 uppercase">
                                        {{ $p->kategori }}
                                    </span>
                                @empty
                                    <span
                                        class="px-2 py-1 bg-white dark:bg-slate-800 text-[9px] font-bold text-slate-400 dark:text-slate-500 rounded-full border border-slate-100 dark:border-slate-700">🌿
                                        EKOWISATA</span>
                                @endforelse
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-20 text-center opacity-50 italic">Belum ada desa wisata yang terdaftar.
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-12 reveal">
                <a href="{{ route('public.desa-wisata') }}"
                    class="inline-flex items-center gap-2 text-sm font-black text-[#064e3b] uppercase tracking-widest hover:underline">Lihat
                    Semua Desa Wisata →</a>
            </div>
        </div>
    </section>

    <!-- SECTION: PENGUMUMAN -->
    <section class="py-24 bg-white dark:bg-slate-900" id="pengumuman">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-16 reveal">
                <span
                    class="px-4 py-1.5 bg-amber-50 dark:bg-amber-900/20 text-[#d97706] dark:text-amber-500 text-[11px] font-black uppercase tracking-widest rounded-full border border-amber-100 dark:border-amber-800">📢
                    Pengumuman</span>
                <h2 class="text-4xl font-black mt-6 font-serif text-slate-900 dark:text-white">Informasi Terbaru Dari
                    <span style="color: #d97706;">DMPD</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 reveal">
                @forelse($announcements as $an)
                    <div class="peng-card">
                        <div
                            class="w-12 h-12 rounded-xl {{ $an->tipe === 'penting' ? 'bg-red-50 dark:bg-red-900/30 text-red-500 dark:text-red-400' : 'bg-blue-50 dark:bg-blue-900/30 text-blue-500 dark:text-blue-400' }} flex items-center justify-center text-xl flex-shrink-0">
                            {{ $an->tipe === 'penting' ? '🚨' : 'ℹ️' }}
                        </div>
                        <div class="flex-1">
                            <span
                                class="px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-widest {{ $an->tipe === 'penting' ? 'bg-red-50 dark:bg-red-900/40 text-red-600 dark:text-red-400' : 'bg-blue-50 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400' }}">{{ $an->tipe ?? 'Info' }}</span>
                            <h4 class="mt-2 text-base font-bold text-slate-900 dark:text-slate-100">{{ $an->judul }}</h4>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400 line-clamp-2">
                                {{ Str::limit(strip_tags($an->isi), 100) }}
                            </p>
                            <div
                                class="mt-4 text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase tracking-widest">
                                {{ $an->created_at->isoFormat('D MMMM Y') }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-10 text-center opacity-50 italic">Tidak ada pengumuman terbaru.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="py-24 text-center relative overflow-hidden"
        style="background: linear-gradient(135deg, #059669 0%, #064e3b 100%);">
        <div class="absolute inset-0 opacity-20 pointer-events-none">
            <div
                class="absolute top-0 left-0 w-64 h-64 bg-white/20 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2">
            </div>
            <div
                class="absolute bottom-0 right-0 w-96 h-96 bg-[#d97706]/20 rounded-full blur-3xl translate-x-1/2 translate-y-1/2">
            </div>
        </div>

        <div class="relative z-10 max-w-2xl mx-auto px-6">
            <h2 class="text-4xl font-black text-white font-serif">Siap Menggunakan <span style="color: #f59e0b;">Sistem
                    Ini?</span></h2>
            <p class="text-white/80 mt-6 text-lg leading-relaxed">Login sekarang untuk mengakses dashboard pelaporan
                desa Anda atau pantau perkembangan seluruh desa se-Kabupaten Manggarai Timur.</p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('login') }}" style="background-color: #d97706; color: #ffffff;"
                    class="px-10 py-4 font-black uppercase tracking-widest rounded-xl shadow-2xl transition-all">🏘️
                    Login Admin Desa</a>
                <a href="{{ route('login') }}"
                    style="background-color: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.3); color: #ffffff;"
                    class="px-10 py-4 font-black uppercase tracking-widest rounded-xl hover:bg-white/20 transition-all">🏛️
                    Login Admin DMPD</a>
            </div>
            <div class="mt-12 text-[10px] text-white/40 uppercase tracking-[0.2em]">Pusat Bantuan:
                dmpd@manggaraitimur.go.id</div>
        </div>
    </section>

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

        // Navbar Scroll Effect
        window.addEventListener('scroll', function () {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('py-3', 'shadow-xl', 'bg-white/95', 'dark:bg-slate-900/95');
                navbar.classList.remove('py-5', 'bg-[#fdf8f0]/90');
            } else {
                navbar.classList.remove('py-3', 'shadow-xl', 'bg-white/95', 'dark:bg-slate-900/95');
                navbar.classList.add('py-5', 'bg-[#fdf8f0]/90');
            }
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fslightbox/3.0.9/index.js"></script>
    </body>
</x-layouts.public>