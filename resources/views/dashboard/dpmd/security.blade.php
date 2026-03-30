<x-layouts.admin title="Keamanan Akun">
    <div class="max-w-3xl mx-auto">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Keamanan Akun & Pemulihan</h1>
            <p class="text-slate-500 dark:text-slate-400">Kelola kunci cadangan untuk memulihkan akun jika Anda lupa kata sandi.</p>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-100 dark:border-slate-700">
                <h2 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-3">
                    <span class="p-2 bg-amber-100 dark:bg-amber-900/30 rounded-xl text-xl">🔑</span>
                    Kode Pemulihan Darurat (Recovery Codes)
                </h2>
                <div class="mt-4 p-4 bg-amber-50 dark:bg-amber-900/20 border-l-4 border-amber-400 rounded-r-xl">
                    <p class="text-sm text-amber-800 dark:text-amber-300 leading-relaxed">
                        <strong>PENTING:</strong> Kode ini adalah satu-satunya cara untuk masuk ke akun Anda jika Anda lupa kata sandi. 
                        Simpan kode ini di tempat yang sangat aman (misalnya dicetak atau disimpan di brankas kantor).
                    </p>
                </div>
            </div>

            <div class="p-8">
                @if(empty($user->recovery_codes))
                    <div class="text-center py-12">
                        <div class="w-20 h-20 bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center text-4xl mx-auto mb-4">🔓</div>
                        <h3 class="text-slate-800 dark:text-white font-bold">Belum Ada Kode Pemulihan</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm mt-2 max-w-sm mx-auto">
                            Anda belum men-generate kode pemulihan. Segera buat kode sekarang untuk keamanan akun Anda.
                        </p>
                        <form action="{{ route('dashboard.dpmd.generate-codes') }}" method="POST" class="mt-6">
                            @csrf
                            <button type="submit" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-2xl shadow-lg shadow-emerald-500/20 transition-all">
                                Buat Kode Pemulihan Baru
                            </button>
                        </form>
                    </div>
                @else
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        @foreach($user->recovery_codes as $code)
                            <div class="p-4 bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-700 rounded-2xl font-mono text-center text-lg font-bold text-slate-700 dark:text-slate-200 tracking-wider">
                                {{ $code }}
                            </div>
                        @endforeach
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 items-center justify-between pt-6 border-t border-slate-100 dark:border-slate-700">
                        <div class="text-sm text-slate-500 dark:text-slate-400">
                            Cetak atau catat 10 kode di atas. <br>
                            <span class="text-xs italic">*Setiap kode hanya bisa digunakan sekali.</span>
                        </div>
                        <div class="flex gap-3">
                            <button onclick="window.print()" class="px-5 py-2.5 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold rounded-xl hover:bg-slate-200 transition-all">
                                🖨️ Cetak Kode
                            </button>
                            <form action="{{ route('dashboard.dpmd.generate-codes') }}" method="POST" onsubmit="return confirm('Membuat kode baru akan menghapus semua kode lama Anda. Lanjutkan?')">
                                @csrf
                                <button type="submit" class="px-5 py-2.5 bg-amber-600 hover:bg-amber-700 text-white font-bold rounded-xl shadow-lg shadow-amber-500/20 transition-all">
                                    🔄 Buat Ulang Kode
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        @media print {
            /* Sembunyikan elemen navigasi dan sidebar */
            .sidebar, .topbar, .mobile-toggle, .no-print, .sidebar-overlay, .pattern-strip, .alert, .notif-btn, .user-chip {
                display: none !important;
            }

            /* Reset layout utama agar memenuhi halaman */
            .main {
                margin-left: 0 !important;
                padding: 0 !important;
                background: white !important;
            }

            .content {
                padding: 0 !important;
                margin: 0 !important;
            }

            .max-w-3xl {
                max-width: 100% !important;
                margin: 0 !important;
            }

            /* Sembunyikan header asli dashboard */
            .mb-8, .bg-white.dark\:bg-slate-800 {
                display: none !important;
            }

            /* Tampilkan area khusus cetak */
            #print-area {
                display: block !important;
                visibility: visible !important;
                width: 100% !important;
            }

            .print-container {
                max-width: 100%;
                margin: 0;
                padding: 20px;
                background: white !important;
            }

            .print-grid {
                display: grid !important;
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 20px !important;
            }

            .code-box {
                padding: 15px;
                border: 2px solid #000;
                font-family: 'Courier New', Courier, monospace;
                font-size: 18px;
                font-weight: bold;
                text-align: center;
                border-radius: 8px;
            }

            body {
                background: white !important;
            }
        }

        /* Tampilan di layar (sembunyikan print-area) */
        #print-area { display: none; }
    </style>

    <div id="print-area">
        <div class="print-container">
            <div style="text-align: center; border-bottom: 3px double #000; padding-bottom: 15px; margin-bottom: 25px;">
                <h1 style="font-size: 22px; margin: 0; font-family: serif; text-transform: uppercase;">Kode Pemulihan Darurat (Super Admin)</h1>
                <p style="font-size: 14px; margin: 5px 0 0;">Sistem Informasi Desa - Kabupaten Manggarai Timur</p>
            </div>
            
            <div style="border: 1px solid #000; padding: 15px; margin-bottom: 25px; background: #f0f0f0;">
                <p style="font-size: 12px; margin: 0; line-height: 1.5;">
                    <strong>INSTRUKSI PERINGATAN:</strong> Lembar ini adalah kunci cadangan akun Anda. Simpan di tempat fisik yang aman (Brankas atau Buku Agenda Utama). Jangan pernah membagikan kode ini kepada siapa pun. Setiap kode hanya berlaku untuk satu kali penggunaan di menu "Pintu Darurat" pada halaman login.
                </p>
            </div>

            <div class="print-grid">
                @if(!empty($user->recovery_codes))
                    @foreach($user->recovery_codes as $code)
                        <div class="code-box">
                            {{ $code }}
                        </div>
                    @endforeach
                @endif
            </div>

            <div style="margin-top: 40px; padding-top: 15px; border-top: 1px solid #000; text-align: center; font-size: 10px;">
                Dicetak oleh: <strong>{{ $user->name }}</strong> | Tanggal: {{ now()->isoFormat('D MMMM Y, HH:mm') }}
            </div>
        </div>
    </div>
</x-layouts.admin>
