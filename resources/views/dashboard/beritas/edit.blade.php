<x-layouts.admin>
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
        <div class="p-8 bg-[#064e3b] text-white">
            <h1 class="text-2xl font-bold">Edit Berita</h1>
            <p class="text-emerald-100/80">Perbarui informasi berita atau kegiatan yang telah dipublikasikan.</p>
        </div>

        <form action="{{ route('dashboard.beritas.update', $berita->id) }}" method="POST" enctype="multipart/form-data"
            class="p-8 space-y-8">
            @csrf

            <div class="space-y-6">
                <div>
                    <label for="judul" class="block text-sm font-semibold text-slate-700 mb-2">Judul Berita</label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul', $berita->judul) }}" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                        placeholder="Ketik judul berita yang menarik...">
                    @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="kategori" class="block text-sm font-semibold text-slate-700 mb-2">Kategori</label>
                        <select name="kategori" id="kategori" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                            <option value="kegiatan" {{ old('kategori', $berita->kategori) == 'kegiatan' ? 'selected' : '' }}>Kegiatan
                            </option>
                            <option value="wisata" {{ old('kategori', $berita->kategori) == 'wisata' ? 'selected' : '' }}>
                                Wisata</option>
                            <option value="ekonomi" {{ old('kategori', $berita->kategori) == 'ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                            <option value="budaya" {{ old('kategori', $berita->kategori) == 'budaya' ? 'selected' : '' }}>
                                Budaya</option>
                            <option value="pengumuman" {{ old('kategori', $berita->kategori) == 'pengumuman' ? 'selected' : '' }}>Pengumuman
                            </option>
                        </select>
                        @error('kategori') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="is_published" class="block text-sm font-semibold text-slate-700 mb-2">Status</label>
                        <select name="is_published" id="is_published" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                            <option value="1" {{ old('is_published', $berita->is_published) == '1' ? 'selected' : '' }}>
                                Publikasikan
                            </option>
                            <option value="0" {{ old('is_published', $berita->is_published) == '0' ? 'selected' : '' }}>
                                Simpan
                                sebagai Draft
                            </option>
                        </select>
                        @error('is_published') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="foto" class="block text-sm font-semibold text-slate-700 mb-2">Foto / Gambar
                        Utama</label>
                    <input type="file" name="foto" id="foto"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-[10px] text-slate-400 mt-2 italic">Biarkan kosong jika tidak ingin mengubah gambar.
                    </p>
                    @error('foto') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="isi" class="block text-sm font-semibold text-slate-700 mb-2">Isi Berita
                        Lengkap</label>
                    <textarea name="isi" id="isi" rows="12" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                        placeholder="Tuliskan detail berita atau kegiatan di sini...">{{ old('isi', $berita->isi) }}</textarea>
                    @error('isi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center gap-4 pt-4">
                <button type="submit"
                    class="px-10 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-2xl shadow-xl shadow-emerald-500/30 transition-all transform hover:-translate-y-1">
                    Simpan Perubahan
                </button>
                <a href="{{ route('dashboard.beritas.index') }}"
                    class="px-10 py-4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-2xl transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-layouts.admin>