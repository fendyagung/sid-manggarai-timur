<x-layouts.public title="Lupa Sandi - SID Manggarai Timur">
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lupa Sandi — SID Manggarai Timur</title>
        <link
            href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600;700;800&display=swap"
            rel="stylesheet">
        <style>
            :root {
                --emerald-500: #10b981;
                --emerald-600: #059669;
                --slate-900: #0f172a;
            }

            body {
                font-family: 'DM Sans', sans-serif;
                background-color: #f8fafc;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            .bg-canvas {
                position: fixed;
                inset: 0;
                z-index: 0;
                background: radial-gradient(circle at 0% 0%, #ecfdf5 0%, transparent 50%),
                    radial-gradient(circle at 100% 100%, #eff6ff 0%, transparent 50%);
            }

            .blob {
                position: absolute;
                border-radius: 50%;
                filter: blur(80px);
                opacity: 0.4;
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
                bottom: -50px;
                left: -50px;
                animation-delay: -5s;
            }

            @keyframes float {
                from {
                    transform: translate(0, 0) scale(1);
                }

                to {
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

            .card-header h3 {
                font-family: 'Playfair Display', serif;
                font-size: 28px;
                font-weight: 900;
                color: #0f172a;
                text-align: center;
                margin-bottom: 8px;
            }

            .card-header p {
                font-size: 14px;
                color: #64748b;
                text-align: center;
                margin-bottom: 32px;
                line-height: 1.6;
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

            .form-input {
                width: 100%;
                padding: 14px 16px 14px 44px;
                background: white;
                border: 1.5px solid #f1f5f9;
                border-radius: 16px;
                font-size: 14px;
                outline: none;
                transition: all 0.2s;
            }

            .form-input:focus {
                border-color: #10b981;
                box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
            }

            .btn-submit {
                width: 100%;
                padding: 16px;
                border: none;
                border-radius: 16px;
                font-size: 15px;
                font-weight: 800;
                color: white;
                background: linear-gradient(135deg, #10b981, #059669);
                box-shadow: 0 10px 20px -5px rgba(16, 185, 129, 0.3);
                cursor: pointer;
                transition: all 0.3s;
                margin-top: 12px;
            }

            .btn-submit:hover {
                transform: translateY(-2px);
                box-shadow: 0 15px 30px -10px rgba(16, 185, 129, 0.4);
            }

            .back-link {
                display: block;
                text-align: center;
                margin-top: 24px;
                font-size: 14px;
                font-weight: 700;
                color: #10b981;
                text-decoration: none;
            }

            .status-alert {
                background: #ecfdf5;
                border: 1px solid #10b981;
                color: #047857;
                padding: 16px;
                border-radius: 16px;
                font-size: 13px;
                font-weight: 600;
                margin-bottom: 24px;
            }

            .error-alert {
                background: #fef2f2;
                border: 1px solid #fee2e2;
                color: #991b1b;
                padding: 16px;
                border-radius: 16px;
                font-size: 13px;
                font-weight: 600;
                margin-bottom: 24px;
            }

            /* DARK MODE */
            .dark body {
                background-color: #020617;
            }

            .dark .bg-canvas {
                background: radial-gradient(circle at 0% 0%, #064e3b 0%, transparent 50%), radial-gradient(circle at 100% 100%, #1e3a8a 0%, transparent 50%);
            }

            .dark .glass-card {
                background: rgba(15, 23, 42, 0.7);
                border-color: rgba(255, 255, 255, 0.05);
            }

            .dark .card-header h3 {
                color: #f8fafc;
            }

            .dark .form-input {
                background: #0f172a;
                border-color: #1e293b;
                color: white;
            }
        </style>
    </head>

    <body class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-canvas">
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
        </div>

        <div class="glass-card">
            <div class="card-header">
                <div style="font-size: 40px; text-align: center; margin-bottom: 16px;">🔑</div>
                <h3>Lupa Sandi?</h3>
                <p>Jangan khawatir! Masukkan alamat email Anda dan kami akan mengirimkan tautan untuk mengatur ulang
                    kata sandi Anda.</p>
            </div>

            @if (session('status'))
                <div class="status-alert">
                    ✨ {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="error-alert">
                    ⚠️ {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Alamat Email</label>
                    <div style="position: relative;">
                        <span
                            style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #94a3b8;">📧</span>
                        <input type="email" name="email" class="form-input" placeholder="nama@email.com"
                            value="{{ old('email') }}" required>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    Kirim Tautan Atur Ulang
                </button>

                <a href="{{ route('login') }}" class="back-link">
                    ⬅️ Kembali ke Halaman Masuk
                </a>
            </form>
        </div>
    </body>

    </html>
</x-layouts.public>