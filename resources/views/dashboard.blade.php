@php
    $user = Auth::user();
    $isDesa = $user->role === 'admin_desa';
    $isDpmd = $user->role === 'admin_dpmd';
@endphp

<x-layouts.admin>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease both;
        }

        /* Global Dashboard Styles */
        .welcome-banner {
            border-radius: 16px;
            padding: 26px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .stat-card {
            background: var(--putih);
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.04);
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        .sc-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .ic-g {
            background: rgba(22, 163, 74, 0.1);
        }

        .ic-e {
            background: rgba(217, 119, 6, 0.1);
        }

        .ic-b {
            background: rgba(30, 64, 175, 0.1);
        }

        .ic-r {
            background: rgba(153, 27, 27, 0.1);
        }

        .ic-p {
            background: rgba(107, 33, 168, 0.1);
        }

        .sc-num {
            font-family: 'Playfair Display', serif;
            font-size: 30px;
            font-weight: 700;
            line-height: 1;
        }

        .card {
            background: var(--putih);
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.04);
        }

        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        /* DPMD Specific */
        .verif-item {
            padding: 14px 16px;
            border: 1px solid var(--abu2);
            border-radius: 11px;
            margin-bottom: 10px;
            transition: all .2s;
        }

        .verif-item:hover {
            border-color: var(--emas-muda);
            background: #fdf9f3;
        }

        .btn-verif {
            padding: 6px 14px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: all .2s;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 9px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
        }

        .sp-e {
            background: #fffbeb;
            color: #d97706;
        }

        .sp-g {
            background: #ecfdf5;
            color: #166534;
        }

        .sp-r {
            background: #fce8e8;
            color: #c82222;
        }

        .sp-b {
            background: #e8f0fe;
            color: #1e64c8;
        }

        /* DARK MODE - DASHBOARD SPECIFIC */
        .dark .ic-g {
            background: rgba(16, 185, 129, 0.2);
        }

        .dark .ic-e {
            background: rgba(245, 158, 11, 0.2);
        }

        .dark .ic-b {
            background: rgba(59, 130, 246, 0.2);
        }

        .dark .ic-r {
            background: rgba(239, 68, 68, 0.2);
        }

        .dark .ic-p {
            background: rgba(168, 85, 247, 0.2);
        }

        .dark .verif-item {
            border-color: rgba(255, 255, 255, 0.1);
        }

        .dark .verif-item:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: var(--emas);
        }

        .dark .sp-e {
            background: rgba(217, 119, 6, 0.2);
            color: #f59e0b;
        }

        .dark .sp-g {
            background: rgba(22, 163, 74, 0.2);
            color: #34d399;
        }

        .dark .sp-r {
            background: rgba(153, 27, 27, 0.2);
            color: #f87171;
        }

        .dark .donut::after {
            background: #064e3b;
            color: var(--teks);
        }

        .dark .welcome-banner {
            background: linear-gradient(135deg, #052e16 0%, #064e3b 60%, #14532d 100%) !important;
            border-color: rgba(255, 255, 255, 0.05);
        }

        /* Donut Chart Simulation */
        .donut {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            position: relative;
        }

        .donut::after {
            content: attr(data-center);
            position: absolute;
            inset: 20px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: 700;
            font-family: 'Playfair Display', serif;
        }

        /* Desa Specific */
        .wisata-mini {
            background: linear-gradient(135deg, #166534, #10b981);
            border-radius: 12px;
            padding: 16px;
            color: white;
            display: flex;
            flex-direction: column;
            gap: 6px;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
            text-decoration: none;
        }

        .wisata-mini:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 28px rgba(26, 107, 58, 0.3);
        }

        .wisata-mini::before {
            content: '🌿';
            position: absolute;
            right: 12px;
            bottom: 8px;
            font-size: 42px;
            opacity: .2;
        }
    </style>

    @if($isDesa)
        <!-- DESA VIEW (Already implemented, kept for consistency) -->
        <div class="welcome-banner mb-8 animate-fade-in"
            style="background: linear-gradient(135deg, #022c22 0%, #064e3b 100%);">
            <div class="wb-text">
                <h2 class="text-2xl font-black font-serif mb-1">Selamat Datang, {{ $data['desa_nama'] ?? 'Admin Desa' }}! 👋
                </h2>
                <p class="text-sm text-white/80 max-w-xl">Pantau perkembangan desa Anda melalui dashboard terpadu. Pastikan
                    data profil dan potensi desa selalu diperbarui.</p>
                <div class="flex flex-wrap gap-4 mt-6">
                    <a href="{{ route('dashboard.laporan.buat') }}"
                        class="px-6 py-3 bg-emerald-500 text-white font-bold rounded-xl text-sm hover:bg-emerald-600 transition-all shadow-lg shadow-emerald-900/20 flex items-center gap-2">
                        <span>📝</span> Buat Laporan Baru
                    </a>
                    <a href="{{ route('dashboard.desa.edit') }}"
                        class="px-6 py-3 bg-white/10 border border-white/20 text-white font-bold rounded-xl text-sm hover:bg-white/20 transition-all flex items-center gap-2">
                        <span>⚙️</span> Edit Profil Desa
                    </a>
                </div>
            </div>
            <div class="hidden md:block text-7xl opacity-40">🏘️</div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="stat-card animate-fade-in">
                <div class="sc-num">{{ $data['total_laporan'] }}</div>
                <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">Laporan Dikirim</div>
            </div>
            <div class="stat-card animate-fade-in" style="animation-delay: 0.1s">
                <div class="sc-num">{{ $data['laporan_diterima'] }}</div>
                <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">Laporan Disetujui</div>
            </div>
            <div class="stat-card animate-fade-in" style="animation-delay: 0.2s">
                <div class="sc-num">{{ \App\Models\Potensi::where('desa_id', $data['desa_id'] ?? 0)->count() }}</div>
                <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">Potensi Desa</div>
            </div>
            <div class="stat-card animate-fade-in" style="animation-delay: 0.3s">
                <div class="flex items-center gap-2">
                    <div class="h-3 w-3 bg-emerald-500 rounded-full animate-pulse"></div>
                    <div class="sc-num !text-2xl">Online</div>
                </div>
                <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">Sistem Aktif</div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <div class="card transition-all hover:shadow-lg">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <div class="card-title">📋 Laporan Terbaru</div>
                        <p class="text-xs text-slate-500">Status 5 laporan terakhir</p>
                    </div><a href="{{ route('dashboard.dokumen.index') }}"
                        class="text-xs font-bold text-emerald-700 hover:text-emerald-800 hover:underline">Semua →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <tbody class="divide-y divide-slate-100">@forelse($data['recent_laporans'] as $l)<tr>
                            <td class="py-3 font-medium">{{ \Illuminate\Support\Str::limit($l->judul, 25) }}</td>
                            <td class="py-3 text-xs text-slate-500">{{ ucfirst($l->kategori) }}</td>
                            <td class="py-3 text-right"><span
                                    class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $l->status === 'diterima' ? 'bg-emerald-100 text-emerald-700' : 'bg-orange-100 text-orange-700' }}">{{ strtoupper($l->status) }}</span>
                            </td>
                        </tr>@empty<tr>
                                <td colspan="3" class="py-10 text-center italic text-slate-400">Belum ada laporan.</td>
                            </tr>@endforelse</tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-title mb-6">🏞️ Potensi Desa</div>
                <div class="flex flex-col gap-3">
                    @forelse($data['potensis'] as $p)
                        <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-100 flex justify-between items-center">
                            <div>
                                <h4 class="font-bold text-emerald-900 text-sm">{{ $p->nama_potensi }}</h4>
                                <p class="text-[10px] text-emerald-700">{{ \Illuminate\Support\Str::limit($p->deskripsi, 40) }}
                                </p>
                            </div>
                            <span class="text-xl">🏞️</span>
                        </div>
                    @empty
                        <!-- No potentials -->
                    @endforelse
                    <a href="{{ route('dashboard.potensi.index') }}"
                        class="p-4 border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-xl flex items-center justify-center gap-2 text-slate-500 dark:text-slate-400 hover:border-emerald-500 hover:text-emerald-600 transition-all">
                        <span class="text-lg">+</span> <span class="text-xs font-bold">Tambah Potensi</span>
                    </a>
                </div>
            </div>
        </div>

    @else
        <!-- DPMD VIEW (New High-Fidelity Mockup) -->
        <div class="welcome-banner mb-8 animate-fade-in"
            style="background: linear-gradient(135deg, #022c22 0%, #064e3b 100%);">
            <div class="wb-text">
                <h2 class="text-2xl font-black font-serif mb-1">Selamat Datang, Admin DMPD! 🏛️</h2>
                <p class="text-sm text-white/70 max-w-xl">Saat ini terdapat <strong
                        style="color:var(--emas-muda)">{{ $data['laporan_pending'] }} laporan menunggu verifikasi</strong>.
                    Segera tindaklanjuti agar data kabupaten tetap akurat dan terkini.</p>
                <div class="flex flex-wrap gap-4 mt-6">
                    <a href="#verif-queue"
                        class="px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-600 text-white font-bold rounded-xl text-sm hover:shadow-xl transition-all shadow-lg shadow-amber-900/20 flex items-center gap-2">
                        <span>✅</span> Verifikasi Laporan
                    </a>
                    <a href="{{ route('dashboard.regulasi.index') }}"
                        class="px-6 py-3 bg-white/10 border border-white/20 text-white font-bold rounded-xl text-sm hover:bg-white/20 transition-all flex items-center gap-2">
                        <span>📁</span> Kelola Regulasi
                    </a>
                </div>
            </div>
            <div class="hidden md:block text-7xl opacity-40">🏛️</div>
        </div>

        @if($data['desa_belum_lapor'] > 0)
            <div
                class="mb-6 p-4 bg-[#fff9e6] dark:bg-amber-900/20 border border-[#f5e0a0] dark:border-amber-800/50 rounded-xl flex items-start gap-3 animate-fade-in">
                <span class="text-xl">⚠️</span>
                <div>
                    <h4 class="text-xs font-black text-[#8a6600] dark:text-amber-500 uppercase tracking-wider">Peringatan
                        Kepatuhan</h4>
                    <p class="text-xs text-[#8a6600]/80 dark:text-amber-400/80">{{ $data['desa_belum_lapor'] }} Desa belum
                        mengirimkan laporan periode
                        bulan ini. Kirim notifikasi pengingat via broadcast.</p>
                </div>
            </div>
        @endif

        <!-- STATS DPMD -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
            <div class="stat-card animate-fade-in" style="animation-delay: 0.1s">
                <div class="sc-icon ic-b mb-3">🏘️</div>
                <div class="sc-num">{{ $data['total_desa'] }}</div>
                <div class="text-[11px] text-slate-700 dark:text-slate-300 uppercase font-bold tracking-tight mt-1">Total
                    Wilayah</div>
            </div>
            <div class="stat-card animate-fade-in" style="animation-delay: 0.2s">
                <div class="sc-icon ic-g mb-3">✅</div>
                <div class="sc-num text-emerald-600">&nbsp;</div>
                <div class="text-[11px] text-slate-700 dark:text-slate-300 uppercase font-bold tracking-tight mt-1">Laporan
                    Selesai</div>
            </div>
            <div class="stat-card animate-fade-in" style="animation-delay: 0.3s">
                <div class="sc-icon ic-e mb-3">⏳</div>
                <div class="sc-num text-amber-600">{{ $data['laporan_pending'] }}</div>
                <div class="text-[11px] text-slate-700 dark:text-slate-300 uppercase font-bold tracking-tight mt-1">Menunggu
                    Verifikasi</div>
            </div>
            <div class="stat-card animate-fade-in" style="animation-delay: 0.4s">
                <div class="sc-icon ic-r mb-3">❗</div>
                <div class="sc-num text-red-600">{{ $data['desa_belum_lapor'] }}</div>
                <div class="text-[11px] text-slate-700 dark:text-slate-300 uppercase font-bold tracking-tight mt-1">Belum
                    Melapor</div>
            </div>
            <div class="stat-card animate-fade-in" style="animation-delay: 0.5s">
                <div class="sc-icon ic-p mb-3">🏞️</div>
                <div class="sc-num text-indigo-600">{{ $data['desa_wisata_count'] }}</div>
                <div class="text-[11px] text-slate-700 dark:text-slate-300 uppercase font-bold tracking-tight mt-1">Desa
                    Wisata</div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- VERIFICATION QUEUE -->
            <div id="verif-queue" class="lg:col-span-2 card">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <div class="card-title">✅ Antrian Verifikasi</div>
                        <p class="text-xs text-slate-600 dark:text-slate-400">Tinjau laporan terbaru yang dikirim oleh desa
                        </p>
                    </div>
                    <span class="status-pill sp-e">{{ $data['laporan_pending'] }} Tertunda</span>
                </div>
                <div class="flex flex-col gap-3">
                    @forelse($data['pending_verification'] as $lp)
                        <div class="verif-item">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h4 class="text-sm font-bold text-slate-800 dark:text-slate-100">
                                        {{ optional($lp->desa)->nama_desa ?? 'Desa Tidak Diketahui' }}</h4>
                                    <p class="text-[10px] text-slate-500 dark:text-slate-400">📍
                                        {{ optional($lp->desa)->kecamatan ?? '-' }} •
                                        {{ $lp->created_at->format('d M H:i') }}
                                    </p>
                                </div>
                                <span class="status-pill sp-b">{{ strtoupper($lp->kategori) }}</span>
                            </div>
                            <p class="text-xs font-medium text-slate-600 dark:text-slate-300 mb-3">{{ $lp->judul }}</p>
                            <div class="flex gap-2">
                                <a href="{{ route('dashboard.laporan.detail', $lp->id) }}"
                                    class="btn-verif bg-[#1a6b3a] text-white">✅ Periksa</a>
                                <form action="{{ route('dashboard.laporan.approve', $lp->id) }}" method="POST" class="inline">
                                    @csrf<button class="btn-verif bg-emerald-100 text-emerald-700">Setujui</button></form>
                            </div>
                        </div>
                    @empty
                        <div class="py-10 text-center italic text-slate-400">Tidak ada antrian verifikasi.</div>
                    @endforelse
                </div>
            </div>

            <!-- COMPLIANCE CHART -->
            <div class="card flex flex-col items-center">
                <div class="w-full">
                    <div class="card-title">📊 Status Kepatuhan</div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-6">Periode Bulan Ini</p>
                </div>

                @php
                    $total = $data['total_desa'] ?: 1;
                    $selesai = round(($data['total_desa'] - $data['desa_belum_lapor']) / $total * 100);
                    $belum = 100 - $selesai;
                @endphp

                <div class="donut mb-6" data-center="{{ $selesai }}%"
                    style="background: conic-gradient(var(--hijau) 0% {{ $selesai }}%, #fce8e8 {{ $selesai }}% 100%);">
                </div>

                <div class="w-full flex flex-col gap-3">
                    <div class="flex justify-between items-center text-xs">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-sm bg-[#1a6b3a]"></div><span>Sudah Melapor</span>
                        </div>
                        <span class="font-bold">{{ $data['total_desa'] - $data['desa_belum_lapor'] }} Desa</span>
                    </div>
                    <div class="flex justify-between items-center text-xs">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-sm bg-[#fce8e8]"></div><span>Belum Melapor</span>
                        </div>
                        <span class="font-bold text-red-600">{{ $data['desa_belum_lapor'] }} Desa</span>
                    </div>

                    <div class="mt-4 pt-4 border-top border-slate-100">
                        <div class="flex justify-between text-[11px] mb-1"><span>Target Kepatuhan</span><span>90%</span>
                        </div>
                        <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-amber-400" style="width:{{ $selesai }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- VILLAGE MONITORING TABLE -->
        <div class="card animate-fade-in" style="animation-delay: 0.6s">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <div class="card-title">🏘️ Monitoring Data Desa</div>
                    <p class="text-xs text-slate-500">Pantau keaktifan pelaporan seluruh wilayah</p>
                </div>
                <div class="relative w-full md:w-72">
                    <input type="text" id="desaSearch" placeholder="Cari nama desa..."
                        class="w-full text-xs border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 rounded-xl py-2.5 pl-10 pr-4 focus:ring-2 focus:ring-[#c9900a]/20 outline-none dark:text-slate-200">
                    <span class="absolute left-4 top-2.5 opacity-50">🔍</span>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 text-slate-600 font-bold uppercase text-[10px] tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Wilayah</th>
                            <th class="px-6 py-4">Kecamatan</th>
                            <th class="px-6 py-4">Laporan</th>
                            <th class="px-6 py-4">Status Wisata</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($data['desas'] as $d)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 font-bold text-slate-800">{{ $d->nama_desa }}</td>
                                <td class="px-6 py-4 text-slate-500">{{ $d->kecamatan }}</td>
                                <td class="px-6 py-4"><span
                                        class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-[10px] font-black">{{ $d->laporans_count ?? 0 }}
                                        LAPORAN</span></td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('dashboard.desa.toggle-wisata', $d->id) }}" method="POST">@csrf
                                        <button
                                            class="text-[10px] font-black px-3 py-1 rounded-full border {{ $d->is_desa_wisata ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-slate-50 text-slate-400 border-slate-100' }}">
                                            {{ $d->is_desa_wisata ? 'WISATA: AKTIF' : 'NON WISATA' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 text-right"><a href="{{ route('dashboard.desa.detail', $d->id) }}"
                                        class="text-[#c9900a] font-bold text-xs hover:underline">Monitor →</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <script>
        document.getElementById('desaSearch')?.addEventListener('input', function (e) {
            const val = e.target.value.toLowerCase();
            document.querySelectorAll('tbody tr').forEach(r => {
                r.style.display = r.textContent.toLowerCase().includes(val) ? '' : 'none';
            });
        });
    </script>
</x-layouts.admin>