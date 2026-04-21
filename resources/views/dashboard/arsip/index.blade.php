<x-layouts.admin>
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
        <div class="p-8 bg-slate-900 text-white flex justify-between items-center transition-colors">
            <div>
                <h1 class="text-2xl font-bold">Arsip Dinas</h1>
                <p class="text-slate-300">Simpan berkas-berkas penting Anda di sini. Berkas ini bersifat privat dan hanya dapat diakses oleh Anda.</p>
            </div>
        </div>

        <div class="p-8">
            <!-- Upload Form -->
            <div class="mb-12 bg-slate-50 dark:bg-slate-800/50 p-6 rounded-2xl border border-slate-100 dark:border-slate-700 transition-colors">
                <h3 class="font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    Simpan Berkas Baru
                </h3>
                <form action="{{ route('dashboard.arsip.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf
                    <div>
                        <label for="judul" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Judul Berkas</label>
                        <input type="text" name="judul" id="judul" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-blue-500 outline-none dark:text-slate-100 transition-all"
                            placeholder="Contoh: Salinan SK Pengangkatan">
                    </div>

                    <div>
                        <label for="file" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">File Dokumen</label>
                        <input type="file" name="file" id="file_arsip" required accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png"
                            onchange="showFileName(this, 'arsip-filename')"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-blue-500 outline-none text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:bg-slate-900 dark:text-slate-300">
                        <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-2" id="arsip-filename">Format: PDF, Word, Excel, JPG, PNG (Max 10MB)</p>
                    </div>

                    <div class="md:col-span-2">
                        <label for="keterangan" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Deskripsi Singkat (Opsional)</label>
                        <textarea name="keterangan" id="keterangan" rows="2"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-blue-500 outline-none dark:text-slate-100 transition-all"></textarea>
                    </div>

                    <div class="md:col-span-2 flex justify-end">
                        <button type="submit"
                            class="px-6 py-3 bg-slate-800 hover:bg-slate-700 text-white font-bold rounded-xl shadow-lg shadow-slate-500/20 transition-all">
                            Simpan ke Arsip
                        </button>
                    </div>
                </form>
            </div>

            <!-- Documents List -->
            <h3 class="font-bold text-slate-800 dark:text-white mb-6 text-lg transition-colors">Arsip Saya</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-sm text-slate-500 dark:text-slate-400 border-b border-slate-100 dark:border-slate-700 transition-colors">
                            <th class="py-4 font-semibold">Judul Berkas</th>
                            <th class="py-4 font-semibold">Keterangan</th>
                            <th class="py-4 font-semibold">Tanggal Simpan</th>
                            <th class="py-4 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-slate-700 dark:text-slate-200">
                        @forelse($arsips as $arsip)
                            <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                                <td class="py-4 pr-4">
                                    <div class="font-bold text-slate-800 dark:text-slate-100 transition-colors">{{ $arsip->judul }}</div>
                                    <div class="text-xs text-slate-400 dark:text-slate-500 transition-colors">{{ $arsip->original_name }}</div>
                                </td>
                                <td class="py-4 text-slate-500">
                                    {{ $arsip->keterangan ?? '-' }}
                                </td>
                                <td class="py-4 text-slate-500">
                                    {{ $arsip->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="py-4 text-right flex justify-end gap-2">
                                    <a href="{{ route('dashboard.arsip.download', $arsip->id) }}" target="_blank"
                                        class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors" title="Download">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('dashboard.arsip.destroy', $arsip->id) }}" method="POST" onsubmit="return confirm('Hapus berkas ini dari arsip?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors" title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-slate-400 italic">
                                    Belum ada berkas di arsip Anda.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.admin>
