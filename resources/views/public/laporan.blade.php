<x-layouts.public>
    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 bg-emerald-900 border-b border-emerald-800 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <span
                    class="inline-block py-1 px-3 rounded-full bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 text-xs font-bold uppercase tracking-widest mb-6">
                    Transparansi Publik
                </span>
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Laporan & Rekapitulasi Desa</h1>
                <p class="text-emerald-100/70 text-lg max-w-2xl mx-auto mb-10">
                    Sistem Integritas Desa Manggarai Timur memberikan akses publik terhadap ringkasan kinerja dan
                    transparansi anggaran dari seluruh desa.
                </p>

                <!-- Quick Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-3xl mx-auto">
                    <div class="bg-white/5 border border-white/10 p-6 rounded-2xl backdrop-blur-sm">
                        <div class="text-3xl font-bold text-white mb-1">{{ $dpmdProfile->stat_total_desa ?? '159' }}
                        </div>
                        <div class="text-xs text-emerald-400 uppercase font-bold tracking-widest">Desa Terkoneksi</div>
                    </div>
                    <div class="bg-white/5 border border-white/10 p-6 rounded-2xl backdrop-blur-sm">
                        <div class="text-3xl font-bold text-white mb-1">
                            {{ $totalReports >= 1000 ? number_format($totalReports / 1000, 1) . 'rb' : $totalReports }}
                        </div>
                        <div class="text-xs text-emerald-400 uppercase font-bold tracking-widest">Laporan Masuk</div>
                    </div>
                    <div class="bg-white/5 border border-white/10 p-6 rounded-2xl backdrop-blur-sm">
                        <div class="text-3xl font-bold text-white mb-1">{{ $validityRate }}%</div>
                        <div class="text-xs text-emerald-400 uppercase font-bold tracking-widest">Tingkat Validitas
                        </div>
                    </div>
                    <div class="bg-white/5 border border-white/10 p-6 rounded-2xl backdrop-blur-sm">
                        <div class="text-3xl font-bold text-white mb-1">{{ $lastUpdate }}</div>
                        <div class="text-xs text-emerald-400 uppercase font-bold tracking-widest">Online Monitoring
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BG Elements -->
        <div
            class="absolute top-0 right-0 w-[500px] h-[500px] bg-emerald-500/10 rounded-full blur-[120px] -mr-64 -mt-64">
        </div>
        <div
            class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-blue-500/10 rounded-full blur-[100px] -ml-32 -mb-32">
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-24 bg-white dark:bg-slate-900 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Sidebar Info / Charts -->
                <div class="lg:col-span-1 space-y-8">
                    <div
                        class="bg-white dark:bg-slate-800 p-6 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-4">Status Laporan Masuk</h3>
                        <div class="relative h-64">
                            <canvas id="statusChart"></canvas>
                        </div>
                        <p class="text-xs text-center text-slate-400 mt-4">Distribusi status verifikasi laporan desa.
                        </p>
                    </div>

                    <div
                        class="bg-white dark:bg-slate-800 p-6 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-4">Kategori Pembangunan</h3>
                        <div class="relative h-64">
                            <canvas id="categoryChart"></canvas>
                        </div>
                        <p class="text-xs text-center text-slate-400 mt-4">Fokus bidang laporan yang diterima.</p>
                    </div>
                </div>

                <!-- Main Data View -->
                <div class="lg:col-span-2">
                    <div class="mb-10">
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Monitoring Real-Time</h2>
                        <p class="text-slate-500 dark:text-slate-400 italic">Alur data laporan desa yang masuk ke sistem
                            kami.</p>
                    </div>

                    <!-- Simplified Tables or Lists for Public -->
                    <div class="space-y-4">
                        @php
                            $recentReports = \App\Models\Laporan::with('desa')->where('status', 'diterima')->latest()->limit(5)->get();
                        @endphp

                        @forelse($recentReports as $rep)
                            <div
                                class="flex items-center justify-between p-6 bg-white dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50 rounded-2xl hover:shadow-lg transition-all group">
                                <div class="flex items-center gap-5">
                                    <div
                                        class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 group-hover:bg-emerald-100 group-hover:text-emerald-600 transition-colors">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-800 dark:text-white">{{ $rep->judul }}</h4>
                                        <p class="text-xs text-slate-400 dark:text-slate-500">oleh
                                            {{ $rep->desa->nama_desa }} •
                                            @if($rep->tanggal_laporan instanceof \Carbon\Carbon)
                                                {{ $rep->tanggal_laporan->format('d M Y') }}
                                            @else
                                                {{ date('d M Y', strtotime($rep->tanggal_laporan)) }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <span
                                    class="text-[10px] font-bold uppercase tracking-widest px-3 py-1 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 rounded-full border border-emerald-100 dark:border-emerald-800/50">
                                    TERVERIFIKASI
                                </span>
                            </div>
                        @empty
                            <div class="text-center py-20 bg-slate-50 rounded-3xl border border-dashed border-slate-200">
                                <p class="text-slate-400">Belum ada laporan publik yang diverifikasi hari ini.</p>
                            </div>
                        @endforelse
                    </div>

                    <div
                        class="mt-12 p-8 bg-blue-50 dark:bg-blue-900/20 rounded-3xl border border-blue-100 dark:border-blue-800/50 text-center">
                        <h4 class="font-bold text-blue-900 dark:text-blue-300 mb-2">Butuh Data Lebih Lengkap?</h4>
                        <p class="text-blue-700/70 dark:text-blue-400/70 text-sm mb-6">Masyarakat dapat mengajukan
                            permintaan informasi publik
                            secara resmi melalui portal Pejabat Pengelola Informasi dan Dokumentasi (PPID).</p>
                        <a href="#"
                            class="inline-flex items-center text-blue-700 dark:text-blue-400 font-bold hover:underline">
                            Kunjungi Portal PPID →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>