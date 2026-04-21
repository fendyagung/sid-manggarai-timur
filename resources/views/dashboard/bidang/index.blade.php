<x-layouts.admin title="{{ $title }}">
    <div class="space-y-8">
        <!-- Header Section -->
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-700 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/5 rounded-full -mr-32 -mt-32 blur-3xl"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/30 rounded-2xl flex items-center justify-center text-2xl">
                        @if($bidang === 'sekretariat') 📂 @elseif($bidang === 'pemerintahan') 🏢 @elseif($bidang === 'pemberdayaan') 🤝 @else 💰 @endif
                    </div>
                    <div>
                        <h2 class="text-3xl font-black text-slate-800 dark:text-white">{{ $title }}</h2>
                        <p class="text-slate-500 dark:text-slate-400">Manajemen laporan kegiatan internal dan pengarsipan berkas bidang.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left: Progres & Program Kegiatan -->
            <div class="space-y-6">
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-xl border border-slate-100 dark:border-slate-700">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2">
                            <span class="text-xl">🚀</span> Progres & Program
                        </h3>
                        <button onclick="toggleForm('form-kegiatan')" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl transition-all shadow-lg shadow-emerald-500/20">
                            + Input Baru
                        </button>
                    </div>

                    <!-- Form Laporan Kegiatan -->
                    <div id="form-kegiatan" class="hidden mb-8 p-6 bg-slate-50 dark:bg-slate-900/50 rounded-2xl border border-dashed border-slate-200 dark:border-slate-700">
                        <form action="{{ route('dashboard.bidang.store-kegiatan') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <input type="hidden" name="bidang" value="{{ $bidang }}">
                            
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1 ml-1">Nama Kegiatan</label>
                                <input type="text" name="judul" required class="w-full px-4 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all dark:text-white" placeholder="Contoh: Rapat Koordinasi Mingguan">
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1 ml-1">Keterangan / Notulensi</label>
                                <textarea name="keterangan" rows="3" class="w-full px-4 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all dark:text-white" placeholder="Ringkasan poin hasil kegiatan..."></textarea>
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1 ml-1">Lampiran (Opsional)</label>
                                <input type="file" name="file" class="w-full px-4 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs">
                            </div>

                            <div class="flex gap-2">
                                <button type="submit" class="flex-1 py-3 bg-emerald-600 text-white font-black rounded-xl hover:bg-emerald-700 transition-all">Simpan Laporan</button>
                                <button type="button" onclick="toggleForm('form-kegiatan')" class="px-6 py-3 bg-slate-200 dark:bg-slate-700 text-slate-600 dark:text-slate-300 font-bold rounded-xl">Batal</button>
                            </div>
                        </form>
                    </div>

                    <!-- List Laporan Kegiatan -->
                    <div class="space-y-4">
                        @forelse($kegiatans as $keg)
                            <div class="p-4 bg-slate-50 dark:bg-slate-900/30 rounded-2xl border border-slate-100 dark:border-slate-700 flex items-start justify-between group">
                                <div class="flex gap-4">
                                    <div class="w-10 h-10 bg-white dark:bg-slate-800 rounded-xl flex items-center justify-center shadow-sm">🗓️</div>
                                    <div>
                                        <h4 class="font-bold text-slate-800 dark:text-white text-sm">{{ $keg->judul }}</h4>
                                        <div class="flex items-center gap-3 mt-1">
                                            <span class="text-[10px] font-bold text-slate-400">{{ $keg->created_at->isoFormat('D MMMM Y') }}</span>
                                            @if($keg->file_path)
                                                <a href="{{ asset('storage/' . $keg->file_path) }}" target="_blank" class="text-[10px] font-bold text-emerald-600 hover:underline">📄 Lihat Lampiran</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('dashboard.bidang.destroy-kegiatan', $keg->id) }}" method="POST" onsubmit="return confirm('Hapus laporan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-500 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/40 transition-colors" title="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <span class="text-4xl">📭</span>
                                <p class="text-slate-400 mt-4 font-medium">Belum ada laporan kegiatan.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right: Dokumen Bidang & Arsip -->
            <div class="space-y-6">
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-xl border border-slate-100 dark:border-slate-700">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2">
                            <span class="text-xl">🗄️</span> Dokumen Bidang & Arsip
                        </h3>
                        <button onclick="toggleForm('form-arsip')" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold rounded-xl transition-all shadow-lg shadow-amber-500/20">
                            + Unggah Dokumen
                        </button>
                    </div>

                    <!-- Form Arsip -->
                    <div id="form-arsip" class="hidden mb-8 p-6 bg-amber-50/30 dark:bg-amber-900/10 rounded-2xl border border-dashed border-amber-200 dark:border-amber-800">
                        <form action="{{ route('dashboard.bidang.store-arsip') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <input type="hidden" name="bidang" value="{{ $bidang }}">
                            
                            <div>
                                <label class="block text-[10px] font-black text-amber-600 uppercase tracking-widest mb-1 ml-1">Nama Berkas / Dokumen</label>
                                <input type="text" name="judul" required class="w-full px-4 py-3 bg-white dark:bg-slate-800 border border-amber-100 dark:border-amber-900/50 rounded-xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all dark:text-white" placeholder="Contoh: SK Pengurus Bidang 2026">
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-amber-600 uppercase tracking-widest mb-1 ml-1">Pilih File</label>
                                <input type="file" name="file" required class="w-full px-4 py-3 bg-white dark:bg-slate-800 border border-amber-100 dark:border-amber-900/50 rounded-xl text-xs">
                            </div>

                            <div class="flex gap-2">
                                <button type="submit" class="flex-1 py-3 bg-amber-600 text-white font-black rounded-xl hover:bg-amber-700 transition-all">Upload Berkas</button>
                                <button type="button" onclick="toggleForm('form-arsip')" class="px-6 py-3 bg-slate-200 dark:bg-slate-700 text-slate-600 dark:text-slate-300 font-bold rounded-xl">Batal</button>
                            </div>
                        </form>
                    </div>

                    <!-- List Arsip -->
                    <div class="grid grid-cols-1 gap-4">
                        @forelse($arsips as $arsip)
                            <div class="p-4 bg-slate-50 dark:bg-slate-900/30 rounded-2xl border border-slate-100 dark:border-slate-700 flex items-center justify-between group">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-white dark:bg-slate-800 rounded-xl flex items-center justify-center shadow-sm text-xl">
                                        @php
                                            $ext = pathinfo($arsip->file_path, PATHINFO_EXTENSION);
                                            $icon = '📄';
                                            if(in_array($ext, ['pdf'])) $icon = '📕';
                                            if(in_array($ext, ['doc', 'docx'])) $icon = '📘';
                                            if(in_array($ext, ['jpg', 'jpeg', 'png'])) $icon = '🖼️';
                                        @endphp
                                        {{ $icon }}
                                    </div>
                                    <div class="min-w-0">
                                        <h4 class="font-bold text-slate-800 dark:text-white text-sm truncate">{{ $arsip->judul }}</h4>
                                        <div class="flex items-center gap-3 mt-1">
                                            <span class="text-[10px] font-bold text-slate-400">{{ strtoupper($ext) }} • {{ $arsip->created_at->diffForHumans() }}</span>
                                            <a href="{{ asset('storage/' . $arsip->file_path) }}" download class="text-[10px] font-bold text-emerald-600 hover:underline">Download</a>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('dashboard.bidang.destroy-arsip', $arsip->id) }}" method="POST" onsubmit="return confirm('Hapus arsip ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-500 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/40 transition-colors" title="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <span class="text-4xl">📂</span>
                                <p class="text-slate-400 mt-4 font-medium">Belum ada arsip berkas.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        <div class="card animate-fade-in" style="animation-delay: 0.2s">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2 text-lg">
                        <span class="text-xl">📊</span> Laporan-Laporan (Regulasi & Surat)
                    </h3>
                    <p class="text-xs text-slate-500">Daftar laporan, peraturan, SK, dan dokumen resmi {{ $bidang }}.</p>
                </div>
                <a href="{{ route('dashboard.regulasi.index', ['bidang' => $bidang]) }}" class="px-5 py-2.5 bg-slate-100 dark:bg-slate-700 hover:bg-emerald-50 dark:hover:bg-emerald-900/30 text-slate-600 dark:text-slate-300 text-xs font-bold rounded-xl transition-all flex items-center gap-2">
                    Kelola Semua ↗️
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($regulasis as $reg)
                    <div class="p-4 bg-white dark:bg-slate-900/20 border border-slate-100 dark:border-slate-800 rounded-2xl flex items-center justify-between hover:border-emerald-200 dark:hover:border-emerald-900 transition-all group">
                        <div class="flex items-center gap-4 min-w-0">
                            <div class="w-10 h-10 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl flex items-center justify-center text-emerald-600">
                                📜
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-bold text-slate-800 dark:text-white text-sm truncate">{{ $reg->judul }}</h4>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">{{ $reg->kategori }}</span>
                            </div>
                        </div>
                        <a href="{{ route('dashboard.regulasi.download', $reg->id) }}" class="w-8 h-8 flex items-center justify-center bg-slate-50 dark:bg-slate-800 rounded-lg hover:bg-emerald-500 hover:text-white transition-all">
                            📥
                        </a>
                    </div>
                @empty
                    <div class="col-span-full py-10 text-center border-2 border-dashed border-slate-100 dark:border-slate-800 rounded-3xl">
                        <p class="text-slate-400 text-sm italic">Belum ada regulasi resmi yang diunggah untuk bidang ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        function toggleForm(id) {
            const form = document.getElementById(id);
            form.classList.toggle('hidden');
        }
    </script>
</x-layouts.admin>
