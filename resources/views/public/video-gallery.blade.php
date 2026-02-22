<x-layouts.public>
    <!-- Header Section -->
    <section class="pt-32 pb-16 bg-white border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <span
                    class="inline-block py-1 px-3 rounded-full bg-red-50 text-red-600 text-[10px] font-bold uppercase tracking-widest mb-6 border border-red-100">
                    Multimedia
                </span>
                <h1 class="text-4xl md:text-5xl font-bold text-slate-900 mb-6">Galeri Video Promosi</h1>
                <p class="text-slate-500 text-lg leading-relaxed">
                    Saksikan keindahan alam, ragam budaya, dan perkembangan pembangunan desa-desa di seluruh Kabupaten
                    Manggarai Timur dalam format video.
                </p>
            </div>
        </div>
    </section>

    <!-- Featured DPMD Video -->
    @if($dpmdProfile && $dpmdProfile->video_promo_url)
        @php
            $dpmdVideoId = null;
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:watch\?v=|embed/|live/|v/|shorts/|[^/]+/.+/)|youtu\.be/)([^"&?/ ]{11})%i', $dpmdProfile->video_promo_url, $match)) {
                $dpmdVideoId = $match[1];
            }
        @endphp

        @if($dpmdVideoId)
            <section class="py-16 bg-slate-900 overflow-hidden relative">
                <!-- Decorative background -->
                <div class="absolute inset-0 opacity-20">
                    <div
                        class="absolute top-0 right-0 w-[500px] h-[500px] bg-emerald-500 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/2">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-blue-500 rounded-full blur-[120px] translate-y-1/2 -translate-x-1/2">
                    </div>
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="text-center mb-12">
                        <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">Video Utama: Profil Manggarai Timur</h2>
                        <div class="w-16 h-1 bg-red-500 mx-auto rounded-full"></div>
                    </div>

                    <div class="max-w-5xl mx-auto">
                        <div
                            class="relative w-full rounded-[2rem] md:rounded-[3.5rem] overflow-hidden shadow-[0_0_80px_rgba(0,0,0,0.5)] bg-black aspect-video border-4 md:border-8 border-slate-800/50">
                            <iframe class="absolute inset-0 w-full h-full"
                                src="https://www.youtube.com/embed/{{ $dpmdVideoId }}" title="Video Utama" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endif

    <!-- Village Videos Grid -->
    <section class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-16">
                <div>
                    <h2 class="text-3xl font-bold text-slate-800 mb-2">Promosi Desa</h2>
                    <p class="text-slate-500 text-sm italic">Video terbaru dari desa-desa di wilayah kami.</p>
                </div>
                <div class="hidden md:flex items-center gap-2 text-slate-400 text-sm font-medium">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    {{ $villages->count() }} Video Tersedia
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($villages as $village)
                    @php
                        $vId = null;
                        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:watch\?v=|embed/|live/|v/|shorts/|[^/]+/.+/)|youtu\.be/)([^"&?/ ]{11})%i', $village->video_youtube, $vMatch)) {
                            $vId = $vMatch[1];
                        }
                    @endphp

                    @if($vId)
                        <div class="group">
                            <div
                                class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-slate-100 flex flex-col h-full transform hover:-translate-y-2">
                                <div class="relative aspect-video">
                                    <img src="https://img.youtube.com/vi/{{ $vId }}/maxresdefault.jpg"
                                        onerror="this.src='https://img.youtube.com/vi/{{ $vId }}/0.jpg'"
                                        class="w-full h-full object-cover">
                                    <div
                                        class="absolute inset-0 bg-slate-900/40 group-hover:bg-slate-900/10 transition-colors flex items-center justify-center">
                                        <div
                                            class="w-16 h-16 bg-white/90 backdrop-blur-md rounded-full flex items-center justify-center text-red-600 shadow-xl group-hover:scale-110 transition-transform duration-500">
                                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="absolute bottom-4 left-4 right-4">
                                        <div
                                            class="px-3 py-1 bg-black/60 backdrop-blur-md text-white text-[10px] font-bold rounded-lg inline-block uppercase tracking-wider">
                                            Desa {{ $village->nama_desa }}
                                        </div>
                                    </div>
                                </div>
                                <div class="p-8 flex-grow flex flex-col">
                                    <h3
                                        class="text-xl font-bold text-slate-800 mb-4 line-clamp-2 leading-tight group-hover:text-emerald-600 transition-colors">
                                        Promosi & Potensi Wisata Desa {{ $village->nama_desa }}
                                    </h3>
                                    <div class="mt-auto flex items-center justify-between">
                                        <div class="text-xs text-slate-400 font-medium">
                                            Kec. {{ $village->kecamatan }}
                                        </div>
                                        <a href="{{ route('public.desa.profil', $village->id) }}"
                                            class="text-xs font-bold text-emerald-600 hover:text-emerald-700 underline underline-offset-4">
                                            Lihat Profil Desa →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div
                        class="col-span-full py-20 text-center bg-white rounded-[3rem] border-2 border-dashed border-slate-200">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <p class="text-slate-400 font-medium italic">Belum ada video promosi desa yang diunggah.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-slate-900 border-t border-slate-800">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-6">Punya Konten Video Desa Anda?</h2>
            <p class="text-slate-400 text-lg mb-10 leading-relaxed">
                Hubungi Admin SID untuk mendaftarkan channel YouTube resmi desa Anda atau unggah langsung melalui
                Dashboard Pengelola Desa.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('public.kontak') }}"
                    class="px-10 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-2xl transition-all shadow-lg shadow-emerald-500/20">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>
</x-layouts.public>