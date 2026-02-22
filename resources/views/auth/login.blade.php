<x-layouts.public title="Login - SID Manggarai Timur">
    <!-- v1.0.1-fixed -->
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login — Sistem Informasi Desa, DMPD Kab. Manggarai Timur</title>
        <link
            href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">
        <style>
            :root {
                --hijau: #166534;
                --hijau-muda: #10b981;
                --hijau-gelap: #064e3b;
                --emas: #d97706;
                --emas-muda: #f59e0b;
                --krem: #fdf8f0;
                --putih: #ffffff;
                --abu: #f3f4f1;
                --teks-gelap: #064e3b;
                --teks-abu: #475569;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'DM Sans', sans-serif;
                background: #fdf8f0;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                color: var(--teks-gelap);
            }

            /* ===== BACKGROUND PATTERN ===== */
            .bg-pattern {
                position: fixed;
                inset: 0;
                background:
                    radial-gradient(circle at 15% 25%, rgba(217, 119, 6, 0.05) 0%, transparent 40%),
                    radial-gradient(circle at 85% 75%, rgba(16, 101, 52, 0.05) 0%, transparent 40%),
                    linear-gradient(135deg, #fdf8f0 0%, #f3f4f1 100%);
                z-index: 0;
            }

            .bg-circles {
                position: fixed;
                inset: 0;
                z-index: 0;
                overflow: hidden;
            }

            .circle {
                position: absolute;
                border-radius: 50%;
                opacity: 0.05;
                border: 2px solid var(--emas-muda);
            }

            .c1 {
                width: 400px;
                height: 400px;
                top: -100px;
                left: -100px;
            }

            .c2 {
                width: 300px;
                height: 300px;
                bottom: -80px;
                right: -80px;
            }

            .c3 {
                width: 200px;
                height: 200px;
                top: 40%;
                left: 5%;
                opacity: 0.04;
            }

            /* ===== WRAPPER ===== */
            .page-wrapper {
                position: relative;
                z-index: 10;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            /* ===== TOP BAR ===== */
            .topbar {
                padding: 18px 40px;
                display: flex;
                align-items: center;
                gap: 14px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            }

            .topbar-logo {
                width: 46px;
                height: 46px;
                background: var(--emas-muda);
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 22px;
                flex-shrink: 0;
                box-shadow: 0 4px 16px rgba(201, 144, 10, 0.35);
            }

            .topbar-text h1 {
                font-size: 12px;
                font-weight: 600;
                color: var(--teks-abu);
                letter-spacing: 1.5px;
                text-transform: uppercase;
            }

            .topbar-text h2 {
                font-size: 15px;
                font-weight: 700;
                color: var(--teks-gelap);
            }

            /* ===== MAIN LOGIN AREA ===== */
            .login-area {
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 40px 20px;
                gap: 0;
            }

            /* ===== LEFT PANEL ===== */
            .left-panel {
                max-width: 440px;
                width: 100%;
                padding: 0 40px 0 0;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .left-badge {
                display: inline-block;
                background: rgba(201, 144, 10, 0.2);
                border: 1px solid rgba(201, 144, 10, 0.35);
                color: var(--emas-muda);
                padding: 5px 14px;
                border-radius: 20px;
                font-size: 11px;
                font-weight: 600;
                letter-spacing: 2px;
                text-transform: uppercase;
                margin-bottom: 20px;
                width: fit-content;
            }

            .left-title {
                font-family: 'Playfair Display', serif;
                font-size: 38px;
                font-weight: 900;
                color: var(--teks-gelap);
                line-height: 1.15;
                margin-bottom: 16px;
            }

            .left-title span {
                color: var(--emas-muda);
            }

            .left-desc {
                font-size: 14px;
                color: var(--teks-abu);
                line-height: 1.7;
                margin-bottom: 32px;
            }

            .info-list {
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .info-item {
                display: flex;
                align-items: flex-start;
                gap: 12px;
            }

            .info-icon {
                width: 36px;
                height: 36px;
                background: rgba(255, 255, 255, 0.08);
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 16px;
                flex-shrink: 0;
            }

            .info-text h4 {
                font-size: 13px;
                font-weight: 600;
                color: var(--teks-gelap);
            }

            .info-text p {
                font-size: 12px;
                color: rgba(255, 255, 255, 0.5);
                margin-top: 2px;
            }

            /* ===== DIVIDER ===== */
            .panel-divider {
                width: 1px;
                background: rgba(0, 0, 0, 0.05);
                align-self: stretch;
                margin: 0 20px;
            }

            /* ===== RIGHT PANEL — LOGIN CARDS ===== */
            .right-panel {
                max-width: 480px;
                width: 100%;
                padding: 0 0 0 40px;
            }

            .role-selector {
                display: flex;
                gap: 8px;
                margin-bottom: 24px;
                background: rgba(0, 0, 0, 0.03);
                padding: 5px;
                border-radius: 12px;
            }

            .role-btn {
                flex: 1;
                padding: 11px 16px;
                border: none;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.25s;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                font-family: 'DM Sans', sans-serif;
            }

            .role-btn.inactive {
                background: transparent;
                color: var(--teks-abu);
            }

            .role-btn.active-desa {
                background: var(--hijau);
                color: white;
                box-shadow: 0 4px 16px rgba(26, 107, 58, 0.4);
            }

            .role-btn.active-dmpd {
                background: var(--emas);
                color: white;
                box-shadow: 0 4px 16px rgba(201, 144, 10, 0.4);
            }

            /* ===== FORM CARD ===== */
            .login-card {
                background: var(--putih);
                border-radius: 20px;
                padding: 36px;
                box-shadow: 0 24px 60px rgba(0, 0, 0, 0.3);
                animation: fadeUp 0.4s ease;
            }

            @keyframes fadeUp {
                from {
                    opacity: 0;
                    transform: translateY(16px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .card-header-area {
                display: flex;
                align-items: center;
                gap: 14px;
                margin-bottom: 28px;
                padding-bottom: 20px;
                border-bottom: 1px solid var(--abu);
            }

            .card-icon-big {
                width: 54px;
                height: 54px;
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 26px;
                flex-shrink: 0;
            }

            .icon-hijau-bg {
                background: linear-gradient(135deg, #1a6b3a, #2e9055);
            }

            .icon-emas-bg {
                background: linear-gradient(135deg, #c9900a, #f0b429);
            }

            .card-header-text h3 {
                font-family: 'Playfair Display', serif;
                font-size: 20px;
                font-weight: 700;
                color: var(--teks-gelap);
            }

            .card-header-text p {
                font-size: 12px;
                color: var(--teks-abu);
                margin-top: 2px;
            }

            .form-group {
                margin-bottom: 18px;
            }

            .form-group label {
                display: block;
                font-size: 12px;
                font-weight: 600;
                color: var(--teks-abu);
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-bottom: 7px;
            }

            .input-wrap {
                position: relative;
            }

            .input-icon {
                position: absolute;
                left: 14px;
                top: 50%;
                transform: translateY(-50%);
                font-size: 16px;
                color: #aaa;
            }

            .form-control {
                width: 100%;
                padding: 11px 14px 11px 42px;
                border: 1.5px solid #e0d8cc;
                border-radius: 10px;
                font-size: 14px;
                color: var(--teks-gelap);
                background: var(--krem);
                font-family: 'DM Sans', sans-serif;
                transition: all 0.2s;
                outline: none;
            }

            .form-control:focus {
                border-color: var(--hijau);
                background: white;
                box-shadow: 0 0 0 3px rgba(26, 107, 58, 0.1);
            }

            .form-control.emas:focus {
                border-color: var(--emas);
                box-shadow: 0 0 0 3px rgba(201, 144, 10, 0.1);
            }

            .form-control::placeholder {
                color: #bbb;
            }

            /* select kecamatan */
            .form-control.select-kec {
                appearance: none;
                cursor: pointer;
                padding-right: 36px;
            }

            .select-arrow {
                position: absolute;
                right: 14px;
                top: 50%;
                transform: translateY(-50%);
                font-size: 10px;
                color: #aaa;
                pointer-events: none;
            }

            /* password toggle */
            .pass-toggle {
                position: absolute;
                right: 14px;
                top: 50%;
                transform: translateY(-50%);
                font-size: 16px;
                cursor: pointer;
                color: #aaa;
                user-select: none;
            }

            .remember-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 24px;
            }

            .checkbox-wrap {
                display: flex;
                align-items: center;
                gap: 8px;
                cursor: pointer;
            }

            .checkbox-wrap input[type=checkbox] {
                width: 16px;
                height: 16px;
                accent-color: var(--hijau);
                cursor: pointer;
            }

            .checkbox-wrap span {
                font-size: 13px;
                color: var(--teks-abu);
            }

            .forgot-link {
                font-size: 13px;
                color: var(--hijau);
                text-decoration: none;
                font-weight: 500;
            }

            .forgot-link.emas-link {
                color: var(--emas);
            }

            .forgot-link:hover {
                text-decoration: underline;
            }

            .btn-login {
                width: 100%;
                padding: 14px;
                border: none;
                border-radius: 10px;
                font-size: 15px;
                font-weight: 700;
                color: white;
                cursor: pointer;
                font-family: 'DM Sans', sans-serif;
                transition: all 0.25s;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                letter-spacing: 0.3px;
            }

            .btn-login.hijau {
                background: linear-gradient(135deg, var(--hijau), var(--hijau-muda));
                box-shadow: 0 6px 20px rgba(26, 107, 58, 0.35);
            }

            .btn-login.hijau:hover {
                box-shadow: 0 8px 28px rgba(26, 107, 58, 0.5);
                transform: translateY(-1px);
            }

            .btn-login.emas-btn {
                background: linear-gradient(135deg, var(--emas), var(--emas-muda));
                box-shadow: 0 6px 20px rgba(201, 144, 10, 0.35);
            }

            .btn-login.emas-btn:hover {
                box-shadow: 0 8px 28px rgba(201, 144, 10, 0.5);
                transform: translateY(-1px);
            }

            .card-footer-note {
                text-align: center;
                font-size: 12px;
                color: #bbb;
                margin-top: 20px;
            }

            .card-footer-note span {
                color: var(--hijau);
                font-weight: 600;
                cursor: pointer;
            }

            .card-footer-note span.emas-span {
                color: var(--emas);
            }

            /* alert box */
            .alert-box {
                padding: 12px;
                border-radius: 10px;
                font-size: 13px;
                margin-bottom: 20px;
                display: none;
            }

            .alert-error {
                background: #ffebeb;
                color: #b91c1c;
                border: 1px solid #fecaca;
                display: block;
            }

            .alert-success {
                background: #ecfdf5;
                color: #047857;
                border: 1px solid #a7f3d0;
                display: block;
            }

            /* HIDDEN panels */
            .login-form-panel {
                display: none;
            }

            .login-form-panel.show {
                display: block;
            }

            /* ===== ROLE INFO BADGES bawah form ===== */
            .role-info-strip {
                display: flex;
                gap: 10px;
                margin-top: 20px;
            }

            .role-info-badge {
                flex: 1;
                background: rgba(255, 255, 255, 0.07);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 10px;
                padding: 12px 14px;
                text-align: center;
            }

            .role-info-badge .ri-icon {
                font-size: 22px;
                display: block;
                margin-bottom: 4px;
            }

            .role-info-badge .ri-title {
                font-size: 12px;
                font-weight: 700;
                color: var(--teks-gelap);
            }

            .role-info-badge .ri-desc {
                font-size: 10px;
                color: var(--teks-abu);
                margin-top: 2px;
                line-height: 1.4;
            }

            /* ===== FOOTER ===== */
            .footer {
                padding: 16px 40px;
                border-top: 1px solid rgba(0, 0, 0, 0.05);
                display: flex;
                align-items: center;
                justify-content: space-between;
                font-size: 11px;
                color: var(--teks-abu);
                position: relative;
                z-index: 10;
            }

            .footer span {
                color: var(--emas-muda);
            }

            .pattern-strip {
                height: 5px;
                background: repeating-linear-gradient(90deg,
                        var(--hijau) 0px, var(--hijau) 20px,
                        var(--emas) 20px, var(--emas) 40px,
                        #7c4a1e 40px, #7c4a1e 60px);
                position: relative;
                z-index: 10;
            }
        </style>
    </head>

    <body>

        <div class="bg-pattern"></div>
        <div class="bg-circles">
            <div class="circle c1"></div>
            <div class="circle c2"></div>
            <div class="circle c3"></div>
        </div>

        <div class="page-wrapper">

            <!-- TOP BAR -->
            <div class="topbar">
                <div class="topbar-logo">🏛️</div>
                <div class="topbar-text">
                    <h1>Dinas Pemberdayaan Masyarakat & Desa (DMPD)</h1>
                    <h2>Pemerintah Kabupaten Manggarai Timur, Flores NTT</h2>
                </div>
            </div>

            <div class="pattern-strip"></div>

            <!-- LOGIN AREA -->
            <div class="login-area">

                <!-- LEFT PANEL -->
                <div class="left-panel">
                    <div class="left-badge">🌿 Sistem Informasi Desa</div>
                    <h1 class="left-title">Pelaporan Desa &<br><span>Promosi Wisata</span><br>Manggarai Timur</h1>
                    <p class="left-desc">Platform digital terpadu untuk pelaporan perkembangan desa dan promosi potensi
                        wisata Kabupaten Manggarai Timur, Flores NTT.</p>

                    <div class="info-list">
                        <div class="info-item">
                            <div class="info-icon">📋</div>
                            <div class="info-text">
                                <h4>Pelaporan Real-time</h4>
                                <p>Input dan pantau laporan desa dari seluruh kecamatan secara langsung</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">🏞️</div>
                            <div class="info-text">
                                <h4>Promosi Desa Wisata</h4>
                                <p>Tampilkan potensi wisata desa kepada publik dan investor</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">📊</div>
                            <div class="info-text">
                                <h4>Dashboard Analitik</h4>
                                <p>Monitoring progres pembangunan dan kepatuhan pelaporan desa</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">🔒</div>
                            <div class="info-text">
                                <h4>Akses Berbasis Peran</h4>
                                <p>Dua level akses: Admin Desa dan Admin DMPD dengan hak berbeda</p>
                            </div>
                        </div>
                    </div>

                    <div class="role-info-strip">
                        <div class="role-info-badge">
                            <span class="ri-icon">🏘️</span>
                            <div class="ri-title">Admin Desa</div>
                            <div class="ri-desc">Input laporan & data potensi desa masing-masing</div>
                        </div>
                        <div class="role-info-badge">
                            <span class="ri-icon">🏛️</span>
                            <div class="ri-title">Admin DMPD</div>
                            <div class="ri-desc">Kelola semua data desa, validasi & publikasi</div>
                        </div>
                    </div>
                </div>

                <!-- DIVIDER -->
                <div class="panel-divider"></div>

                <!-- RIGHT PANEL -->
                <div class="right-panel">

                    <!-- ROLE SELECTOR -->
                    <div class="role-selector">
                        <button class="role-btn {{ old('role', 'desa') === 'desa' ? 'active-desa' : 'inactive' }}"
                            id="btn-desa" onclick="switchRole('desa')">🏘️ Admin Desa</button>
                        <button class="role-btn {{ old('role') === 'dmpd' ? 'active-dmpd' : 'inactive' }}" id="btn-dmpd"
                            onclick="switchRole('dmpd')">🏛️ Admin Dinas</button>
                    </div>

                    @if($errors->any())
                        <div class="alert-box alert-error">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <!-- FORM ADMIN DESA -->
                    <div class="login-form-panel {{ old('role', 'desa') === 'desa' ? 'show' : '' }}" id="panel-desa">
                        <div class="login-card">
                            <div class="card-header-area">
                                <div class="card-icon-big icon-hijau-bg">🏘️</div>
                                <div class="card-header-text">
                                    <h3>Masuk sebagai Admin Desa</h3>
                                    <p>Pelaporan &amp; data potensi desa Anda</p>
                                </div>
                            </div>

                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <input type="hidden" name="role" value="desa">

                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <div class="input-wrap">
                                        <span class="input-icon">📍</span>
                                        <select class="form-control select-kec" id="select-kecamatan"
                                            onchange="loadDesa(this.value)">
                                            <option value="">-- Pilih Kecamatan --</option>
                                            @foreach($kecamatans as $kec)
                                                <option value="{{ $kec->nama }}">{{ $kec->nama }}</option>
                                            @endforeach
                                        </select>
                                        <span class="select-arrow">▼</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Nama Desa</label>
                                    <div class="input-wrap">
                                        <span class="input-icon">🏘️</span>
                                        <select class="form-control select-kec" id="select-desa"
                                            onchange="setKodeDesa(this)">
                                            <option value="">-- Pilih Desa --</option>
                                        </select>
                                        <span class="select-arrow">▼</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Username / Kode Desa</label>
                                    <div class="input-wrap">
                                        <span class="input-icon">👤</span>
                                        <input class="form-control" type="text" name="login" id="login-desa"
                                            placeholder="Contoh: DESA_BORONGXX" value="{{ old('login') }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-wrap">
                                        <span class="input-icon">🔑</span>
                                        <input class="form-control" type="password" name="password" id="pass-desa"
                                            placeholder="Masukkan password" required>
                                        <span class="pass-toggle" onclick="togglePass('pass-desa', this)">👁️</span>
                                    </div>
                                </div>

                                <div class="remember-row">
                                    <label class="checkbox-wrap">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span>Ingat saya</span>
                                    </label>
                                    <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
                                </div>

                                <button type="submit" class="btn-login hijau">
                                    🔐 Masuk sebagai Admin Desa
                                </button>
                            </form>

                            <div class="card-footer-note">
                                Belum punya akun? <a
                                    href="{{ route('register', ['role' => 'admin_desa']) }}"><span>Registrasi
                                        Akun</span></a>
                            </div>
                        </div>
                    </div>

                    <!-- FORM ADMIN DMPD -->
                    <div class="login-form-panel {{ old('role') === 'dmpd' ? 'show' : '' }}" id="panel-dmpd">
                        <div class="login-card">
                            <div class="card-header-area">
                                <div class="card-icon-big icon-emas-bg">🏛️</div>
                                <div class="card-header-text">
                                    <h3>Masuk sebagai Admin Dinas</h3>
                                    <p>Akses penuh manajemen seluruh data desa</p>
                                </div>
                            </div>

                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <input type="hidden" name="role" value="dmpd">

                                <div class="form-group">
                                    <label>Email / Username</label>
                                    <div class="input-wrap">
                                        <span class="input-icon">👤</span>
                                        <input class="form-control emas" type="text" name="login"
                                            placeholder="Masukkan email/username" value="{{ old('login') }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-wrap">
                                        <span class="input-icon">🔑</span>
                                        <input class="form-control emas" type="password" name="password" id="pass-dmpd"
                                            placeholder="Masukkan password" required>
                                        <span class="pass-toggle" onclick="togglePass('pass-dmpd', this)">👁️</span>
                                    </div>
                                </div>

                                <div class="remember-row">
                                    <label class="checkbox-wrap">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span>Sesi aktif 8 jam</span>
                                    </label>
                                    <a href="{{ route('password.request') }}" class="forgot-link emas-link">Reset
                                        password?</a>
                                </div>

                                <button type="submit" class="btn-login emas-btn">
                                    🔐 Masuk sebagai Admin Dinas
                                </button>
                            </form>

                            <div class="card-footer-note">
                                Belum terdaftar? <a href="{{ route('register', ['role' => 'admin_dpmd']) }}"><span
                                        class="emas-span">Registrasi Admin</span></a>
                            </div>
                        </div>
                    </div>

                </div><!-- end right-panel -->
            </div><!-- end login-area -->

            <!-- FOOTER -->
            <div class="footer">
                <span>© 2025 <span style="color:var(--emas-muda)">DMPD Kab. Manggarai Timur</span> — Flores, Nusa
                    Tenggara NTT</span>
                <span>Sistem Informasi Pelaporan & Promosi Desa | v1.0.0</span>
            </div>
        </div>

        <script>
            function switchRole(role) {
                const btnDesa = document.getElementById('btn-desa');
                const btnDmpd = document.getElementById('btn-dmpd');
                const panelDesa = document.getElementById('panel-desa');
                const panelDmpd = document.getElementById('panel-dmpd');

                // Hidden inputs to keep track of role
                const roleInputs = document.querySelectorAll('input[name="role"]');

                if (role === 'desa') {
                    btnDesa.className = 'role-btn active-desa';
                    btnDmpd.className = 'role-btn inactive';
                    panelDesa.classList.add('show');
                    panelDmpd.classList.remove('show');
                    roleInputs.forEach(i => i.value = 'desa');
                } else {
                    btnDmpd.className = 'role-btn active-dmpd';
                    btnDesa.className = 'role-btn inactive';
                    panelDmpd.classList.add('show');
                    panelDesa.classList.remove('show');
                    roleInputs.forEach(i => i.value = 'dmpd');
                }
            }

            function togglePass(id, icon) {
                const input = document.getElementById(id);
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.textContent = '🙈';
                } else {
                    input.type = 'password';
                    icon.textContent = '👁️';
                }
            }

            async function loadDesa(kecamatan) {
                const selectDesa = document.getElementById('select-desa');
                selectDesa.innerHTML = '<option value="">-- Memuat Desa... --</option>';

                if (!kecamatan) {
                    selectDesa.innerHTML = '<option value="">-- Pilih Desa --</option>';
                    return;
                }

                try {
                    const response = await fetch(`/api/desas/${encodeURIComponent(kecamatan)}`);
                    const desas = await response.json();

                    selectDesa.innerHTML = '<option value="">-- Pilih Desa --</option>';
                    desas.forEach(desa => {
                        const option = document.createElement('option');
                        option.value = desa.kode_desa || desa.nama_desa;
                        option.textContent = desa.nama_desa;
                        selectDesa.appendChild(option);
                    });
                } catch (error) {
                    console.error('Error fetching desas:', error);
                    selectDesa.innerHTML = '<option value="">-- Gagal memuat data --</option>';
                }
            }

            function setKodeDesa(select) {
                const loginInput = document.getElementById('login-desa');
                if (select.value) {
                    loginInput.value = select.value;
                }
            }
        </script>

    </body>

    </html>
</x-layouts.public>