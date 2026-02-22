<x-layouts.public>
    <div class="py-24 bg-white dark:bg-slate-900 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl overflow-hidden border border-slate-100 dark:border-slate-700">
                <div class="p-8 bg-[#2b529a] text-white">
                    <h1 class="text-2xl font-bold">Buat Laporan Baru</h1>
                    <p class="text-blue-100/80">Silakan isi formulir di bawah ini untuk mengirim laporan dari
                        {{ $desa->nama_desa }}.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3">
                    <!-- Guidance Sidebar -->
                    <div
                        class="p-8 bg-slate-50 dark:bg-slate-800/50 border-r border-slate-100 dark:border-slate-700 lg:col-span-1">
                        <h3 class="font-bold text-slate-800 dark:text-slate-100 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Panduan Mengisi
                        </h3>
                        <ul class="space-y-4 text-sm text-slate-600">
                            <li>
                                <strong class="text-slate-800 dark:text-slate-200 block mb-1">Judul Laporan</strong>
                                Gunakan nama yang spesifik, misal: <span
                                    class="italic text-slate-500 dark:text-slate-400">"Realisasi Dana Desa Tahap I
                                    2026"</span>.
                            </li>
                            <li>
                                <strong class="text-slate-800 dark:text-slate-200 block mb-1">Kategori</strong>
                                <span class="block">• <b class="text-slate-800 dark:text-slate-300">Keuangan:</b>
                                    APBDes/Realisasi</span>
                                <span class="block">• <b class="text-slate-800 dark:text-slate-300">Kependudukan:</b>
                                    Data Warga</span>
                                <span class="block">• <b class="text-slate-800 dark:text-slate-300">Kejadian:</b>
                                    Bencana/Event</span>
                            </li>
                            <li>
                                <strong class="text-slate-800 dark:text-slate-200 block mb-1">Lampiran</strong>
                                Pastikan file (PDF/Foto) terlihat jelas dan tidak lebih dari 10MB.
                            </li>
                            <li>
                                <strong class="text-slate-800 dark:text-slate-200 block mb-1">Keterangan</strong>
                                Berikan ringkasan isi laporan agar mudah dipahami DPMD.
                            </li>
                        </ul>
                    </div>

                    <!-- Form Section -->
                    <form action="{{ route('dashboard.laporan.simpan') }}" method="POST" enctype="multipart/form-data"
                        class="p-8 space-y-6 lg:col-span-2">
                        @csrf

                        <div>
                            <label for="judul"
                                class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Judul
                                Laporan</label>
                            <input type="text" name="judul" id="judul" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                                placeholder="Contoh: Laporan Realisasi Dana Desa Tahap 1">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="kategori"
                                    class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Kategori</label>
                                <select name="kategori" id="kategori" required
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                                    <option value="keuangan">Keuangan</option>
                                    <option value="penduduk">Kependudukan</option>
                                    <option value="kejadian">Kejadian Penting</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div>
                                <label for="tanggal_laporan"
                                    class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Tanggal
                                    Laporan</label>
                                <input type="date" name="tanggal_laporan" id="tanggal_laporan" required
                                    value="{{ date('Y-m-d') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none">
                            </div>
                        </div>

                        <div>
                            <label for="lampiran"
                                class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Lampiran
                                File
                                (PDF, Gambar, atau Dokumen)</label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-200 dark:border-slate-700 border-dashed rounded-xl hover:border-blue-400 transition-colors">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48" aria-hidden="true">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-slate-600">
                                        <label for="lampiran"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                            <span>Unggah file</span>
                                            <input id="lampiran" name="lampiran" type="file" class="sr-only">
                                        </label>
                                        <p class="pl-1">atau seret dan lepas</p>
                                    </div>
                                    <p class="text-xs text-slate-500">
                                        PDF, PNG, JPG, DOCX sampai 10MB
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="keterangan"
                                class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Keterangan /
                                Uraian Singkat</label>
                            <textarea name="keterangan" id="keterangan" rows="4"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                                placeholder="Berikan penjelasan singkat mengenai isi laporan ini..."></textarea>
                        </div>

                        <div class="flex items-center gap-4 pt-4">
                            <button type="submit"
                                class="px-8 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-500/30 transition-all transform hover:-translate-y-1">
                                Kirim Laporan
                            </button>
                            <a href="{{ route('dashboard') }}"
                                class="px-8 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-xl transition-all">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.public>