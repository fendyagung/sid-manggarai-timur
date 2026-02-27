<x-layouts.public title="Register - SID Manggarai Timur">
    <style>
        .auth-container {
            min-height: calc(100vh - 80px);
            /* Adjust based on navbar height if any */
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
            position: relative;
            overflow: hidden;
            background: radial-gradient(circle at 0% 0%, #ecfdf5 0%, transparent 50%),
                radial-gradient(circle at 100% 100%, #eff6ff 0%, transparent 50%);
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
            opacity: 0.3;
            animation: float 20s infinite alternate;
        }

        .blob-1 {
            width: 400px;
            height: 400px;
            background: #10b981;
            top: -100px;
            right: -100px;
        }

        .blob-2 {
            width: 300px;
            height: 300px;
            background: #3b82f6;
            bottom: -100px;
            left: -100px;
            animation-delay: -5s;
        }

        @keyframes float {
            0% {
                transform: translate(0, 0) scale(1);
            }

            100% {
                transform: translate(50px, 30px) scale(1.1);
            }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 32px;
            padding: 40px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 440px;
            position: relative;
            z-index: 10;
        }

        .card-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .card-header h2 {
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

        .form-input {
            width: 100%;
            padding: 12px 16px;
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

        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            font-size: 13px;
            font-weight: 700;
            color: #475569;
            width: 100%;
            margin-bottom: 24px;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 16px;
            font-size: 15px;
            font-weight: 800;
            color: white;
            cursor: pointer;
            transition: all 0.3s;
            background: linear-gradient(135deg, #10b981, #059669);
            box-shadow: 0 10px 20px -5px rgba(16, 185, 129, 0.3);
            margin-top: 8px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -10px rgba(16, 185, 129, 0.4);
        }

        .info-box {
            padding: 16px;
            background: #fffbeb;
            border: 1px solid #fef3c7;
            border-radius: 16px;
            margin-bottom: 24px;
        }

        .info-box p {
            font-size: 12px;
            color: #92400e;
            line-height: 1.5;
        }

        .info-box a {
            font-weight: 700;
            color: #b45309;
            text-decoration: none;
        }

        .bottom-link {
            text-align: center;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #f1f5f9;
            font-size: 13px;
            color: #94a3b8;
        }

        .bottom-link a { color: #10b981; font-weight: 700; text-decoration: none; }

        /* DARK MODE */
        .dark .auth-container {
            background: radial-gradient(circle at 0% 0%, #064e3b 0%, transparent 50%),
                        radial-gradient(circle at 100% 100%, #1e3a8a 0%, transparent 50%);
        }
        .dark .glass-card { background: rgba(15, 23, 42, 0.7); border-color: rgba(255, 255, 255, 0.05); }
        .dark .card-header h2 { color: #f8fafc; }
        .dark .form-input { background: #0f172a; border-color: #1e293b; color: #f1f5f9; }
        .dark .role-badge { background: rgba(255, 255, 255, 0.05); color: #94a3b8; }
        .dark .bottom-link { border-top-color: #1e293b; }
        .dark .info-box { background: #1a1a1a; border-color: #333; }
        .dark .info-box p { color: #fbbf24; }
    </style>

    <div class="auth-container">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>

        <div class="glass-card">
            <div class="card-header">
                <h2>
                    @if($role === 'admin_dpmd')
                        🏛️ Akun Instansi
                    @else
                        🏘️ Akun Desa
                    @endif
                </h2>
                <p>Lengkapi data untuk membuat akun baru</p>
            </div>

            @if($role === 'admin_dpmd' && $dpmdAdminExists)
                <div class="info-box">
                    <p><strong>⚠️ Akun Sudah Ada</strong><br>
                        Sistem hanya mengizinkan satu akun Admin Dinas. Silakan hubungi admin utama.
                        <br><a href="{{ route('login') }}" class="mt-2 inline-block">Kembali ke Login</a>
                    </p>
                </div>
            @elseif($role === 'admin_desa' && $availableDesas->isEmpty())
                <div class="info-box">
                    <p><strong>⚠️ Kuota Penuh</strong><br>
                        Seluruh desa saat ini sudah memiliki admin terdaftar.
                        <br><a href="{{ route('login') }}" class="mt-2 inline-block">Kembali ke Login</a>
                    </p>
                </div>
            @else
                <form action="{{ route('register') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="role" value="{{ $role ?? 'admin_desa' }}">

                    <div class="role-badge">
                        <span>Level Akses:</span>
                        <strong style="color: {{ $role === 'admin_dpmd' ? '#f59e0b' : '#10b981' }}">
                            {{ $role === 'admin_dpmd' ? 'Admin Dinas' : 'Admin Desa' }}
                        </strong>
                    </div>

                    <!-- Name -->
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <div class="input-box">
                            <input type="text" name="name" class="form-input" required autofocus value="{{ old('name') }}"
                                placeholder="Contoh: Bpk. Albert">
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label>Alamat Email</label>
                        <div class="input-box">
                            <input type="email" name="email" class="form-input" required value="{{ old('email') }}"
                                placeholder="nama@email.com">
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>
                    </div>

                    <!-- Desa Selector (Only for Admin Desa) -->
                    @if($role !== 'admin_dpmd')
                        <div class="form-group">
                            <label>Pilih Desa</label>
                            <div class="input-box">
                                <select name="desa_id" class="form-input" required style="appearance: none; cursor: pointer;">
                                    <option value="">-- Pilih Desa Anda --</option>
                                    @foreach($availableDesas as $desa)
                                        <option value="{{ $desa->id }}" {{ old('desa_id') == $desa->id ? 'selected' : '' }}>
                                            {{ $desa->nama_desa }} ({{ $desa->kecamatan }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <x-input-error :messages="$errors->get('desa_id')" class="mt-1" />
                        </div>
                    @endif

                    <!-- Password -->
                    <div class="form-group">
                        <label>Kata Sandi Baru</label>
                        <div class="input-box">
                            <input type="password" name="password" class="form-input" required placeholder="••••••••">
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label>Ulangi Kata Sandi</label>
                        <div class="input-box">
                            <input type="password" name="password_confirmation" class="form-input" required
                                placeholder="••••••••">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                        </div>
                    </div>

                    <button type="submit" class="btn-submit"
                        style="background: {{ $role === 'admin_dpmd' ? 'linear-gradient(135deg, #f59e0b, #d97706)' : 'linear-gradient(135deg, #10b981, #059669)' }}; box-shadow: 0 10px 20px -5px {{ $role === 'admin_dpmd' ? 'rgba(245, 158, 11, 0.3)' : 'rgba(16, 185, 129, 0.3)' }};">
                        Buat Akun Sekarang ⚡
                    </button>
                </form>
            @endif

            <div class="bottom-link">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk Disini</a>
            </div>
        </div>
    </div>
</x-layouts.public>