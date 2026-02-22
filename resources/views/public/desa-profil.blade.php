<x-layouts.public>
    <!-- Hero Section -->
    <div class="relative h-[60vh] min-h-[400px] flex items-end overflow-hidden">
        @if($desa->foto_profil)
            <img src="{{ asset('storage/' . $desa->foto_profil) }}" alt="{{ $desa->nama_desa }}"
                class="absolute inset-0 w-full h-full object-cover">
        @elseif($desa->potensis->isNotEmpty() && $desa->potensis->first()->foto_utama)
            <img src="{{ asset('storage/' . $desa->potensis->first()->foto_utama) }}" alt="{{ $desa->nama_desa }}"
                class="absolute inset-0 w-full h-full object-cover">
        @else
            <div class="absolute inset-0 bg-slate-200 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-slate-300" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/20 to-transparent"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 w-full">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <span
                        class="inline-block px-4 py-1.5 rounded-full bg-emerald-500 text-white text-xs font-bold uppercase tracking-widest mb-4 shadow-lg">
                        Desa Wisata Unggulan
                    </span>
                    <h1 class="text-4xl md:text-6xl font-bold text-white mb-2">{{ $desa->nama_desa }}</h1>
                    <div class="flex items-center text-emerald-300 font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Kecamatan {{ $desa->kecamatan }}
                    </div>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('public.desa-wisata') }}"
                        class="px-6 py-3 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/30 text-white font-bold rounded-2xl transition-all flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="py-16 bg-white dark:bg-slate-900 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
                <!-- Main Desc -->
                <div class="lg:col-span-2">
                    <h2 class="text-3xl font-bold text-slate-800 dark:text-white mb-6 flex items-center gap-3">
                        <span class="w-2 h-8 bg-emerald-500 rounded-full"></span>
                        Tentang Desa
                    </h2>
                    <div class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed space-y-6">
                        @if($desa->deskripsi)
                            {!! nl2br(e($desa->deskripsi)) !!}
                        @else
                            <p class="italic text-slate-400">Deskripsi desa belum ditambahkan oleh pengelola.</p>
                        @endif
                    </div>

                    @if($desa->video_youtube)
                        @php
                            $videoId = null;
                            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:watch\?v=|embed/|live/|v/|shorts/|[^/]+/.+/)|youtu\.be/)([^"&?/ ]{11})%i', $desa->video_youtube, $match)) {
                                $videoId = $match[1];
                            }
                        @endphp

                        @if($videoId)
                            <div class="mt-12">
                                <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-6 flex items-center gap-2">
                                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                                    </svg>
                                    Video Profil & Promosi Desa
                                </h3>
                                <div
                                    class="relative w-full rounded-[3rem] overflow-hidden shadow-2xl bg-black aspect-video border-8 border-slate-100 dark:border-slate-800">
                                    <iframe class="absolute inset-0 w-full h-full"
                                        src="https://www.youtube.com/embed/{{ $videoId }}" title="YouTube video player"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen></iframe>
                                </div>
                            </div>
                        @endif
                    @endif

                    <!-- Statistics & Data -->
                    <div class="mt-12">
                        <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-6 flex items-center gap-2">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Statistik & Data Desa
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Demographics Card -->
                            <div
                                class="p-6 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-[2rem]">
                                <h4
                                    class="font-bold text-slate-700 mb-4 flex items-center gap-2 text-sm uppercase tracking-wider">
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Demografi
                                </h4>
                                <div class="space-y-4">
                                    <div
                                        class="flex justify-between items-center pb-3 border-b border-slate-200/60 dark:border-slate-700/60">
                                        <span class="text-slate-500 dark:text-slate-400 text-sm">Jumlah Penduduk</span>
                                        <span
                                            class="font-bold text-slate-800 dark:text-slate-100">{{ $desa->jumlah_penduduk ? number_format($desa->jumlah_penduduk) . ' Jiwa' : '-' }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-slate-500 dark:text-slate-400 text-sm">Jumlah KK</span>
                                        <span
                                            class="font-bold text-slate-800 dark:text-slate-100">{{ $desa->jumlah_kk ? number_format($desa->jumlah_kk) . ' KK' : '-' }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Geography Card -->
                            <div
                                class="p-6 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-[2rem]">
                                <h4
                                    class="font-bold text-slate-700 dark:text-slate-300 mb-4 flex items-center gap-2 text-sm uppercase tracking-wider">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Geografis
                                </h4>
                                <div class="space-y-4">
                                    <div
                                        class="flex justify-between items-center pb-3 border-b border-slate-200/60 dark:border-slate-700/60">
                                        <span class="text-slate-500 dark:text-slate-400 text-sm">Luas Wilayah</span>
                                        <span
                                            class="font-bold text-slate-800 dark:text-slate-100">{{ $desa->luas_wilayah ?? '-' }}</span>
                                    </div>
                                    <div>
                                        <span class="text-slate-500 dark:text-slate-400 text-sm block mb-1">Batas
                                            Wilayah</span>
                                        <p
                                            class="font-medium text-slate-800 dark:text-slate-100 text-sm leading-relaxed">
                                            {{ $desa->deskripsi_batas ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Economy Card -->
                            <div
                                class="md:col-span-2 p-6 bg-amber-50 dark:bg-amber-900/10 rounded-[2rem] border border-amber-100 dark:border-amber-800/30">
                                <h4
                                    class="font-bold text-amber-800 mb-3 flex items-center gap-2 text-sm uppercase tracking-wider">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Potensi Ekonomi
                                </h4>
                                <p class="text-amber-900/80 dark:text-amber-400/80 leading-relaxed">
                                    {{ $desa->potensi_ekonomi ?? 'Belum ada data potensi ekonomi.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar / CTA -->
                <div class="lg:col-span-1">
                    <div
                        class="bg-slate-900 rounded-[2.5rem] p-10 text-white sticky top-28 shadow-2xl overflow-hidden relative">
                        <div class="relative z-10">
                            <h3 class="text-2xl font-bold mb-4">Ingin Berkunjung?</h3>
                            <p class="text-slate-400 mb-8 leading-relaxed text-sm">
                                Temukan pengalaman tak terlupakan di Manggarai Timur. Hubungi pusat informasi pariwisata
                                untuk panduan lebih lanjut.
                            </p>
                            <a href="{{ route('public.kontak') }}"
                                class="w-full flex items-center justify-center py-4 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-2xl transition-all shadow-lg shadow-emerald-500/20">
                                Tanya Admin
                            </a>
                        </div>
                        <!-- Decoration -->
                        <div class="absolute -top-12 -right-12 w-40 h-40 bg-emerald-500/10 rounded-full blur-3xl"></div>
                        <div class="absolute -bottom-12 -left-12 w-40 h-40 bg-blue-500/10 rounded-full blur-3xl"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.public>