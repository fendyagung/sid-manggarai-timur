<x-layouts.admin>
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
        <div class="p-8 bg-emerald-900 text-white flex justify-between items-center transition-colors">
            <div>
                <h1 class="text-2xl font-bold">Bank Data & Regulasi</h1>
                <p class="text-emerald-100/80">Kelola dokumen resmi, peraturan daerah, dan template laporan desa.</p>
            </div>
        </div>

        <div class="p-8">
            <!-- Upload Form -->
            <!-- Upload Form (DPMD Only) -->
            @if(Auth::user()->role === 'admin_dpmd')
                <div
                    class="mb-12 bg-slate-50 dark:bg-slate-800/50 p-6 rounded-2xl border border-slate-100 dark:border-slate-700 transition-colors">
                    <h3 class="font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        Unggah Dokumen Baru
                    </h3>
                    <form action="{{ route('dashboard.regulasi.store') }}" method="POST" enctype="multipart/form-data"
                        class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @csrf
                        <div class="md:col-span-2">
                            <label for="judul"
                                class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Judul
                                Dokumen</label>
                            <input type="text" name="judul" id="judul" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-emerald-500 outline-none dark:text-slate-100 transition-all"
                                placeholder="Contoh: Peraturan Bupati No. 12 Tahun 2025">
                        </div>

                        <div>
                            <label for="kategori"
                                class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Kategori</label>
                            <select name="kategori" id="kategori" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 outline-none bg-white dark:bg-slate-900 dark:text-slate-100 transition-all">
                                <option value="">Pilih Kategori...</option>
                                <option value="Peraturan Daerah">Peraturan Daerah (Perda/Perbup)</option>
                                <option value="Format Laporan">Format Laporan</option>
                                <option value="Template Surat">Template Surat Admin</option>
                                <option value="Materi Sosialisasi">Materi Sosialisasi</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div>
                            <label for="file"
                                class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">File
                                Dokumen</label>
                            <input type="file" name="file" id="file" required
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 outline-none text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 dark:bg-slate-900 dark:text-slate-300">
                            <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-2">PDF, DOCX, XLS, PPT, ZIP (Max
                                10MB)</p>
                        </div>

                        <div class="md:col-span-2">
                            <label for="deskripsi"
                                class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Deskripsi
                                Singkat
                                (Opsional)</label>
                            <textarea name="deskripsi" id="deskripsi" rows="2"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-emerald-500 outline-none dark:text-slate-100 transition-all"></textarea>
                        </div>

                        <div class="md:col-span-2 flex justify-end">
                            <button type="submit"
                                class="px-6 py-3 bg-[#166534] hover:bg-[#15803d] text-white font-bold rounded-xl shadow-lg shadow-emerald-500/20 transition-all">
                                Unggah Dokumen
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            <!-- Documents List -->
            <h3 class="font-bold text-slate-800 dark:text-white mb-6 text-lg transition-colors">Daftar Dokumen Tersedia
            </h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="text-sm text-slate-500 dark:text-slate-400 border-b border-slate-100 dark:border-slate-700 transition-colors">
                            <th class="py-4 font-semibold">Judul Dokumen</th>
                            <th class="py-4 font-semibold">Kategori</th>
                            <th class="py-4 font-semibold">Tanggal Upload</th>
                            <th class="py-4 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-slate-700 dark:text-slate-200">
                        @forelse($regulasis as $reg)
                            <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                                <td class="py-4 pr-4">
                                    <div class="font-bold text-slate-800 dark:text-slate-100 transition-colors">
                                        {{ $reg->judul }}</div>
                                    <div class="text-xs text-slate-400 dark:text-slate-500 transition-colors">
                                        {{ $reg->deskripsi }}</div>
                                </td>
                                <td class="py-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-bold 
                                                                    {{ $reg->kategori == 'Peraturan Daerah' ? 'bg-purple-100 text-purple-700' : '' }}
                                                                    {{ $reg->kategori == 'Format Laporan' ? 'bg-blue-100 text-blue-700' : '' }}
                                                                    {{ $reg->kategori == 'Template Surat' ? 'bg-amber-100 text-amber-700' : '' }}
                                                                    {{ $reg->kategori == 'Materi Sosialisasi' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                                                    {{ $reg->kategori == 'Lainnya' ? 'bg-slate-100 text-slate-700' : '' }}">
                                        {{ $reg->kategori }}
                                    </span>
                                </td>
                                <td class="py-4 text-slate-500">
                                    {{ $reg->created_at->format('d M Y') }}
                                </td>
                                <td class="py-4 text-right flex justify-end gap-2">
                                    <a href="{{ route('dashboard.regulasi.download', $reg->id) }}" target="_blank"
                                        class="p-2 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100 transition-colors"
                                        title="Download">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                        </svg>
                                    </a>
                                    @if(Auth::user()->role === 'admin_dpmd')
                                        <a href="{{ route('dashboard.regulasi.edit', $reg->id) }}"
                                            class="p-2 bg-amber-50 text-amber-600 rounded-lg hover:bg-amber-100 transition-colors"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('dashboard.regulasi.destroy', $reg->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus dokumen ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors"
                                                title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-slate-400 italic">
                                    Belum ada dokumen yang diunggah.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $regulasis->links() }}
            </div>
        </div>
    </div>
</x-layouts.admin>