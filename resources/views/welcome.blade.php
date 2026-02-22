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
        /* Floating ornament dots */
        .dot-field {
            position: absolute;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .dot {
            position: absolute;
            border-radius: 50%;
            background: rgba(217, 119, 6, 0.1);
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
            background: rgba(56, 176, 106, 0.2);
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
            background: rgba(56, 176, 106, 0.15);
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
                opacity: .6;
            }

            50% {
                transform: translateY(-18px) scale(1.2);
                opacity: 1;
            }
        }

        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, #fdf8f0 0%, #f3f4f1 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            transition: background 0.3s;
        }

        .dark .hero {
            background: linear-gradient(135deg, #020617 0%, #0f172a 100%);
        }

        .hero-grid {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            gap: 60px;
            align-items: center;
            max-width: 1160px;
            margin: 0 auto;
            padding: 100px 40px 80px;
            width: 100%;
        }

        .hero-title {
            font-size: 52px;
            font-weight: 900;
            color: #064e3b;
            line-height: 1.1;
            margin-bottom: 18px;
            transition: color 0.3s;
        }

        .dark .hero-title {
            color: #f8fafc;
        }

        .hero-title span {
            color: var(--emas-muda);
        }

        .hero-title em {
            font-style: italic;
            color: #166534;
            font-family: 'Lora', serif;
            transition: color 0.3s;
        }

        .dark .hero-title em {
            color: #10b981;
        }

        .dark .hero-badge {
            background: rgba(251, 191, 36, 0.1);
            border-color: rgba(251, 191, 36, 0.2);
            color: #fbbf24;
        }

        .vis-card {
            background: white;
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 18px;
            padding: 22px 24px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 2;
            transition: background 0.3s, border-color 0.3s;
        }

        .dark .vis-card {
            background: #0f172a;
            border-color: rgba(255, 255, 255, 0.1);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
        }

        .dark .vis-card .text-slate-900 {
            color: white !important;
        }

        /* Reveal Animation */
        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity .7s ease, transform .7s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Mockup Specific Styles */
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fffbeb;
            border: 1px solid #fef3c7;
            color: #d97706;
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 22px;
        }

        .vc-stat {
            background: #f8fafc;
            border-radius: 10px;
            padding: 12px;
            text-align: center;
            transition: background 0.3s;
        }

        .dark .vc-stat {
            background: rgba(255, 255, 255, 0.05);
        }

        .dark .vc-stat div:first-child {
            color: #fbbf24 !important;
        }

        .vdr-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .vc-desa-row {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f1f5f9;
            border-radius: 8px;
            padding: 8px 12px;
            transition: background 0.3s;
        }

        .dark .vc-desa-row {
            background: rgba(255, 255, 255, 0.05);
        }

        .dark .vdr-text-main {
            color: #f1f5f9 !important;
        }

        .fitur-card {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 18px;
            padding: 28px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            transition: all 0.35s;
            position: relative;
            overflow: hidden;
        }

        .fitur-card:hover {
            transform: translateY(-6px);
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .wisata-card {
            border-radius: 18px;
            overflow: hidden;
            transition: all .35s;
            border: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
        }

        .wisata-card:hover {
            transform: translateY(-8px);
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .wisata-hero {
            height: 160px;
            position: relative;
            display: flex;
            align-items: flex-end;
            padding: 16px;
            background: linear-gradient(160deg, #0f172a, #1a2e4a);
        }

        .peng-card {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 14px;
            padding: 22px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all .2s;
            cursor: pointer;
            display: flex;
            gap: 16px;
            align-items: flex-start;
        }

        .peng-card:hover {
            border-color: var(--emas-muda);
            background: rgba(255, 255, 255, 0.06);
            transform: translateX(4px);
        }
    </style>

    <!-- HERO -->
    <section class="hero">
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
            <div>
                <div class="hero-badge">🌿 DMPD Kab. Manggarai Timur — NTT</div>
                <h1 class="hero-title">
                    Sistem Informasi<br>
                    <span style="color: #f59e0b;">Pelaporan Desa</span><br>
                    <em>&amp; Promosi Wisata</em>
                </h1>
                <p class="text-slate-600 dark:text-slate-400 text-lg mb-8 leading-relaxed max-w-lg">
                    Platform digital terpadu milik Dinas Pemberdayaan Masyarakat dan Desa
                    Kabupaten Manggarai Timur untuk monitoring pelaporan seluruh desa
                    dan promosi potensi wisata Flores NTT kepada dunia.
                </p>
                <div class="flex gap-4 mb-12">
                    <a href="{{ route('login') }}"
                        style="background: linear-gradient(to right, #d97706, #f59e0b); color: #ffffff;"
                        class="px-8 py-4 font-bold rounded-xl shadow-xl shadow-amber-600/30 hover:-translate-y-1 transition-all">🔐
                        Masuk ke Sistem</a>
                    <a href="#wisata" style="background-color: #ecfdf5; border: 1px solid #10b981; color: #064e3b;"
                        class="px-8 py-4 font-bold rounded-xl hover:bg-emerald-100 dark:bg-emerald-900/30 dark:border-emerald-700 dark:text-emerald-400 transition-all">🏞️
                        Jelajahi Desa Wisata</a>
                </div>
                <div class="flex gap-8 pt-8 border-t border-slate-200 dark:border-slate-800">
                    <div>
                        <div class="text-3xl font-black text-[#d97706] dark:text-amber-400 font-serif">{{ $totalDesa }}
                        </div>
                        <div class="text-[10px] text-slate-500 dark:text-slate-400 uppercase tracking-widest mt-1">Total
                            Wilayah</div>
                    </div>
                    <div class="w-px bg-slate-200 dark:bg-slate-800"></div>
                    <div>
                        <div class="text-3xl font-black text-[#d97706] dark:text-amber-400 font-serif">
                            {{ $totalKecamatan }}
                        </div>
                        <div class="text-[10px] text-slate-500 dark:text-slate-400 uppercase tracking-widest mt-1">
                            Kecamatan</div>
                    </div>
                    <div class="w-px bg-slate-200 dark:bg-slate-800"></div>
                    <div>
                        <div class="text-3xl font-black text-[#d97706] dark:text-amber-400 font-serif">
                            {{ $desaWisataCount }}
                        </div>
                        <div class="text-[10px] text-slate-500 dark:text-slate-400 uppercase tracking-widest mt-1">Desa
                            Wisata</div>
                    </div>
                    <div class="w-px bg-slate-200 dark:bg-slate-800"></div>
                    <div>
                        <div class="text-3xl font-black text-[#d97706] dark:text-amber-400 font-serif">
                            {{ $kepatuhanPercent }}%
                        </div>
                        <div class="text-[10px] text-slate-500 dark:text-slate-400 uppercase tracking-widest mt-1">
                            Kepatuhan</div>
                    </div>
                    @if($dpmdProfile && $dpmdProfile->stat_wisatawan)
                        <div class="w-px bg-slate-200 dark:bg-slate-800"></div>
                        <div>
                            <div class="text-3xl font-black text-[#d97706] dark:text-amber-400 font-serif">
                                {{ $dpmdProfile->stat_wisatawan }}
                            </div>
                            <div class="text-[10px] text-slate-500 dark:text-slate-400 uppercase tracking-widest mt-1">
                                Wisatawan</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- RIGHT — VISUAL CARD -->
            <div class="relative">
                <div class="absolute inset-0 bg-white/5 rounded-3xl transform translate-x-4 translate-y-4"></div>
                <div class="vis-card">
                    <div class="flex items-center gap-4 mb-8 pb-4 border-b border-white/10">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-[#d97706] to-[#f59e0b] rounded-xl flex items-center justify-center text-2xl shadow-lg shadow-amber-500/20">
                            📊</div>
                        <div>
                            <div class="text-slate-900 font-bold">Dashboard Pelaporan Desa</div>
                            <div class="text-slate-400 text-[10px] uppercase tracking-widest">
                                {{ now()->isoFormat('MMMM Y') }}
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-3 mb-8">
                        <div class="vc-stat">
                            <div class="text-2xl font-black text-[#d97706] font-serif">&nbsp;</div>
                            <div class="text-[10px] text-slate-700 font-bold dark:text-slate-300 uppercase mt-1">Selesai
                                ✅</div>
                        </div>
                        <div class="vc-stat">
                            <div class="text-2xl font-black text-[#d97706] font-serif">{{ $laporanProses }}</div>
                            <div class="text-[10px] text-slate-700 font-bold dark:text-slate-300 uppercase mt-1">Proses
                                ⏳</div>
                        </div>
                        <div class="vc-stat">
                            <div class="text-2xl font-black text-red-600 dark:text-red-400 font-serif">
                                {{ $belumMelapor }}
                            </div>
                            <div class="text-[10px] text-slate-700 font-bold dark:text-slate-300 uppercase mt-1">Belum ❗
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        @php
                            $recentReports = \App\Models\Laporan::with('desa')->latest()->take(3)->get();
                        @endphp
                        @foreach($recentReports as $rp)
                            <div class="vc-desa-row">
                                <div class="vdr-dot {{ $rp->status === 'diterima' ? 'bg-emerald-400' : 'bg-amber-400' }}">
                                </div>
                                <div class="flex-1">
                                    <div class="text-slate-800 dark:text-slate-200 text-xs font-bold vdr-text-main">
                                        {{ $rp->desa->nama_desa ?? '-' }}
                                    </div>
                                    <div class="text-[10px] text-slate-400 dark:text-slate-500">Kec.
                                        {{ $rp->desa->kecamatan ?? '-' }}
                                    </div>
                                </div>
                                <div
                                    class="text-[10px] font-black uppercase {{ $rp->status === 'diterima' ? 'text-emerald-400' : 'text-amber-400' }}">
                                    {{ $rp->status === 'diterima' ? 'Terkirim' : 'Proses' }}
                                </div>
                            </div>
                        @endforeach
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

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 reveal">
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
                        class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-2xl p-8 text-center shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all group">
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

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 reveal">
                @forelse($featuredDesas as $desa)
                    <a href="{{ route('public.desa.profil', $desa->id) }}" class="wisata-card block">
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
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });
        reveals.forEach(el => observer.observe(el));
    </script>
</x-layouts.public>