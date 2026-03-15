<x-layouts.public>
    <div class="py-24 bg-white dark:bg-slate-900 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav class="flex mb-8 text-sm font-medium text-slate-500">
                <a href="{{ url('/') }}" class="hover:text-emerald-600 transition-colors">Beranda</a>
                <span class="mx-2">/</span>
                <a href="{{ route('public.potensi-wisata') }}" class="hover:text-emerald-600 transition-colors">Potensi Wisata</a>
                <span class="mx-2">/</span>
                <span class="text-slate-800 dark:text-slate-100 truncate max-w-[200px]">{{ $potensi->nama_potensi }}</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Left: Media/Gallery -->
                <div class="space-y-6">
                    <!-- Main Photo -->
                    <div class="relative group aspect-video rounded-3xl overflow-hidden shadow-2xl border border-slate-100 dark:border-slate-800">
                        @if($potensi->foto_utama)
                            <img src="{{ asset('storage/' . $potensi->foto_utama) }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                                 alt="{{ $potensi->nama_potensi }}">
                        @else
                            <div class="w-full h-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400">
                                <span>No Photo Available</span>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4">
                            <span class="px-4 py-1.5 bg-emerald-600/90 backdrop-blur-md text-white text-[10px] font-black uppercase tracking-widest rounded-full shadow-lg">
                                {{ $potensi->kategori }}
                            </span>
                        </div>
                    </div>

                    <!-- Gallery Grid -->
                    @if($potensi->galleries->count() > 0)
                        <div class="grid grid-cols-3 gap-4">
                            @foreach($potensi->galleries as $gal)
                                <a data-fslightbox="gallery" href="{{ asset('storage/' . $gal->foto) }}" 
                                   class="aspect-square rounded-2xl overflow-hidden border border-slate-100 dark:border-slate-800 shadow-sm transition-all hover:scale-105 hover:shadow-lg">
                                    <img src="{{ asset('storage/' . $gal->foto) }}" class="w-full h-full object-cover" alt="Gallery {{ $potensi->id }}">
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Right: Information -->
                <div class="flex flex-col h-full">
                    <div class="bg-white/50 dark:bg-slate-800/50 backdrop-blur-xl p-8 rounded-[40px] border border-white/40 dark:border-slate-700/50 shadow-xl flex-1">
                        <h1 class="text-4xl font-black text-slate-800 dark:text-white mb-2 leading-tight font-serif">
                            {{ $potensi->nama_potensi }}
                        </h1>
                        <div class="flex items-center gap-4 mb-8">
                            <div class="flex items-center gap-1.5 text-emerald-600 dark:text-emerald-400 text-sm font-bold">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $potensi->desa->nama_desa }}, {{ $potensi->desa->kecamatan }}
                            </div>
                            <div class="h-1 w-1 bg-slate-300 rounded-full"></div>
                            <div class="text-slate-400 text-xs font-medium uppercase tracking-widest">
                                ID: #POT-{{ str_pad($potensi->id, 4, '0', STR_PAD_LEFT) }}
                            </div>
                        </div>

                        <div class="prose dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 leading-relaxed mb-10">
                            {!! nl2br(e($potensi->deskripsi)) !!}
                        </div>

                        <!-- Village Card Section -->
                        <div class="p-6 bg-white dark:bg-slate-900/50 rounded-3xl border border-slate-100 dark:border-slate-800 flex items-center justify-between group transition-all hover:border-emerald-500/30">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-2xl flex items-center justify-center text-xl shadow-inner">
                                    🏘️
                                </div>
                                <div>
                                    <p class="text-[10px] text-slate-400 dark:text-slate-500 uppercase font-bold tracking-widest">Wilayah Desa</p>
                                    <h4 class="font-bold text-slate-800 dark:text-slate-200">{{ $potensi->desa->nama_desa }}</h4>
                                </div>
                            </div>
                            <a href="{{ route('public.desa.profil', $potensi->desa->id) }}" 
                               class="px-4 py-2 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-xs font-bold rounded-xl hover:bg-emerald-600 hover:text-white transition-all shadow-sm">
                                Lihat Desa →
                            </a>
                        </div>
                    </div>

                    <!-- Shared Action -->
                    <div class="mt-8 flex gap-4">
                        <a href="https://www.google.com/maps/search/{{ urlencode($potensi->nama_potensi . ' ' . $potensi->desa->nama_desa) }}" target="_blank"
                           class="flex-1 py-4 bg-emerald-700 hover:bg-emerald-800 text-white font-bold rounded-2xl text-center shadow-lg shadow-emerald-500/20 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7l5-2.5 5.553 2.776a1 1 0 01.447.894v10.764a1 1 0 01-1.447.894L14 17l-5 3z" />
                            </svg>
                            BUKA LOKASI DI GOOGLE MAPS
                        </a>
                        <button onclick="window.print()" class="p-4 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-500 rounded-2xl hover:text-emerald-600 transition-all shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Related Potentials -->
            @if($related->count() > 0)
                <div class="mt-24">
                    <div class="flex items-center justify-between mb-10">
                        <div>
                            <h2 class="text-3xl font-black text-slate-800 dark:text-white font-serif">Eksplorasi Serupa</h2>
                            <p class="text-slate-500 dark:text-slate-400 mt-1">Potensi lain dalam kategori <strong class="text-emerald-600">{{ $potensi->kategori }}</strong></p>
                        </div>
                        <a href="{{ route('public.potensi-wisata') }}" class="text-emerald-600 font-bold hover:underline">Lihat Semua →</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        @foreach($related as $rel)
                            <div class="group bg-white dark:bg-slate-800 rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition-all border border-slate-100 dark:border-slate-700">
                                <div class="aspect-[4/3] overflow-hidden relative">
                                    <img src="{{ asset('storage/' . $rel->foto_utama) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $rel->nama_potensi }}">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
                                    <div class="absolute bottom-4 left-4">
                                        <p class="text-white font-bold">{{ $rel->nama_potensi }}</p>
                                        <p class="text-white/70 text-[10px]">{{ $rel->desa->nama_desa }}</p>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <a href="{{ route('public.potensi-wisata.detail', $rel->id) }}" class="w-full py-2.5 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 text-xs font-black rounded-xl text-center block transition-all hover:bg-emerald-600 hover:text-white uppercase tracking-widest">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layouts.public>
