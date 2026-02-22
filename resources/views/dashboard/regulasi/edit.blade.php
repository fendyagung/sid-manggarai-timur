<x-layouts.admin>
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('dashboard.regulasi.index') }}"
            class="p-3 bg-white border border-slate-100 rounded-2xl text-slate-500 hover:text-[#064e3b] shadow-sm transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Edit Dokumen</h1>
            <p class="text-slate-500 mt-1">Perbarui informasi atau ganti file dokumen regulasi.</p>
        </div>
    </div>

    <div class="max-w-3xl">
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
            <form action="{{ route('dashboard.regulasi.update', $regulasi->id) }}" method="POST"
                enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Judul Dokumen</label>
                    <input type="text" name="judul" value="{{ old('judul', $regulasi->judul) }}" required
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-emerald-50 focus:border-[#064e3b] transition-all">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Kategori</label>
                    <select name="kategori" required
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all appearance-none cursor-pointer">
                        <option value="Peraturan Daerah" {{ $regulasi->kategori == 'Peraturan Daerah' ? 'selected' : '' }}>Peraturan Daerah (Perda/Perbup)</option>
                        <option value="Format Laporan" {{ $regulasi->kategori == 'Format Laporan' ? 'selected' : '' }}>
                            Format Laporan</option>
                        <option value="Template Surat" {{ $regulasi->kategori == 'Template Surat' ? 'selected' : '' }}>
                            Template Surat Admin</option>
                        <option value="Materi Sosialisasi" {{ $regulasi->kategori == 'Materi Sosialisasi' ? 'selected' : '' }}>Materi Sosialisasi</option>
                        <option value="Lainnya" {{ $regulasi->kategori == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Ganti File (Opsional)</label>
                    <div class="mb-3 p-4 bg-emerald-50 rounded-2xl border border-emerald-100 flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="text-xs text-emerald-700 font-medium">File saat ini:
                            <strong>{{ basename($regulasi->file_path) }}</strong></span>
                    </div>
                    <input type="file" name="file"
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-emerald-50 focus:border-[#064e3b] outline-none transition-all file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-[#166534] file:text-white hover:file:bg-[#15803d]">
                    <p class="mt-2 text-xs text-slate-400 italic font-medium">* Biarkan kosong jika tidak ingin
                        mengganti file. (Max 10MB)</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi Singkat</label>
                    <textarea name="deskripsi" rows="4"
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-emerald-50 focus:border-[#064e3b] transition-all">{{ old('deskripsi', $regulasi->deskripsi) }}</textarea>
                </div>

                <div class="pt-4 border-t border-slate-50 flex justify-end gap-4">
                    <a href="{{ route('dashboard.regulasi.index') }}"
                        class="px-8 py-4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-2xl transition-all">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-10 py-4 bg-[#166534] hover:bg-[#15803d] text-white font-bold rounded-2xl shadow-xl shadow-emerald-500/20 transition-all transform hover:-translate-y-1">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>