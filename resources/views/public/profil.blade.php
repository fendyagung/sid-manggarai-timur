<x-layouts.public>
    @php
        $profile = $profile ?? new \App\Models\DpmdProfile();
    @endphp
    <!-- Hero Section (Simple) -->
    <section class="relative pt-32 pb-20 bg-slate-950 overflow-hidden text-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-4">Profil Instansi DPMD</h1>
            <p class="text-emerald-400 text-lg md:text-xl font-medium uppercase tracking-widest">Kabupaten Manggarai
                Timur</p>
        </div>
        <!-- BG Elements -->
        <div
            class="absolute top-0 right-0 w-[500px] h-[500px] bg-emerald-500/10 rounded-full blur-[120px] -mr-64 -mt-64">
        </div>
        <div
            class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-blue-500/10 rounded-full blur-[100px] -ml-32 -mb-32">
        </div>
    </section>


    <!-- Kadis Greeting Section -->
    <section class="py-24 bg-white dark:bg-slate-900 overflow-hidden relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <!-- Photo Card -->
                <div class="w-full lg:w-1/2 flex justify-center">
                    <div class="relative">
                        <div class="absolute -inset-4 bg-emerald-500/20 rounded-[3rem] blur-2xl"></div>
                        <div
                            class="relative w-72 h-96 md:w-80 md:h-[30rem] rounded-[2.5rem] overflow-hidden border-4 border-white dark:border-slate-800 shadow-2xl">
                            @if($profile->foto_kadis)
                                <img src="{{ asset('storage/' . $profile->foto_kadis) }}" alt="Kepala Dinas PMD"
                                    class="w-full h-full object-cover">
                            @else
                                <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                                    alt="Kepala Dinas PMD" class="w-full h-full object-cover">
                            @endif
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-slate-950 to-transparent p-8 text-center">
                                <h3 class="text-xl font-bold text-white">
                                    {{ $profile->nama_kadis ?? 'Nama Kepala Dinas' }}
                                </h3>
                                <p class="text-emerald-400 text-sm font-medium">Kepala Dinas PMD Matim</p>
                            </div>
                        </div>
                        <!-- Decoration -->
                        <div
                            class="absolute -top-6 -right-6 w-24 h-24 bg-emerald-500 rounded-full mix-blend-screen filter blur-xl opacity-30 animate-pulse">
                        </div>
                    </div>
                </div>

                <!-- Text Content -->
                <div class="w-full lg:w-1/2">
                    <span
                        class="inline-block py-1 px-3 rounded-full bg-emerald-500/20 border border-emerald-400/30 text-emerald-600 dark:text-emerald-400 text-xs font-bold uppercase tracking-widest mb-6">
                        Kata Sambutan
                    </span>
                    <h1 class="text-4xl md:text-5xl font-bold mb-8 leading-tight text-slate-900 dark:text-white">
                        @if($profile->sambutan_judul)
                            {{ $profile->sambutan_judul }}
                        @else
                            Membangun Desa, <br>
                            <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500 dark:from-emerald-400 dark:to-teal-300">Sejahterakan
                                Rakyat</span>
                        @endif
                    </h1>
                    <div class="space-y-6 text-slate-600 dark:text-slate-300 text-lg leading-relaxed italic">
                        @if($profile->sambutan_teks)
                            {!! nl2br(e($profile->sambutan_teks)) !!}
                        @else
                            <p>"Selamat datang di Portal SID Manggarai Timur. Kami berkomitmen untuk terus
                                mendorong transparansi dan inovasi di setiap desa di Kabupaten Manggarai Timur."</p>
                            <p>"Melalui platform ini, kami mengintegrasikan keindahan pariwisata dengan akuntabilitas
                                laporan desa, demi menciptakan pemerintahan desa yang mandiri dan berdaya saing."</p>
                        @endif
                    </div>
                    <div class="mt-10 flex flex-wrap gap-4">
                        <div
                            class="flex items-center gap-3 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm rounded-2xl p-4">
                            <div
                                class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center font-bold text-white">
                                1</div>
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Inovasi Digital</span>
                        </div>
                        <div
                            class="flex items-center gap-3 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm rounded-2xl p-4">
                            <div
                                class="w-10 h-10 bg-teal-500 rounded-full flex items-center justify-center font-bold text-white">
                                2</div>
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Transparansi
                                Publik</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision & Mission Section -->
    <section class="py-24 bg-slate-50 dark:bg-slate-950 relative transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white mb-4">Visi & Misi</h2>
                <div class="w-20 h-1.5 bg-emerald-500 mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Visi Card -->
                <div
                    class="bg-white dark:bg-slate-800 p-10 rounded-[3rem] border border-slate-100 dark:border-slate-700 flex flex-col justify-center text-center transition-colors shadow-sm">
                    <div
                        class="mb-6 mx-auto w-16 h-16 bg-slate-50 dark:bg-slate-700 rounded-2xl shadow-lg flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 dark:text-white mb-6">Visi DPMD</h3>
                    <p class="text-slate-600 dark:text-slate-300 text-xl leading-relaxed font-medium italic">
                        "{{ $profile->visi ?? 'Terwujudnya Desa yang Mandiri dan Sejahtera.' }}"
                    </p>
                </div>

                <!-- Misi List -->
                <div class="space-y-6">
                    @php
                        $misiPoints = $profile->misi ? explode("\n", $profile->misi) : [];
                    @endphp
                    @forelse($misiPoints as $index => $point)
                        @if(trim($point))
                            <div
                                class="group flex items-start gap-6 p-6 bg-white dark:bg-slate-800 rounded-[2rem] border border-slate-100 dark:border-slate-700 hover:border-emerald-200 dark:hover:border-emerald-500/50 transition-all shadow-sm hover:shadow-xl">
                                <div
                                    class="flex-shrink-0 w-12 h-12 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-xl flex items-center justify-center font-bold text-xl group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                                    {{ $index + 1 }}
                                </div>
                                <div>
                                    <h4 class="text-lg font-bold text-slate-800 dark:text-white mb-2">
                                        {{ str_contains($point, ':') ? explode(':', $point)[0] : 'Misi' }}
                                    </h4>
                                    <p class="text-slate-500 dark:text-slate-400">
                                        {{ str_contains($point, ':') ? trim(explode(':', $point)[1]) : $point }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    @empty
                        <p class="text-slate-400 italic">Misi belum ditambahkan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Organizational Structure Preview -->
    <section class="py-24 bg-slate-50 dark:bg-slate-900/50 overflow-hidden transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 px-4">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white mb-4">Struktur Organisasi</h2>
                <p class="text-slate-500 dark:text-slate-400 max-w-2xl mx-auto">Sinergi tim profesional untuk membangun
                    desa yang lebih
                    baik.</p>
            </div>

            <!-- Team Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center px-4">
                <div class="group">
                    <div
                        class="w-24 h-24 md:w-32 md:h-32 bg-slate-200 rounded-full mx-auto mb-4 overflow-hidden border-4 border-white shadow-lg group-hover:border-emerald-500 transition-all">
                        <div class="w-full h-full flex items-center justify-center text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <h4 class="font-bold text-slate-800 dark:text-white text-sm md:text-base">
                        {{ $profile->nama_sekretaris ?? 'Sekretaris' }}
                    </h4>
                    <p
                        class="text-[10px] md:text-xs text-slate-500 dark:text-slate-400 uppercase font-bold tracking-widest">
                        Sekretaris
                        Dinas</p>
                </div>
                <div class="group">
                    <div
                        class="w-24 h-24 md:w-32 md:h-32 bg-slate-200 rounded-full mx-auto mb-4 overflow-hidden border-4 border-white shadow-lg group-hover:border-emerald-500 transition-all">
                        <div class="w-full h-full flex items-center justify-center text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <h4 class="font-bold text-slate-800 dark:text-white text-sm md:text-base">
                        {{ $profile->nama_kabid_pemberdayaan ?? 'Kabid' }}
                    </h4>
                    <p
                        class="text-[10px] md:text-xs text-slate-500 dark:text-slate-400 uppercase font-bold tracking-widest">
                        Bidang
                        Pemberdayaan</p>
                </div>
                <div class="group">
                    <div
                        class="w-24 h-24 md:w-32 md:h-32 bg-slate-200 rounded-full mx-auto mb-4 overflow-hidden border-4 border-white shadow-lg group-hover:border-emerald-500 transition-all">
                        <div class="w-full h-full flex items-center justify-center text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <h4 class="font-bold text-slate-800 dark:text-white text-sm md:text-base">
                        {{ $profile->nama_kabid_pemerintahan ?? 'Kabid' }}
                    </h4>
                    <p
                        class="text-[10px] md:text-xs text-slate-500 dark:text-slate-400 uppercase font-bold tracking-widest">
                        Bidang
                        Pemerintahan</p>
                </div>
                <div class="group">
                    <div
                        class="w-24 h-24 md:w-32 md:h-32 bg-slate-200 rounded-full mx-auto mb-4 overflow-hidden border-4 border-white shadow-lg group-hover:border-emerald-500 transition-all">
                        <div class="w-full h-full flex items-center justify-center text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <h4 class="font-bold text-slate-800 dark:text-slate-200 text-sm md:text-base">
                        {{ $profile->nama_kabid_ekonomi ?? 'Kabid' }}
                    </h4>
                    <p
                        class="text-[10px] md:text-xs text-slate-500 dark:text-slate-400 uppercase font-bold tracking-widest">
                        Bidang Ekonomi
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- DPMD Photo Gallery Section -->
    @if($profile && $profile->exists && $profile->galleries->where('type', 'foto')->count() > 0)
        <section class="py-24 bg-white dark:bg-slate-900 transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16 px-4">
                    <span class="text-emerald-500 font-bold uppercase tracking-widest text-xs">Dokumentasi</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white mt-2">Galeri Foto Kegiatan</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($profile->galleries->where('type', 'foto') as $photo)
                        <div
                            class="group relative aspect-[4/3] rounded-[2rem] overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500">
                            <img src="{{ asset('storage/' . $photo->url_or_path) }}"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-8">
                                <p class="text-white font-medium italic">DPMD Manggarai Timur</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- DPMD Video Gallery Section -->
    @if($profile && $profile->exists && $profile->galleries->where('type', 'video')->count() > 0)
        <section class="py-24 bg-slate-50 dark:bg-slate-950/50 transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16 px-4">
                    <span class="text-rose-500 font-bold uppercase tracking-widest text-xs">Video Edukasi & Info</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white mt-2">Galeri Video DPMD</h2>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    @foreach($profile->galleries->where('type', 'video') as $video)
                        @php
                            $videoId = '';
                            if (str_contains($video->url_or_path, 'v=')) {
                                parse_str(parse_url($video->url_or_path, PHP_URL_QUERY), $vars);
                                $videoId = $vars['v'] ?? '';
                            } elseif (str_contains($video->url_or_path, 'youtu.be/')) {
                                $videoId = explode('youtu.be/', $video->url_or_path)[1] ?? '';
                                if (str_contains($videoId, '?'))
                                    $videoId = explode('?', $videoId)[0];
                            }
                        @endphp
                        @if($videoId)
                            <div
                                class="bg-white dark:bg-slate-800 p-4 rounded-[2.5rem] shadow-xl border border-slate-100 dark:border-slate-700">
                                <div class="aspect-video rounded-2xl overflow-hidden shadow-inner">
                                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $videoId }}"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen></iframe>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Feedback CTA -->

    <section class="py-20 bg-[#2b529a] relative overflow-hidden">
        <div class="max-w-4xl mx-auto px-4 relative z-10 text-center">
            <h2 class="text-3xl font-bold text-white mb-6">Hubungi Kami</h2>
            <p class="text-blue-100 text-lg mb-8">Memiliki pertanyaan mengenai tata kelola desa atau potensi wisata?
                Kami siap melayani.</p>
            <a href="{{ route('public.kontak') }}"
                class="inline-flex items-center px-8 py-4 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-2xl transition-all shadow-lg shadow-emerald-500/20">
                Pusat Bantuan
            </a>
        </div>
    </section>
</x-layouts.public>