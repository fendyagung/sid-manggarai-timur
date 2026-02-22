<x-layouts.admin>
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
        <div class="p-8 bg-[#022c22] text-white transition-colors">
            <h1 class="text-2xl font-bold text-center">Profil {{ $desa->nama_desa }}</h1>
            <p class="text-emerald-100/80 text-center">Perbarui informasi profil, lokasi, dan data statistik desa Anda.
            </p>
        </div>

        <form action="{{ route('dashboard.desa.update') }}" method="POST" enctype="multipart/form-data"
            class="p-8 space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label for="nama_desa"
                        class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2 transition-colors">Nama
                        Desa</label>
                    <input type="text" name="nama_desa" id="nama_desa" value="{{ old('nama_desa', $desa->nama_desa) }}"
                        required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:ring-2 focus:ring-emerald-500 transition-all outline-none dark:text-white">
                </div>
                <div>
                    <label for="kecamatan"
                        class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2 transition-colors">Kecamatan</label>
                    <input type="text" name="kecamatan" id="kecamatan" value="{{ old('kecamatan', $desa->kecamatan) }}"
                        required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:ring-2 focus:ring-emerald-500 transition-all outline-none dark:text-white">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label for="kepala_desa"
                        class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2 transition-colors">Nama
                        Kepala
                        Desa</label>
                    <input type="text" name="kepala_desa" id="kepala_desa"
                        value="{{ old('kepala_desa', $desa->kepala_desa) }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:ring-2 focus:ring-emerald-500 transition-all outline-none dark:text-white">
                </div>
                <div>
                    <label for="foto_profil"
                        class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2 transition-colors">Foto
                        Utama / Banner
                        Desa</label>
                    <input type="file" name="foto_profil" id="foto_profil"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 dark:file:bg-emerald-900/30 file:text-emerald-700 dark:file:text-emerald-400 hover:file:bg-emerald-100 dark:hover:file:bg-emerald-900/50 transition-all outline-none dark:text-slate-300">
                    <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-2 italic">Format: JPG, JPEG, PNG (Maks
                        5MB)</p>
                </div>
            </div>

            <div>
                <label for="video_youtube"
                    class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2 transition-colors">Link
                    Video Promosi
                    (YouTube URL) - <span class="text-slate-400 dark:text-slate-500 font-normal">Opsional</span></label>
                <input type="url" name="video_youtube" id="video_youtube"
                    value="{{ old('video_youtube', $desa->video_youtube) }}"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:ring-2 focus:ring-emerald-500 transition-all outline-none dark:text-white"
                    placeholder="Contoh: https://www.youtube.com/watch?v=...">
                <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-2 italic">Bagikan keindahan desa Anda
                    melalui video YouTube yang
                    menarik.</p>
            </div>

            <!-- Multi Gallery Section -->
            <div class="border-t border-slate-100 dark:border-slate-700 pt-8 space-y-8 transition-colors">
                <div>
                    <h3
                        class="text-lg font-bold text-slate-800 dark:text-white mb-6 flex items-center gap-2 transition-colors">
                        <span class="w-2 h-6 bg-emerald-500 rounded-full"></span>
                        Galeri Foto Tambahan
                    </h3>

                    @if($desa->galleries->where('type', 'foto')->count() > 0)
                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-6">
                            @foreach($desa->galleries->where('type', 'foto') as $item)
                                <div class="relative group aspect-square rounded-2xl overflow-hidden border border-slate-200">
                                    <img src="{{ asset('storage/' . $item->url_or_path) }}" class="w-full h-full object-cover">
                                    <div
                                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center">
                                        <button type="button" onclick="deleteGallery({{ $item->id }})"
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
                                class="flex-1 px-4 py-2.5 rounded-xl border border-slate-200 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <button type="button" onclick="addPhotoInput()"
                                class="p-3 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-100 transition-all"
                                title="Tambah Foto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                        <span class="w-2 h-6 bg-red-500 rounded-full"></span>
                        Galeri Video YouTube Tambahan
                    </h3>

                    @if($desa->galleries->where('type', 'video')->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            @foreach($desa->galleries->where('type', 'video') as $item)
                                <div
                                    class="p-4 bg-slate-50 rounded-2xl border border-slate-100 flex items-center justify-between gap-4">
                                    <div class="flex items-center gap-3 overflow-hidden">
                                        <div class="p-2 bg-red-100 text-red-600 rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.377.505 9.377.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.930-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                            </svg>
                                        </div>
                                        <span
                                            class="text-xs text-slate-600 font-medium truncate">{{ $item->url_or_path }}</span>
                                    </div>
                                    <button type="button" onclick="deleteGallery({{ $item->id }})"
                                        class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div id="video-inputs" class="space-y-4">
                        <div class="flex items-center gap-4">
                            <input type="url" name="gallery_videos[]"
                                class="flex-1 px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition-all placeholder:text-slate-400"
                                placeholder="https://www.youtube.com/watch?v=...">
                            <button type="button" onclick="addVideoInput()"
                                class="p-3 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 transition-all"
                                title="Tambah Video">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Statistics -->
            <div class="border-t border-slate-100 pt-8">
                <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <span class="w-2 h-6 bg-blue-500 rounded-full"></span>
                    Statistik & Data Desa
                </h3>

                <!-- Demographics -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-6">
                    <div>
                        <label for="jumlah_penduduk" class="block text-sm font-semibold text-slate-700 mb-2">Jumlah
                            Penduduk (Jiwa)</label>
                        <input type="number" name="jumlah_penduduk" id="jumlah_penduduk"
                            value="{{ old('jumlah_penduduk', $desa->jumlah_penduduk) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                            placeholder="Contoh: 1500">
                    </div>
                    <div>
                        <label for="jumlah_kk" class="block text-sm font-semibold text-slate-700 mb-2">Jumlah Kepala
                            Keluarga (KK)</label>
                        <input type="number" name="jumlah_kk" id="jumlah_kk"
                            value="{{ old('jumlah_kk', $desa->jumlah_kk) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                            placeholder="Contoh: 350">
                    </div>
                </div>

                <!-- Geographic & Economic -->
                <div class="space-y-6">
                    <div>
                        <label for="luas_wilayah" class="block text-sm font-semibold text-slate-700 mb-2">Luas Wilayah
                            (dengan satuan)</label>
                        <input type="text" name="luas_wilayah" id="luas_wilayah"
                            value="{{ old('luas_wilayah', $desa->luas_wilayah) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                            placeholder="Contoh: 12.5 km² atau 1.500 Ha">
                    </div>

                    <div>
                        <label for="deskripsi_batas" class="block text-sm font-semibold text-slate-700 mb-2">Batas-batas
                            Wilayah</label>
                        <textarea name="deskripsi_batas" id="deskripsi_batas" rows="3"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                            placeholder="Utara: Desa A, Selatan: Laut Sawu, Timur: Sungai Wae Bobo...">{{ old('deskripsi_batas', $desa->deskripsi_batas) }}</textarea>
                    </div>

                    <div>
                        <label for="potensi_ekonomi" class="block text-sm font-semibold text-slate-700 mb-2">Potensi
                            Ekonomi / Mata Pencaharian Utama</label>
                        <textarea name="potensi_ekonomi" id="potensi_ekonomi" rows="3"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                            placeholder="Contoh: 80% penduduk adalah petani kopi Robusta, sisanya nelayan dan pedagang...">{{ old('potensi_ekonomi', $desa->potensi_ekonomi) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="border-t border-slate-100 pt-8">
                <label for="deskripsi" class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Lengkap &
                    Narasi Profil</label>
                <textarea name="deskripsi" id="deskripsi" rows="8"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                    placeholder="Ceritakan sejarah, keindahan alam, budaya, dan alasan mengapa orang harus berkunjung ke desa Anda...">{{ old('deskripsi', $desa->deskripsi) }}</textarea>
            </div>

            <div class="p-6 bg-emerald-50 rounded-3xl border border-emerald-100 flex items-center justify-between">
                <div>
                    <h4 class="font-bold text-emerald-900 mb-1">Promosikan Sebagai Desa Wisata</h4>
                    <p class="text-sm text-emerald-700/80">Jika diaktifkan, desa Anda akan muncul di bagian "Destinasi
                        Unggulan" pada halaman beranda utama.</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_desa_wisata" value="1" class="sr-only peer" {{ $desa->is_desa_wisata ? 'checked' : '' }}>
                    <div
                        class="w-14 h-7 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-emerald-500">
                    </div>
                </label>
            </div>

            <div class="flex items-center gap-4 pt-4">
                <button type="submit"
                    class="px-10 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-2xl shadow-xl shadow-emerald-500/30 transition-all transform hover:-translate-y-1">
                    Simpan Perubahan
                </button>
                <a href="{{ route('dashboard') }}"
                    class="px-10 py-4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-2xl transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <!-- Hidden form for deletion -->
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
                <input type="file" name="gallery_photos[]" class="flex-1 px-4 py-2.5 rounded-xl border border-slate-200 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <button type="button" onclick="this.parentElement.remove()" class="p-3 bg-rose-50 text-rose-600 rounded-xl hover:bg-emerald-100/50 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            `;
            container.appendChild(div);
        }

        function addVideoInput() {
            const container = document.getElementById('video-inputs');
            const div = document.createElement('div');
            div.className = 'flex items-center gap-4 animate-fadeIn';
            div.innerHTML = `
                <input type="url" name="gallery_videos[]" class="flex-1 px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition-all placeholder:text-slate-400" placeholder="https://www.youtube.com/watch?v=...">
                <button type="button" onclick="this.parentElement.remove()" class="p-3 bg-rose-50 text-rose-600 rounded-xl hover:bg-emerald-100/50 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            `;
            container.appendChild(div);
        }

        function deleteGallery(id) {
            if (confirm('Hapus item galeri ini permanen?')) {
                const form = document.getElementById('delete-gallery-form');
                form.action = `/dashboard/profil-desa/gallery/${id}`;
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