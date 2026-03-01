<x-layouts.public title="Login - SID Manggarai Timur">
    <!-- v1.1.0-glassmorphism -->
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login — Sistem Informasi Desa, DMPD Kab. Manggarai Timur</title>
        <link
            href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600;700;800&display=swap"
            rel="stylesheet">
        <style>
            :root {
                --emerald-500: #10b981;
                --emerald-600: #059669;
                --emerald-700: #047857;
                --slate-900: #0f172a;
                --slate-800: #1e293b;
                --slate-700: #334155;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'DM Sans', sans-serif;
                background-color: #f8fafc;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                color: #1e293b;
                overflow-x: hidden;
            }

            /* ===== PREMIUM BACKGROUND ===== */
            .bg-canvas {
                position: fixed;
                inset: 0;
                z-index: 0;
                background: radial-gradient(circle at 0% 0%, #ecfdf5 0%, transparent 50%),
                    radial-gradient(circle at 100% 100%, #eff6ff 0%, transparent 50%);
                overflow: hidden;
            }

            .blob {
                position: absolute;
                border-radius: 50%;
                filter: blur(80px);
                z-index: 0;
                opacity: 0.4;
                animation: float 20s infinite alternate;
            }

            .blob-1 {
                width: 500px;
                height: 500px;
                background: #10b981;
                top: -100px;
                right: -100px;
            }

            .blob-2 {
                width: 400px;
                height: 400px;
                background: #3b82f6;
                bottom: -100px;
                left: -100px;
                animation-delay: -5s;
            }

            .blob-3 {
                width: 300px;
                height: 300px;
                background: #f59e0b;
                top: 40%;
                left: 10%;
                animation-delay: -10s;
            }

            @keyframes float {
                0% {
                    transform: translate(0, 0) scale(1);
                }

                100% {
                    transform: translate(100px, 50px) scale(1.1);
                }
            }

            .page-wrapper {
                position: relative;
                z-index: 10;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            /* ===== TOP BAR ===== */
            .topbar {
                padding: 24px 40px;
                display: flex;
                align-items: center;
                gap: 16px;
                background: rgba(255, 255, 255, 0.4);
                backdrop-filter: blur(10px);
                border-bottom: 1px solid rgba(255, 255, 255, 0.5);
            }

            .topbar-logo {
                width: 48px;
                height: 48px;
                background: white;
                border-radius: 16px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 24px;
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            }

            .topbar-text h1 {
                font-size: 11px;
                font-weight: 800;
                color: #64748b;
                letter-spacing: 0.15em;
                text-transform: uppercase;
            }

            .topbar-text h2 {
                font-size: 16px;
                font-weight: 800;
                color: #0f172a;
            }

            /* ===== MAIN CONTENT ===== */
            .login-container {
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 40px 24px;
                max-width: 1100px;
                margin: 0 auto;
                width: 100%;
                gap: 60px;
            }

            .left-side {
                flex: 1;
                max-width: 480px;
                display: none;
                /* Hidden on mobile */
            }

            @media (min-width: 1024px) {
                .left-side {
                    display: block;
                }
            }

            .hero-badge {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                background: white;
                padding: 6px 16px;
                border-radius: 100px;
                border: 1px solid rgba(16, 185, 129, 0.2);
                color: #047857;
                font-size: 12px;
                font-weight: 700;
                margin-bottom: 24px;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            }

            .hero-title {
                font-family: 'Playfair Display', serif;
                font-size: 48px;
                font-weight: 900;
                color: #0f172a;
                line-height: 1.1;
                margin-bottom: 20px;
            }

            .hero-title span {
                color: #10b981;
                position: relative;
            }

            .hero-desc {
                font-size: 16px;
                color: #64748b;
                line-height: 1.7;
                margin-bottom: 40px;
            }

            .feature-pill {
                display: flex;
                align-items: center;
                gap: 12px;
                margin-bottom: 16px;
                background: rgba(255, 255, 255, 0.5);
                padding: 12px 20px;
                border-radius: 20px;
                border: 1px solid white;
                backdrop-filter: blur(5px);
            }

            .feature-pill span {
                font-size: 20px;
            }

            .feature-pill font {
                font-size: 14px;
                font-weight: 700;
                color: #334155;
            }

            /* ===== LOGIN CARD ===== */
            .right-side {
                width: 100%;
                max-width: 440px;
            }

            .glass-card {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.8);
                border-radius: 32px;
                padding: 40px;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            }

            .role-tabs {
                display: flex;
                background: rgba(0, 0, 0, 0.05);
                padding: 6px;
                border-radius: 18px;
                margin-bottom: 32px;
            }

            .tab-btn {
                flex: 1;
                padding: 12px;
                border: none;
                border-radius: 14px;
                font-size: 13px;
                font-weight: 700;
                cursor: pointer;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                color: #64748b;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
            }

            .tab-btn.active-desa {
                background: #10b981;
                color: white;
                box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.4);
            }

            .tab-btn.active-dmpd {
                background: #f59e0b;
                color: white;
                box-shadow: 0 10px 15px -3px rgba(245, 158, 11, 0.4);
            }

            .card-header {
                margin-bottom: 28px;
                text-align: center;
            }

            .card-header h3 {
                font-family: 'Playfair Display', serif;
                font-size: 24px;
                font-weight: 900;
                color: #0f172a;
            }

            .card-header p {
                font-size: 13px;
                color: #64748b;
                margin-top: 4px;
            }

            /* ===== FORM CONTROLS ===== */
            .form-group {
                margin-bottom: 20px;
            }

            .form-group label {
                display: block;
                font-size: 11px;
                font-weight: 800;
                color: #94a3b8;
                text-transform: uppercase;
                letter-spacing: 0.1em;
                margin-bottom: 8px;
                padding-left: 4px;
            }

            .input-box {
                position: relative;
                transition: transform 0.2s;
            }

            .input-box:focus-within {
                transform: translateY(-2px);
            }

            .input-box i {
                position: absolute;
                left: 16px;
                top: 50%;
                transform: translateY(-50%);
                color: #94a3b8;
                pointer-events: none;
            }

            .form-input {
                width: 100%;
                padding: 14px 16px 14px 44px;
                background: white;
                border: 1.5px solid #f1f5f9;
                border-radius: 16px;
                font-size: 14px;
                color: #1e293b;
                outline: none;
                transition: all 0.2s;
            }

            .form-input:focus {
                border-color: #10b981;
                box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
            }

            .form-input.emas:focus {
                border-color: #f59e0b;
                box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
            }

            .btn-submit {
                width: 100%;
                padding: 16px;
                border: none;
                border-radius: 16px;
                font-size: 15px;
                font-weight: 800;
                color: white;
                cursor: pointer;
                transition: all 0.3s;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                margin-top: 8px;
            }

            .btn-submit.hijau {
                background: linear-gradient(135deg, #10b981, #059669);
                box-shadow: 0 10px 20px -5px rgba(16, 185, 129, 0.3);
            }

            .btn-submit.hijau:hover {
                transform: translateY(-2px);
                box-shadow: 0 15px 30px -10px rgba(16, 185, 129, 0.4);
            }

            .btn-submit.emas {
                background: linear-gradient(135deg, #f59e0b, #d97706);
                box-shadow: 0 10px 20px -5px rgba(245, 158, 11, 0.3);
            }

            .btn-submit.emas:hover {
                transform: translateY(-2px);
                box-shadow: 0 15px 30px -10px rgba(245, 158, 11, 0.4);
            }

            .footer-links {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin: 20px 0 32px;
                font-size: 13px;
                font-weight: 600;
            }

            .checkbox-item {
                display: flex;
                align-items: center;
                gap: 8px;
                cursor: pointer;
                color: #64748b;
            }

            .checkbox-item input {
                width: 18px;
                height: 18px;
                accent-color: #10b981;
            }

            .link-alt {
                color: #10b981;
                text-decoration: none;
            }

            .link-alt.emas {
                color: #f59e0b;
            }

            .bottom-note {
                text-align: center;
                font-size: 14px;
                color: #94a3b8;
                padding-top: 24px;
                border-top: 1px solid #f1f5f9;
            }

            .bottom-note a {
                color: #10b981;
                font-weight: 700;
                text-decoration: none;
            }

            .alert-container {
                margin-bottom: 24px;
                padding: 16px;
                border-radius: 16px;
                font-size: 13px;
                font-weight: 600;
                display: none;
            }

            .alert-error {
                display: block;
                background: #fef2f2;
                color: #991b1b;
                border: 1px solid #fee2e2;
            }

            .form-panel {
                display: none;
            }

            .form-panel.show {
                display: block;
                animation: slideIn 0.4s cubic-bezier(0, 0, 0.2, 1);
            }

            @keyframes slideIn {
                from {
                    opacity: 0;
                    transform: translateX(10px);
                }

                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            .main-footer {
                padding: 32px;
                text-align: center;
                font-size: 12px;
                color: #94a3b8;
                font-weight: 600;
                background: rgba(255, 255, 255, 0.3);
                backdrop-filter: blur(5px);
            }

            /* ===== DARK MODE OVERRIDES ===== */
            .dark body {
                background-color: #020617;
                color: #f1f5f9;
            }

            .dark .bg-canvas {
                background: radial-gradient(circle at 0% 0%, #064e3b 0%, transparent 50%),
                    radial-gradient(circle at 100% 100%, #1e3a8a 0%, transparent 50%);
            }

            .dark .topbar {
                background: rgba(15, 23, 42, 0.4);
                border-bottom-color: rgba(255, 255, 255, 0.05);
            }

            .dark .topbar-logo {
                background: #1e293b;
                color: white;
            }

            .dark .topbar-text h2 {
                color: #f1f5f9;
            }

            .dark .hero-title {
                color: #f8fafc;
            }

            .dark .hero-badge {
                background: #1e293b;
                border-color: rgba(16, 185, 129, 0.3);
                color: #34d399;
            }

            .dark .glass-card {
                background: rgba(15, 23, 42, 0.7);
                border-color: rgba(255, 255, 255, 0.05);
                shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            }

            .dark .card-header h3 {
                color: #f8fafc;
            }

            .dark .form-input {
                background: #0f172a;
                border-color: #1e293b;
                color: #f1f5f9;
            }

            .dark .role-tabs {
                background: rgba(255, 255, 255, 0.05);
            }

            .dark .bottom-note {
                border-top-color: #1e293b;
            }

            .dark .feature-pill {
                background: rgba(30, 41, 59, 0.5);
                border-color: rgba(255, 255, 255, 0.05);
            }

            .dark .feature-pill font {
                color: #cbd5e1;
            }
        </style>
    </head>

    <body>
        <div class="bg-canvas">
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
            <div class="blob blob-3"></div>
        </div>

        <div class="page-wrapper">
            <header class="topbar">
                <div class="topbar-logo">🌿</div>
                <div class="topbar-text">
                    <h1>Sistem Informasi Desa & Wisata</h1>
                    <h2>DMPD Manggarai Timur</h2>
                </div>
            </header>

            <main class="login-container">
                <!-- Left Side: Immersive Hero -->
                <div class="left-side">
                    <span class="hero-badge">✨ Platform Digital Terpadu</span>
                    <h1 class="hero-title">Wujudkan Desa<br><span>Mandiri & Digital</span></h1>
                    <p class="hero-desc">
                        Platform resmi Dinas PMD Kabupaten Manggarai Timur untuk tata kelola laporan desa,
                        monitoring pembangunan, dan promosi potensi wisata lokal.
                    </p>

                    <div class="feature-pill">
                        <span>📊</span>
                        <font>Dashboard Monitoring Real-time</font>
                    </div>
                    <div class="feature-pill">
                        <span>🏞️</span>
                        <font>Etalase Wisata & Komoditi Desa</font>
                    </div>
                    <div class="feature-pill">
                        <span>🔒</span>
                        <font>Keamanan Data & Pelaporan Terpadu</font>
                    </div>
                </div>

                <!-- Right Side: Login Form -->
                <div class="right-side">
                    <div class="glass-card">
                        <nav class="role-tabs">
                            <button class="tab-btn {{ old('role', 'desa') === 'desa' ? 'active-desa' : '' }}"
                                id="btn-desa" onclick="switchRole('desa')">🏘️ Admin Desa</button>
                            <button class="tab-btn {{ old('role') === 'dmpd' ? 'active-dmpd' : '' }}" id="btn-dmpd"
                                onclick="switchRole('dmpd')">🏛️ Admin Dinas</button>
                        </nav>

                        @if($errors->any())
                            <div class="alert-container alert-error">
                                ⚠️ {{ $errors->first() }}
                            </div>
                        @endif

                        <!-- Panel Admin Desa -->
                        <div class="form-panel {{ old('role', 'desa') === 'desa' ? 'show' : '' }}" id="panel-desa">
                            <div class="card-header">
                                <h3>Halo, Admin Desa</h3>
                                <p>Silakan masuk untuk mengelola data desa</p>
                            </div>

                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <input type="hidden" name="role" value="desa">

                                <div class="form-group">
                                    <label>Wilayah Kecamatan</label>
                                    <div class="input-box">
                                        <i>📍</i>
                                        <select class="form-input" id="select-kecamatan" onchange="loadDesa(this.value)"
                                            style="padding-left: 44px; appearance: none; cursor: pointer;">
                                            <option value="">Pilih Kecamatan</option>
                                            @foreach($kecamatans as $kec)
                                                <option value="{{ $kec->nama }}">{{ $kec->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Pilih Nama Desa</label>
                                    <div class="input-box">
                                        <i>🏘️</i>
                                        <select class="form-input" id="select-desa" onchange="setKodeDesa(this)"
                                            style="padding-left: 44px; appearance: none; cursor: pointer;">
                                            <option value="">Pilih Desa</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Username / Kode Desa</label>
                                    <div class="input-box">
                                        <i>👤</i>
                                        <input class="form-input" type="text" name="login" id="login-desa"
                                            placeholder="Contoh: DS_BORONG..." value="{{ old('login') }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Kata Sandi</label>
                                    <div class="input-box">
                                        <i>🔑</i>
                                        <input class="form-input" type="password" name="password" id="pass-desa"
                                            placeholder="••••••••" required>
                                        <span
                                            style="position:absolute; right:16px; top:50%; transform:translateY(-50%); cursor:pointer; opacity:0.5;"
                                            onclick="togglePass('pass-desa', this)">👁️</span>
                                    </div>
                                </div>

                                <div class="footer-links">
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span>Ingat Sesi</span>
                                    </label>
                                    <a href="{{ route('password.request') }}" class="link-alt">Lupa Sandi?</a>
                                </div>

                                <button type="submit" class="btn-submit hijau">
                                    Masuk
                                </button>
                            </form>
                        </div>

                        <!-- Panel Admin Dinas -->
                        <div class="form-panel {{ old('role') === 'dmpd' ? 'show' : '' }}" id="panel-dmpd">
                            <div class="card-header">
                                <h3>Admin Dinas</h3>
                                <p>Akses kontrol penuh Sistem Informasi Desa</p>
                            </div>

                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <input type="hidden" name="role" value="dmpd">

                                <div class="form-group">
                                    <label>Email atau Username</label>
                                    <div class="input-box">
                                        <i>👤</i>
                                        <input class="form-input emas" type="text" name="login"
                                            placeholder="admin@dmpd.go.id" value="{{ old('login') }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Kata Sandi</label>
                                    <div class="input-box">
                                        <i>🔑</i>
                                        <input class="form-input emas" type="password" name="password" id="pass-dmpd"
                                            placeholder="••••••••" required>
                                        <span
                                            style="position:absolute; right:16px; top:50%; transform:translateY(-50%); cursor:pointer; opacity:0.5;"
                                            onclick="togglePass('pass-dmpd', this)">👁️</span>
                                    </div>
                                </div>

                                <div class="footer-links">
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span>Aktifkan 8 jam</span>
                                    </label>
                                    <a href="{{ route('password.request') }}" class="link-alt emas">Reset Password</a>
                                </div>

                                <button type="submit" class="btn-submit emas">
                                    Masuk
                                </button>
                            </form>
                        </div>

                        <div class="bottom-note">
                            Belum memiliki akun? <a href="{{ route('register', ['role' => 'admin_desa']) }}"
                                id="reg-link">Buat Akun Sekarang</a>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="main-footer">
                &copy; 2026 DMPD Kabupaten Manggarai Timur. Flores - NTT.
                <span style="margin-left:8px; opacity:0.5;">Sistem Informasi Desa Terpadu v1.1.0</span>
            </footer>
        </div>

        <script>
            function switchRole(role) {
                const btnDesa = document.getElementById('btn-desa');
                const btnDmpd = document.getElementById('btn-dmpd');
                const panelDesa = document.getElementById('panel-desa');
                const panelDmpd = document.getElementById('panel-dmpd');
                const regLink = document.getElementById('reg-link');
                const roleInputs = document.querySelectorAll('input[name="role"]');

                if (role === 'desa') {
                    btnDesa.className = 'tab-btn active-desa';
                    btnDmpd.className = 'tab-btn';
                    panelDesa.classList.add('show');
                    panelDmpd.classList.remove('show');
                    regLink.href = "{{ route('register', ['role' => 'admin_desa']) }}";
                    regLink.style.color = '#10b981';
                    roleInputs.forEach(i => i.value = 'desa');
                } else {
                    btnDmpd.className = 'tab-btn active-dmpd';
                    btnDesa.className = 'tab-btn';
                    panelDmpd.classList.add('show');
                    panelDesa.classList.remove('show');
                    regLink.href = "{{ route('register', ['role' => 'admin_dpmd']) }}";
                    regLink.style.color = '#f59e0b';
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
                selectDesa.innerHTML = '<option value="">Memuat Desa...</option>';

                if (!kecamatan) {
                    selectDesa.innerHTML = '<option value="">Pilih Desa</option>';
                    return;
                }

                try {
                    const response = await fetch(`/api/desas/${encodeURIComponent(kecamatan)}`);
                    const desas = await response.json();

                    selectDesa.innerHTML = '<option value="">Pilih Desa</option>';
                    desas.forEach(desa => {
                        const option = document.createElement('option');
                        option.value = desa.kode_desa || desa.nama_desa;
                        option.textContent = desa.nama_desa;
                        selectDesa.appendChild(option);
                    });
                } catch (error) {
                    console.error('Error fetching desas:', error);
                    selectDesa.innerHTML = '<option value="">Gagal memuat data</option>';
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