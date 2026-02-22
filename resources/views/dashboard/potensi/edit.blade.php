<x-layouts.admin>
    <div class="p-8">
        <div class="max-w-4xl">
            <div class="flex items-center gap-4 mb-8">
                <a href="{{ route('dashboard.potensi.index') }}"
                    class="p-2 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-600 dark:text-slate-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Edit Potensi</h1>
                    <p class="text-slate-500 dark:text-slate-400">Perbarui informasi {{ $potensi->nama_potensi }}.</p>
                </div>
            </div>

            <form action="{{ route('dashboard.potensi.update', $potensi->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-8">
                @csrf
                <div
                    class="bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-sm border border-slate-100 dark:border-slate-700 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if(Auth::user()->role === 'admin_dpmd')
                            <div class="space-y-2 col-span-2">
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300">Pilih Desa Sumber
                                    Potensi</label>
                                <select name="desa_id" required
                                    class="w-full px-5 py-3 rounded-2xl border border-slate-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none">
                                    @foreach($desas as $desa)
                                        <option value="{{ $desa->id }}" {{ $potensi->desa_id == $desa->id ? 'selected' : '' }}>
                                            {{ $desa->nama_desa }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300">Nama Potensi /
                                Produk</label>
                            <input type="text" name="nama_potensi" required value="{{ $potensi->nama_potensi }}"
                                class="w-full px-5 py-3 rounded-2xl border border-slate-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:ring-emerald-50 focus:border-[#064e3b] transition-all outline-none">
                            @error('nama_potensi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300">Kategori</label>
                            <select name="kategori" required
                                class="w-full px-5 py-3 rounded-2xl border border-slate-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none">
                                <option value="kuliner" {{ $potensi->kategori === 'kuliner' ? 'selected' : '' }}>Kuliner
                                    Khas</option>
                                <option value="kerajinan" {{ $potensi->kategori === 'kerajinan' ? 'selected' : '' }}>
                                    Kerajinan Tangan</option>
                                <option value="event" {{ $potensi->kategori === 'event' ? 'selected' : '' }}>Event Budaya
                                </option>
                                <option value="alam" {{ $potensi->kategori === 'alam' ? 'selected' : '' }}>Wisata Alam
                                </option>
                                <option value="budaya" {{ $potensi->kategori === 'budaya' ? 'selected' : '' }}>Seni Budaya
                                </option>
                                <option value="komoditi" {{ $potensi->kategori === 'komoditi' ? 'selected' : '' }}>
                                    Komoditi Unggulan
                                </option>
                                <option value="lainnya" {{ $potensi->kategori === 'lainnya' ? 'selected' : '' }}>Lainnya
                                </option>
                            </select>
                            @error('kategori') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300">Lokasi / Desa
                            (Opsional)</label>
                        <input type="text" name="lokasi" value="{{ $potensi->lokasi }}"
                            class="w-full px-5 py-3 rounded-2xl border border-slate-100 focus:ring-emerald-50 focus:border-[#064e3b] transition-all outline-none">
                        @error('lokasi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300">Deskripsi
                            Ringkas</label>
                        <textarea name="deskripsi" rows="4" required
                            class="w-full px-5 py-3 rounded-2xl border border-slate-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:ring-emerald-50 focus:border-[#064e3b] transition-all outline-none">{{ $potensi->deskripsi }}</textarea>
                        @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300">Foto Utama
                            (Banner)</label>
                        @if($potensi->foto_utama)
                            <div
                                class="w-48 h-32 rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-600">
                                <img src="{{ asset('storage/' . $potensi->foto_utama) }}"
                                    class="w-full h-full object-cover">
                            </div>
                        @endif
                        <div
                            class="relative group border-2 border-dashed border-slate-200 dark:border-slate-600 rounded-2xl p-8 text-center hover:border-emerald-500 transition-all">
                            <input type="file" name="foto_utama"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                            <div class="space-y-2">
                                <svg class="w-12 h-12 text-slate-400 mx-auto" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                </svg>
                                <p class="text-slate-500 dark:text-slate-400">Klik untuk ganti foto utama</p>
                            </div>
                        </div>
                    </div>

                    <!-- Multi Gallery Section -->
                    <div class="pt-8 border-t border-slate-100 dark:border-slate-700 space-y-6">
                        <h3 class="text-lg font-bold text-slate-800 dark:text-white">Galeri Foto Tambahan</h3>

                        @if($potensi->galleries->count() > 0)
                            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                                @foreach($potensi->galleries as $item)
                                    <div
                                        class="relative group aspect-square rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-600">
                                        <img src="{{ asset('storage/' . $item->foto) }}" class="w-full h-full object-cover">
                                        <div
                                            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center">
                                            <button type="button" onclick="deleteGalleryPhoto({{ $item->id }})"
                                                class="p-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-all">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div id="photo-inputs" class="space-y-4">
                            <div class="flex items-center gap-4">
                                <input type="file" name="gallery_photos[]"
                                    class="flex-1 px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-600 dark:bg-slate-700 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all">
                                <button type="button" onclick="addPhotoInput()"
                                    class="p-3 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 rounded-xl hover:bg-emerald-100 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('dashboard.potensi.index') }}"
                        class="px-8 py-3 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 font-bold rounded-2xl hover:bg-slate-200 dark:hover:bg-slate-600 transition-all">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-10 py-3 bg-[#166534] text-white font-bold rounded-2xl shadow-lg shadow-emerald-500/20 hover:bg-[#15803d] hover:-translate-y-1 transition-all">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Hidden form for gallery deletion -->
    <form id="delete-gallery-form" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function addPhotoInput() {
            const container = document.getElementById('photo-inputs');
            const div = document.createElement('div');
            div.className = 'flex items-center gap-4 animate-fadeIn';
            div.innerHTML = `
                <input type="file" name="gallery_photos[]" class="flex-1 px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-600 dark:bg-slate-700 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all">
                <button type="button" onclick="this.parentElement.remove()" class="p-3 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-100 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            `;
            container.appendChild(div);
        }

        function deleteGalleryPhoto(id) {
            if (confirm('Hapus foto dari galeri?')) {
                const form = document.getElementById('delete-gallery-form');
                form.action = `/dashboard/potensi/gallery/${id}`;
                form.submit();
            }
        }
    </script>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>
</x-layouts.admin>