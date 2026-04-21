<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Panel Admin - {{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>

    @php
        $user = Auth::user();
        if ($user) {
            $userId = $user->id;
            $role = $user->role;
            $desa = $role === 'admin_desa' ? \App\Models\Desa::where('user_id', $userId)->first() : null;
            $profile = \App\Models\DpmdProfile::first();

            // Count logic
            $newRegulasiCount = 0;
            if ($role === 'admin_desa') {
                $newRegulasiCount = \App\Models\Regulasi::where('created_at', '>=', now()->subDays(7))
                    ->whereDoesntHave('downloads', function ($query) use ($userId) {
                        $query->where('user_id', $userId);
                    })
                    ->count();
            }

            $unreadCount = 0;
            if ($role === 'admin_dpmd' || $role === 'admin_kecamatan') {
                $unreadQuery = \App\Models\Dokumen::where('is_read', false)
                    ->where('sender_id', '!=', $userId);
                    
                if ($role === 'admin_dpmd') {
                    $unreadQuery->where(function ($q) use ($userId) {
                        $q->whereHas('receiverUser', function ($inner) {
                            $inner->where('role', 'admin_dpmd');
                        })->orWhere('receiver_user_id', $userId);
                    });
                } else {
                    $unreadQuery->where('receiver_user_id', $userId);
                }
                $unreadCount = $unreadQuery->count();
            } else {
                $unreadCount = \App\Models\Dokumen::where('is_read', false)
                    ->where('receiver_desa_id', $desa->id ?? 0)
                    ->count();
            }
        }
    @endphp

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --hijau: #166534;
            --hijau-muda: #10b981;
            --hijau-gelap: #064e3b;
            --hijau-pale: #ecfdf5;
            --emas: #d97706;
            --emas-muda: #f59e0b;
            --krem: #fdf8f0;
            --putih: #ffffff;
            --abu: #f3f4f1;
            --abu2: #e2e8f0;
            --teks: #064e3b;
            --teks-abu: #475569;
            --sidebar-w: 260px;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #fdf8f0;
            color: var(--teks);
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .verif-item:hover {
            border-color: var(--emas-muda);
            background: #fdf8f0;
        }

        .sidebar {
            width: var(--sidebar-w);
            background: #022c22;
            /* Very dark emerald to match the request */
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 100;
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.15);
        }

        .sidebar-logo {
            padding: 22px 20px 18px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .s-logo-icon {
            width: 44px;
            height: 44px;
            background:
                {{ $user->role === 'admin_dpmd' ? 'var(--putih)' : 'var(--putih)' }}
            ;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 4px;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .s-logo-text h2 {
            font-size: 13px;
            font-weight: 700;
            color: white;
            line-height: 1.2;
        }

        .s-logo-text p {
            font-size: 10px;
            color: rgba(255, 255, 255, 0.7);
            margin-top: 2px;
        }

        .desa-profile {
            padding: 16px 20px;
            background: rgba(255, 255, 255, 0.06);
            margin: 14px 12px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .desa-profile .dp-label {
            font-size: 9px;
            color: rgba(255, 255, 255, 0.7);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }

        .desa-profile .dp-name {
            font-size: 14px;
            font-weight: 700;
            color: white;
        }

        .desa-profile .dp-kec {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.85);
            margin-top: 2px;
        }

        .desa-profile .dp-badge {
            display: inline-block;
            margin-top: 8px;
            background: rgba(217, 119, 6, 0.2);
            border: 1px solid rgba(217, 119, 6, 0.3);
            color: var(--emas-muda);
            padding: 2px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
        }

        .sidebar-nav {
            padding: 8px 12px;
            flex: 1;
            overflow-y: auto;
        }

        .nav-section-label {
            font-size: 9px;
            color: rgba(255, 255, 255, 0.35);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 10px 8px 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 9px;
            color: rgba(255, 255, 255, 0.85);
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            margin-bottom: 2px;
            text-decoration: none;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .nav-item.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            font-weight: 600;
        }

        .nav-item .ni-icon {
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        .nav-item .ni-badge {
            margin-left: auto;
            background: var(--emas);
            color: white;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            padding: 1px 7px;
            min-width: 20px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 14px 12px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logout-btn-wrap form button {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 9px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            background: rgba(255, 255, 255, 0.05);
            border: none;
            text-align: left;
        }

        .logout-btn-wrap form button:hover {
            background: rgba(255, 80, 80, 0.15);
            color: #ff8080;
        }

        /* MAIN */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        /* MOBILE RESPONSIVENESS */
        .mobile-toggle {
            display: none;
            width: 40px;
            height: 40px;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            background: var(--abu);
            border-radius: 10px;
            cursor: pointer;
            margin-right: 12px;
            color: var(--teks);
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(4px);
            z-index: 95;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 100;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main {
                margin-left: 0;
            }
            .mobile-toggle {
                display: flex;
            }
            .sidebar-overlay.active {
                display: block;
                opacity: 1;
            }
        }

        @media (max-width: 640px) {
            .topbar-left h1 {
                font-size: 16px;
            }
            .topbar-left p {
                display: none;
            }
            .topbar-right .user-chip span {
                display: none;
            }
            .topbar-right .user-chip {
                padding: 6px;
            }
            .content {
                padding: 16px;
            }
        }

        /* TOPBAR */
        .topbar {
            background: rgba(253, 248, 240, 0.9);
            backdrop-filter: blur(10px);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--abu2);
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
        }

        .topbar-left h1 {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 700;
        }

        .topbar-left p {
            font-size: 12px;
            color: var(--teks-abu);
            margin-top: 1px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .notif-btn {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--abu);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 17px;
            position: relative;
            transition: all 0.2s;
        }

        .notif-btn:hover {
            background: var(--hijau-pale);
        }

        .notif-dot {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 8px;
            height: 8px;
            background: #e53e3e;
            border-radius: 50%;
            border: 2px solid white;
        }

        .user-chip {
            display: flex;
            align-items: center;
            gap: 9px;
            background: var(--abu);
            padding: 6px 14px 6px 6px;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .user-chip:hover {
            background: var(--hijau-pale);
        }

        .user-avatar {
            width: 30px;
            height: 30px;
            background: var(--hijau);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: white;
        }

        .user-chip span {
            font-size: 13px;
            font-weight: 600;
            color: var(--teks);
        }

        .content {
            padding: 26px 28px;
            flex: 1;
        }

        .pattern-strip {
            height: 4px;
            background: repeating-linear-gradient(90deg, var(--hijau) 0, var(--hijau) 20px, var(--emas) 20px, var(--emas) 40px, var(--emas-muda) 40px, var(--emas-muda) 60px);
        }

        /* DARK MODE OVERRIDES */
        .dark {
            --krem: #022c22;
            --putih: #064e3b;
            --abu: rgba(255, 255, 255, 0.03);
            --abu2: rgba(255, 255, 255, 0.1);
            --teks: #f0fdf4;
            --teks-abu: #94a3b8;
        }

        .dark body {
            background: var(--krem);
        }

        .dark .topbar {
            background: rgba(2, 44, 34, 0.9);
            border-bottom-color: var(--abu2);
        }

        .dark .topbar-left h1 {
            color: var(--teks);
        }

        .dark .notif-btn {
            background: var(--abu2);
            color: var(--teks);
        }

        .dark .user-chip {
            background: var(--abu2);
        }

        .dark .user-chip span {
            color: var(--teks);
        }

        .dark .stat-card,
        .dark .card {
            background: #064e3b;
            border-color: rgba(255, 255, 255, 0.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .dark .sc-num {
            color: #f0fdf4 !important;
        }

        .dark .card-title {
            color: var(--teks);
        }

        .dark .sidebar-logo {
            border-bottom-color: rgba(255, 255, 255, 0.05);
        }

        .dark .sidebar-footer {
            border-top-color: rgba(255, 255, 255, 0.05);
        }
        .nav-dropdown-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 12px;
            border-radius: 9px;
            color: rgba(255, 255, 255, 0.85);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            margin-bottom: 2px;
            background: transparent;
            border: none;
            text-align: left;
        }

        .nav-dropdown-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .nav-dropdown-btn.active {
            background: rgba(255, 255, 255, 0.05);
            color: white;
            font-weight: 700;
        }

        .nav-dropdown-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
            padding-left: 8px;
        }

        .nav-dropdown-content.show {
            max-height: 500px;
            transition: max-height 0.5s ease-in;
        }

        .nav-dropdown-arrow {
            transition: transform 0.3s;
            font-size: 10px;
            opacity: 0.5;
        }

        .nav-dropdown-btn.open .nav-dropdown-arrow {
            transform: rotate(180deg);
        }

    </style>
</head>

<body>


    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-logo">

            <div class="s-logo-icon">
                @if($profile && $profile->logo_website)
                    <img src="{{ asset('storage/' . $profile->logo_website) }}" alt="Logo"
                        class="w-full h-full object-contain">
                @else
                    🏛️
                @endif
            </div>
            <div class="s-logo-text">
                <h2>SID Manggarai Timur</h2>
            </div>
        </div>

        <div class="desa-profile">
            <div class="dp-label">Akun Masuk sebagai</div>
            <div class="dp-name">{{ $desa->nama_desa ?? $user->name }}</div>
            <div class="dp-kec">📍 {{ $desa ? 'Kec. ' . $desa->kecamatan : ($user->role === 'admin_kecamatan' ? 'Kec. ' . $user->kecamatan : 'Pusat Pemerintahan') }}</div>
            <div class="dp-badge">{{ $user->role === 'admin_dpmd' ? '🏢 Admin DPMD' : ($user->role === 'admin_kecamatan' ? '🏢 Admin Kecamatan' : '🏘️ Admin Desa') }}</div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Menu Utama</div>
            <a href="{{ route('dashboard') }}" class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                <span class="ni-icon">🏠</span> Dashboard
            </a>

            <div class="nav-section-label" style="margin-top:12px;">PROSES INTERNAL</div>
            
            <button type="button" class="nav-dropdown-btn" id="btnBidang">
                <span class="flex items-center gap-[10px]">
                    <span class="ni-icon">🏛️</span> TATA KELOLA BIDANG
                </span>
                <span class="nav-dropdown-arrow">▼</span>
            </button>
            <div class="nav-dropdown-content" id="menuBidang">
                @if($user->role === 'admin_dpmd')
                    <a href="{{ route('dashboard.bidang.index', ['bidang' => 'sekretariat']) }}"
                        class="nav-item {{ Request::query('bidang') === 'sekretariat' ? 'active' : '' }}" style="padding-left: 16px;">
                        <span class="ni-icon">📂</span> Sekretariat
                    </a>
                    <a href="{{ route('dashboard.bidang.index', ['bidang' => 'pemerintahan']) }}"
                        class="nav-item {{ Request::query('bidang') === 'pemerintahan' ? 'active' : '' }}" style="padding-left: 16px;">
                        <span class="ni-icon">🏢</span> Bidang 1 (Pemerintahan)
                    </a>
                    <a href="{{ route('dashboard.bidang.index', ['bidang' => 'pemberdayaan']) }}"
                        class="nav-item {{ Request::query('bidang') === 'pemberdayaan' ? 'active' : '' }}" style="padding-left: 16px;">
                        <span class="ni-icon">🤝</span> Bidang 2 (Pemberdayaan)
                    </a>
                    <a href="{{ route('dashboard.bidang.index', ['bidang' => 'ekonomi']) }}"
                        class="nav-item {{ Request::query('bidang') === 'ekonomi' ? 'active' : '' }}" style="padding-left: 16px;">
                        <span class="ni-icon">💰</span> Bidang 3 (Ekonomi)
                    </a>
                @endif
                <a href="{{ route('dashboard.arsip.index') }}"
                    class="nav-item {{ Request::is('dashboard/arsip*') ? 'active' : '' }}" style="padding-left: 16px;">
                    <span class="ni-icon">🗄️</span> Arsip Dinas
                </a>
                <a href="{{ route('dashboard.regulasi.index') }}"
                    class="nav-item {{ Request::is('dashboard/regulasi*') ? 'active' : '' }}" style="padding-left: 16px;">
                    <span class="ni-icon">📜</span> Surat & Regulasi
                    @if($newRegulasiCount > 0 && $user->role === 'admin_desa')
                        <span class="ni-badge">{{ $newRegulasiCount }}</span>
                    @endif
                </a>
            </div>

            <div class="nav-section-label" style="margin-top:8px;">Komunikasi & Berkas</div>
            <a href="{{ route('dashboard.dokumen.index') }}"
                class="nav-item {{ Request::is('dashboard/dokumen*') ? 'active' : '' }}">
                <span class="ni-icon">📂</span> Kotak Masuk Dokumen
                @if($unreadCount > 0)
                    <span class="ni-badge">{{ $unreadCount }}</span>
                @endif
            </a>

            <div class="nav-section-label" style="margin-top:8px;">Konten Publik</div>
            <a href="{{ route('dashboard.beritas.index') }}"
                class="nav-item {{ Request::is('dashboard/beritas*') ? 'active' : '' }}">
                <span class="ni-icon">📰</span> Publikasi Kegiatan
            </a>
            <a href="{{ route('dashboard.potensi.index') }}"
                class="nav-item {{ Request::is('dashboard/potensi*') ? 'active' : '' }}">
                <span class="ni-icon">🏞️</span> Potensi Wisata
            </a>

            @if($user->role === 'admin_dpmd' || $user->role === 'admin_kecamatan')
                <div class="nav-section-label" style="margin-top:8px;">Master Data</div>
                <a href="{{ route('dashboard.dpmd.desa.index') }}"
                    class="nav-item {{ Request::is('dashboard/dpmd/desa*') ? 'active' : '' }}">
                    <span class="ni-icon">🏘️</span> Data {{ $user->role === 'admin_kecamatan' ? 'Desa Kecamatan' : 'Seluruh Desa' }}
                </a>
                @if($user->role === 'admin_dpmd')
                    <a href="{{ route('dashboard.dpmd.kecamatan.index') }}"
                        class="nav-item {{ Request::is('dashboard/dpmd/kecamatan*') ? 'active' : '' }}">
                        <span class="ni-icon">📍</span> Data Kecamatan
                    </a>
                @endif
                @if($user->role === 'admin_dpmd')
                    <a href="{{ route('pengumuman.index') }}"
                        class="nav-item {{ Request::is('dashboard/pengumuman*') ? 'active' : '' }}">
                        <span class="ni-icon">📢</span> Berita Utama
                    </a>
                @endif
            @endif

            <div class="nav-section-label" style="margin-top:8px;">Akun</div>
            @if($user->role === 'admin_desa')
                <a href="{{ route('dashboard.desa.edit') }}"
                    class="nav-item {{ Request::is('dashboard/profil-desa/edit') ? 'active' : '' }}">
                    <span class="ni-icon">⚙️</span> Pengaturan Desa
                </a>
            @elseif($user->role === 'admin_dpmd')
                <a href="{{ route('dashboard.dpmd.edit-profil') }}"
                    class="nav-item {{ Request::is('dashboard/dpmd/edit-profil') ? 'active' : '' }}">
                    <span class="ni-icon">⚙️</span> Pengaturan Profil
                </a>
                <a href="{{ route('dashboard.dpmd.keamanan') }}"
                    class="nav-item {{ Request::is('dashboard/dpmd/keamanan') ? 'active' : '' }}">
                    <span class="ni-icon">🔑</span> Keamanan Akun
                </a>
            @endif
        </nav>

        <div class="sidebar-footer">
            <div class="logout-btn-wrap">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">
                        <span class="ni-icon">🚪</span> Logout
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main">
        <div class="pattern-strip"></div>

        <!-- TOPBAR -->
        <div class="topbar">
            <div class="topbar-left flex items-center h-full">
                <div class="mobile-toggle" id="sidebarToggle">
                    ☰
                </div>
                <div class="mr-6 md:mr-16">
                    <h1>{{ $title ?? 'Dashboard' }}</h1>
                    <p>{{ now()->isoFormat('dddd, D MMMM Y') }}</p>
                </div>

                <!-- Navigation Links from Public Layout -->
                <div
                    class="hidden md:flex items-center gap-3 border-l border-slate-200 dark:border-slate-700 pl-10 h-full mr-4 overflow-x-auto no-scrollbar">
                    @php
                        $navItems = [
                            ['label' => 'DASHBOARD', 'route' => route('dashboard'), 'pattern' => 'dashboard'],
                            ['label' => 'BERANDA', 'route' => url('/'), 'pattern' => '/'],
                            ['label' => 'PROFIL', 'route' => route('public.profil'), 'pattern' => 'profil'],
                            ['label' => 'WISATA', 'route' => route('public.desa-wisata'), 'pattern' => 'jelajah/desa-wisata'],
                            ['label' => 'KOMODITI', 'route' => route('public.komoditi'), 'pattern' => 'jelajah/komoditi'],
                            ['label' => 'LAPORAN', 'route' => route('public.laporan-desa'), 'pattern' => 'laporan-desa'],
                        ];
                    @endphp

                    @foreach($navItems as $item)
                        <a href="{{ $item['route'] }}"
                            class="px-3 py-1.5 text-[10px] font-extrabold tracking-widest rounded-xl transition-all {{ Request::is($item['pattern']) ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-500/20' : 'text-slate-900 dark:text-slate-400 hover:bg-emerald-50 dark:hover:bg-emerald-900/40 hover:text-emerald-700 dark:hover:text-emerald-100' }}">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="topbar-right">
                <x-theme-switcher />
                <div class="notif-btn">
                    🔔
                    @if($unreadCount > 0)
                        <div class="notif-dot"></div>
                    @endif
                </div>
                <a href="{{ $user->role === 'admin_desa' ? route('dashboard.desa.edit') : route('dashboard.dpmd.edit-profil') }}"
                    class="user-chip">
                    <div class="user-avatar">{{ substr($user->name, 0, 1) }}</div>
                    <span>{{ $user->name }}</span>
                </a>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="content">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl flex items-center gap-3">
                    <span class="text-xl">✅</span>
                    <p class="font-bold text-sm">{{ session('success') }}</p>
                </div>
            @endif
            @if(session('warning'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl flex items-center gap-3">
                    <span class="text-xl">⚠️</span>
                    <p class="font-bold text-sm">{{ session('warning') }}</p>
                </div>
            @endif

            {{ $slot }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('sidebarToggle');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            if (toggle && sidebar && overlay) {
                toggle.addEventListener('click', () => {
                    sidebar.classList.toggle('active');
                    overlay.classList.toggle('active');
                });

                overlay.addEventListener('click', () => {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                });

                // Auto-close on link click (for SPA-like feel or small screens)
                sidebar.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => {
                        if (window.innerWidth <= 1024) {
                            sidebar.classList.remove('active');
                            overlay.classList.remove('active');
                        }
                    });
                });
            }

            // --- Dropdown Tata Kelola Bidang Logic ---
            const btnBidang = document.getElementById('btnBidang');
            const menuBidang = document.getElementById('menuBidang');

            if (btnBidang && menuBidang) {
                // Check if any child link is active on load
                const hasActiveChild = menuBidang.querySelector('.active');
                if (hasActiveChild) {
                    menuBidang.classList.add('show');
                    btnBidang.classList.add('open', 'active');
                }

                btnBidang.addEventListener('click', () => {
                    menuBidang.classList.toggle('show');
                    btnBidang.classList.toggle('open');
                });
            }
        });

        function showFileName(input, targetId) {
            const display = document.getElementById(targetId);
            if (input.files && input.files[0]) {
                display.innerText = 'File Terpilih: ' + input.files[0].name;
                display.classList.remove('text-slate-500', 'text-slate-400');
                display.classList.add('text-emerald-600', 'font-black');

                // For reports which use blue theme
                if (display.closest('.laporan-form')) {
                    display.classList.remove('text-emerald-600');
                    display.classList.add('text-blue-600');
                }
            }
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fslightbox/3.0.9/index.js"></script>
</body>

</html>