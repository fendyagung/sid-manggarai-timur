<x-layouts.admin>
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
        <div class="p-8 bg-[#022c22] text-white transition-colors">
            <h1 class="text-2xl font-bold">Pengaturan Profil DPMD</h1>
            <p class="text-emerald-100/80">Perbarui informasi profil dan sambutan Kepala Dinas.</p>
        </div>

        <form action="{{ route('dashboard.dpmd.update-profil') }}" method="POST" enctype="multipart/form-data"
            class="p-8 space-y-10">
            @csrf

            <!-- Kadis Section -->
            <div>
                <h3
                    class="text-lg font-bold text-slate-800 dark:text-white mb-6 flex items-center gap-2 transition-colors">
                    <span class="w-2 h-6 bg-emerald-500 rounded-full"></span>
                    Informasi Kepala Dinas & Sambutan
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-6">
                    <div>
                        <label for="nama_kadis"
                            class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2 transition-colors">Nama
                            Kepala Dinas</label>
                        <input type="text" name="nama_kadis" id="nama_kadis"
                            value="{{ old('nama_kadis', $profile->nama_kadis) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:ring-2 focus:ring-emerald-500 outline-none dark:text-white transition-all">
                    </div>
                    <div>
                        <label for="foto_kadis"
                            class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2 transition-colors">Foto
                            Kepala Dinas</label>
                        <input type="file" name="foto_kadis" id="foto_kadis"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 dark:file:bg-emerald-900/30 file:text-emerald-700 dark:file:text-emerald-400 hover:file:bg-emerald-100 dark:hover:file:bg-emerald-900/50 transition-all outline-none dark:text-slate-300">
                    </div>

                    <div
                        class="md:col-span-2 space-y-6 pt-6 border-t border-slate-100 dark:border-slate-700 transition-colors">
                        <div class="space-y-6">
                            <h4
                                class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider flex items-center gap-2 transition-colors">
                                Kata Sambutan Pimpinan
                            </h4>
                            <div>
                                <label for="sambutan_judul"
                                    class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2 transition-colors">Judul
                                    Sambutan (Slogan)</label>
                                <input type="text" name="sambutan_judul" id="sambutan_judul"
                                    value="{{ old('sambutan_judul', $profile->sambutan_judul) }}"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:ring-2 focus:ring-emerald-500 outline-none dark:text-white transition-all"
                                    placeholder="Contoh: Membangun Desa, Sejahteraan Rakyat">
                            </div>
                            <div>
                                <label for="sambutan_teks"
                                    class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2 transition-colors">Teks
                                    Sambutan</label>
                                <textarea name="sambutan_teks" id="sambutan_teks" rows="5"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:ring-2 focus:ring-emerald-500 outline-none dark:text-white transition-all">{{ old('sambutan_teks', $profile->sambutan_teks) }}</textarea>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-slate-100 dark:border-slate-700 space-y-6 transition-colors">
                            <h4
                                class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider flex items-center gap-2 transition-colors">
                                Visi & Misi Instansi
                            </h4>
                            <div>
                                <label for="visi"
                                    class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2 transition-colors">Visi</label>
                                <textarea name="visi" id="visi" rows="3"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:ring-2 focus:ring-emerald-500 outline-none dark:text-white transition-all">{{ old('visi', $profile->visi) }}</textarea>
                            </div>
                            <div>
                                <label for="misi"
                                    class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2 transition-colors">Misi
                                    (Gunakan
                                    baris baru untuk setiap poin)</label>
                                <textarea name="misi" id="misi" rows="6"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:ring-2 focus:ring-emerald-500 outline-none dark:text-white transition-all">{{ old('misi', $profile->misi) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2 pt-6 border-t border-slate-100 dark:border-slate-700 transition-colors">
                        <label for="logo_website"
                            class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2 transition-colors">Logo
                            Website (Logo Manggarai Timur)</label>
                        <input type="file" name="logo_website" id="logo_website"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 dark:file:bg-emerald-900/30 file:text-emerald-700 dark:file:text-emerald-400 hover:file:bg-emerald-100 dark:hover:file:bg-emerald-900/50 transition-all outline-none dark:text-slate-300">
                        <p class="text-[10px] text-slate-500 dark:text-slate-400 mt-2 transition-colors">Format:
                            PNG/JPG. Disarankan logo dengan latar
                            belakang transparan.</p>
                    </div>

                    <!-- MULTI-GALLERY DPMD (Photos & Videos) -->
                    <div
                        class="md:col-span-2 pt-10 border-t-2 border-dashed border-slate-100 dark:border-slate-800 transition-colors">
                        <div class="flex items-center gap-3 mb-8">
                            <div
                                class="w-12 h-12 bg-rose-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-rose-200 transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3
                                    class="text-xl font-black text-slate-800 dark:text-white uppercase tracking-tight transition-colors">
                                    Galeri Digital
                                    DPMD</h3>
                                <p
                                    class="text-xs text-rose-500 dark:text-rose-400 font-bold uppercase tracking-widest transition-colors">
                                    Unggah Foto & Video
                                    Kegiatan</p>
                            </div>
                        </div>

                        <!-- 1. MULTI-PHOTO UPLOAD AREA -->
                        <div class="mb-12">
                            <label class="block text-sm font-bold text-slate-700 mb-4">📸 UNGGAH FOTO BARU (PILIH BANYAK
                                SEKALIGUS)</label>
                            <div class="relative group">
                                <div
                                    class="absolute -inset-1 bg-gradient-to-r from-rose-500 to-orange-500 rounded-[2rem] blur opacity-10 group-hover:opacity-20 transition duration-1000">
                                </div>
                                <div
                                    class="relative p-10 border-2 border-dotted border-slate-300 rounded-[2rem] bg-white hover:border-rose-400 transition-all text-center">
                                    <input type="file" name="gallery_photos[]" id="gallery_photos" multiple
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                    <div class="space-y-2">
                                        <svg class="w-12 h-12 mx-auto text-slate-300 group-hover:text-rose-500 transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-slate-500 font-bold">Ketuk atau seret foto ke sini</p>
                                        <p class="text-[10px] text-slate-400 px-10">Dapat memilih lebih dari 1 file foto
                                            (Format: JPG, PNG, JPEG. Max 5MB per file)</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Photo Grid Preview (Existing) -->
                            @if($profile->galleries->where('type', 'foto')->count() > 0)
                                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-8">
                                    @foreach($profile->galleries->where('type', 'foto') as $photo)
                                        <div
                                            class="relative group aspect-square rounded-2xl overflow-hidden border-2 border-white shadow-md ring-1 ring-slate-100">
                                            <img src="{{ asset('storage/' . $photo->url_or_path) }}"
                                                class="w-full h-full object-cover">
                                            <div
                                                class="absolute inset-0 bg-rose-600/60 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center backdrop-blur-[2px]">
                                                <button type="button" onclick="deleteGalleryItem('{{ $photo->id }}')"
                                                    class="p-3 bg-white text-rose-600 rounded-full hover:scale-110 transition-transform shadow-xl">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- 2. DYNAMIC VIDEO LINKS -->
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-slate-700 mb-4">🎥 VIDEO YOUTUBE DPMD (TAMBAH
                                BANYAK VIDEO)</label>

                            @if($profile->galleries->where('type', 'video')->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-6">
                                    @foreach($profile->galleries->where('type', 'video') as $video)
                                        <div
                                            class="flex items-center gap-3 p-4 bg-slate-50 border border-slate-200 rounded-2xl">
                                            <div
                                                class="w-10 h-10 rounded-xl bg-rose-100 flex items-center justify-center text-rose-600">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 4-8 4z" />
                                                </svg>
                                            </div>
                                            <span
                                                class="text-[11px] font-bold text-slate-600 flex-1 truncate">{{ $video->url_or_path }}</span>
                                            <button type="button" onclick="deleteGalleryItem('{{ $video->id }}')"
                                                class="text-rose-500 hover:text-red-700 font-black text-[10px] uppercase p-2 hover:bg-rose-50 rounded-lg transition-all">Hapus</button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <div id="video-inputs-container" class="space-y-4">
                                <div class="flex gap-3">
                                    <input type="url" name="gallery_videos[]"
                                        class="flex-1 px-6 py-4 rounded-2xl bg-slate-50 border border-slate-200 focus:ring-4 focus:ring-rose-100 focus:border-rose-400 outline-none transition-all font-medium text-sm"
                                        placeholder="Tempel link video YouTube ke sini...">
                                    <button type="button" onclick="addVideoInput()"
                                        class="px-6 py-4 bg-slate-900 text-white hover:bg-black rounded-2xl font-bold shadow-xl shadow-slate-200 transition-all flex items-center gap-2 whitespace-nowrap">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                        Tambah Link
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <!-- Statistics Section -->
            <div class="pt-8 border-t border-slate-100">
                <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <span class="w-2 h-6 bg-amber-500 rounded-full"></span>
                    Statistik Wilayah (Beranda)
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-8">
                    <div>
                        <label for="stat_total_desa" class="block text-sm font-semibold text-slate-700 mb-2">Total
                            Desa/Kelurahan</label>
                        <input type="number" name="stat_total_desa" id="stat_total_desa"
                            value="{{ old('stat_total_desa', $profile->stat_total_desa) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label for="stat_kecamatan"
                            class="block text-sm font-semibold text-slate-700 mb-2">Kecamatan</label>
                        <input type="number" name="stat_kecamatan" id="stat_kecamatan"
                            value="{{ old('stat_kecamatan', $profile->stat_kecamatan) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label for="stat_desa_wisata" class="block text-sm font-semibold text-slate-700 mb-2">Desa
                            Wisata</label>
                        <input type="number" name="stat_desa_wisata" id="stat_desa_wisata"
                            value="{{ old('stat_desa_wisata', $profile->stat_desa_wisata) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label for="stat_spot_wisata" class="block text-sm font-semibold text-slate-700 mb-2">Spot
                            Wisata</label>
                        <input type="number" name="stat_spot_wisata" id="stat_spot_wisata"
                            value="{{ old('stat_spot_wisata', $profile->stat_spot_wisata) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label for="stat_wisatawan"
                            class="block text-sm font-semibold text-slate-700 mb-2">Wisatawan</label>
                        <input type="text" name="stat_wisatawan" id="stat_wisatawan"
                            value="{{ old('stat_wisatawan', $profile->stat_wisatawan) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none"
                            placeholder="Contoh: 12rb">
                    </div>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="pt-8 border-t border-slate-100">
                <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <span class="w-2 h-6 bg-blue-600 rounded-full"></span>
                    Informasi Kontak Kantor
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="md:col-span-3">
                        <label for="alamat" class="block text-sm font-semibold text-slate-700 mb-2">Alamat Kantor
                            Lengkap</label>
                        <textarea name="alamat" id="alamat" rows="2"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none"
                            placeholder="Contoh: Jl. Trans Flores, Borong, Kabupaten Manggarai Timur, Nusa Tenggara Timur.">{{ old('alamat', $profile->alamat) }}</textarea>
                    </div>
                    <div>
                        <label for="telepon" class="block text-sm font-semibold text-slate-700 mb-2">Nomor Telepon
                            Kantor</label>
                        <input type="text" name="telepon" id="telepon" value="{{ old('telepon', $profile->telepon) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none"
                            placeholder="Contoh: (0385) 123456">
                    </div>
                    <div class="md:col-span-2">
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email Resmi
                            Kantor</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $profile->email) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none"
                            placeholder="Contoh: info@dpmdmatim.go.id">
                    </div>
                </div>
            </div>


            <!-- Team Section -->
            <div class="pt-8 border-t border-slate-100">
                <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <span class="w-2 h-6 bg-blue-500 rounded-full"></span>
                    Struktur Nama Pejabat
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="nama_sekretaris" class="block text-sm font-semibold text-slate-700 mb-2">Nama
                            Sekretaris
                            Dinas</label>
                        <input type="text" name="nama_sekretaris" id="nama_sekretaris"
                            value="{{ old('nama_sekretaris', $profile->nama_sekretaris) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label for="nama_kabid_pemberdayaan"
                            class="block text-sm font-semibold text-slate-700 mb-2">Nama Kabid
                            Pemberdayaan</label>
                        <input type="text" name="nama_kabid_pemberdayaan" id="nama_kabid_pemberdayaan"
                            value="{{ old('nama_kabid_pemberdayaan', $profile->nama_kabid_pemberdayaan) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label for="nama_kabid_pemerintahan"
                            class="block text-sm font-semibold text-slate-700 mb-2">Nama Kabid
                            Pemerintahan</label>
                        <input type="text" name="nama_kabid_pemerintahan" id="nama_kabid_pemerintahan"
                            value="{{ old('nama_kabid_pemerintahan', $profile->nama_kabid_pemerintahan) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label for="nama_kabid_ekonomi" class="block text-sm font-semibold text-slate-700 mb-2">Nama
                            Kabid Ekonomi</label>
                        <input type="text" name="nama_kabid_ekonomi" id="nama_kabid_ekonomi"
                            value="{{ old('nama_kabid_ekonomi', $profile->nama_kabid_ekonomi) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>
            </div>



            <div class="flex items-center gap-4 pt-10 border-t border-slate-100">
                <button type="submit"
                    class="px-12 py-5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-2xl shadow-xl shadow-emerald-500/30 transition-all transform hover:-translate-y-1 flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Seluruh Perubahan
                </button>
                <a href="{{ route('dashboard') }}"
                    class="px-10 py-5 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-2xl transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <!-- Delete Form (Hidden) -->
    <form id="delete-gallery-form" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function addVideoInput() {
            const container = document.getElementById('video-inputs-container');
            const wrapper = document.createElement('div');
            wrapper.className = 'flex gap-2 animate-fadeIn';
            wrapper.innerHTML = `
                <input type="url" name="gallery_videos[]" 
                    class="flex-1 px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none"
                    placeholder="Masukkan URL YouTube lainnya...">
                <button type="button" onclick="this.parentElement.remove()" 
                    class="px-4 py-3 bg-red-50 text-red-500 hover:bg-red-100 rounded-xl font-bold transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            `;
            container.appendChild(wrapper);
        }

        function deleteGalleryItem(id) {
            if (confirm('Apakah Anda yakin ingin menghapus item galeri ini?')) {
                const form = document.getElementById('delete-gallery-form');
                form.action = `/dashboard/dpmd/gallery/${id}`;
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