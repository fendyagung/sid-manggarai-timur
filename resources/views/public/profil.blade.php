<x-layouts.public>
    @php
        $profile = $profile ?? new \App\Models\DpmdProfile();
    @endphp
    <!-- Combined Hero & Greeting Section -->
    <section class="relative min-h-[90vh] flex items-center pt-32 pb-24 bg-white dark:bg-[#020617] overflow-hidden">
        <!-- Decoration Background (Matching Homepage) -->
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-[120px] -mr-64 -mt-64 animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-blue-500/10 rounded-full blur-[100px] -ml-32 -mb-32 animate-pulse" style="animation-delay: 2s"></div>
        
        <!-- Decorative Floating Dots -->
        <div class="absolute inset-0 z-0 pointer-events-none opacity-20">
            <div class="absolute top-1/4 left-10 w-2 h-2 bg-emerald-400 rounded-full animate-ping"></div>
            <div class="absolute top-1/2 right-20 w-3 h-3 bg-blue-400 rounded-full animate-bounce"></div>
            <div class="absolute bottom-1/4 left-1/2 w-2 h-2 bg-amber-400 rounded-full animate-pulse"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
                <!-- PHOTO AREA with Glassmorphism Effect -->
                <div class="w-full lg:w-5/12 reveal">
                    <div class="relative group">
                        <!-- Abstract Shapes behind photo -->
                        <div class="absolute -inset-4 bg-gradient-to-tr from-emerald-500/20 to-blue-500/20 rounded-[3rem] blur-2xl group-hover:scale-110 transition-transform duration-1000"></div>
                        
                        <div class="relative p-2 bg-white/40 dark:bg-white/5 backdrop-blur-xl border border-white/60 dark:border-white/10 rounded-[3rem] shadow-2xl overflow-hidden">
                            <div class="aspect-[4/5] rounded-[2.5rem] overflow-hidden relative">
                                @if($profile->foto_kadis)
                                    <img src="{{ asset('storage/' . $profile->foto_kadis) }}" alt="Kepala Dinas PMD"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <div class="w-full h-full bg-emerald-50 dark:bg-emerald-950/20 flex items-center justify-center text-8xl">👤</div>
                                @endif
                                
                                <!-- Modern Badge Overlay -->
                                <div class="absolute inset-x-0 bottom-0 p-8 bg-gradient-to-t from-slate-950 via-slate-900/40 to-transparent">
                                    <h3 class="text-2xl font-black text-white tracking-tight leading-tight">
                                        {{ $profile->nama_kadis ?? 'Nama Kepala Dinas' }}
                                    </h3>
                                    <div class="flex items-center gap-2 mt-2">
                                        <span class="w-8 h-px bg-emerald-500"></span>
                                        <p class="text-emerald-400 text-xs font-black uppercase tracking-widest">Kepala Dinas PMD</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Micro-Card -->
                        <div class="absolute -right-6 top-1/2 -translate-y-1/2 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border border-white dark:border-slate-800 p-4 rounded-2xl shadow-xl hidden md:block">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center text-white text-xl">✨</div>
                                <div>
                                    <p class="text-[10px] text-slate-400 font-black uppercase tracking-tighter">Visi Kami</p>
                                    <p class="text-xs font-bold text-slate-800 dark:text-white">Membangun dari Desa</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TEXT CONTENT AREA -->
                <div class="w-full lg:w-7/12 reveal" style="transition-delay: 0.2s">
                    <div class="space-y-8">
                        <div>
                            <span class="inline-flex items-center gap-2 py-2 px-4 rounded-full bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-100 dark:border-emerald-800 text-emerald-600 dark:text-emerald-400 text-[10px] font-black uppercase tracking-[0.2em]">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                                Profil Instansi dpmd
                            </span>
                            <h1 class="text-5xl md:text-7xl font-serif font-black mt-6 leading-tight text-slate-900 dark:text-white">
                                @if($profile->sambutan_judul)
                                    {{ $profile->sambutan_judul }}
                                @else
                                    Membangun <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500">Desa</span>, <br>
                                    Sejahterakan <span class="italic font-normal">Rakyat</span>
                                @endif
                            </h1>
                        </div>

                        <div class="relative">
                            <div class="absolute -left-6 top-0 bottom-0 w-1 bg-gradient-to-b from-emerald-500 to-transparent opacity-30"></div>
                            <div class="text-slate-600 dark:text-slate-300 text-xl leading-relaxed italic font-medium font-serif pl-0 md:pl-4">
                                @if($profile->sambutan_teks)
                                    "{!! nl2br(e($profile->sambutan_teks)) !!}"
                                @else
                                    <p>"Selamat datang di Portal SID Manggarai Timur. Kami terus berinovasi untuk mendorong transparansi dan kemandirian tata kelola pemerintahan desa di seluruh wilayah."</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-4 pt-4">
                            <div class="flex flex-col">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Kabupaten</span>
                                <span class="text-sm font-bold text-slate-800 dark:text-white">Manggarai Timur</span>
                            </div>
                            <div class="w-px h-10 bg-slate-200 dark:bg-slate-800"></div>
                            <div class="flex flex-col">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Status</span>
                                <span class="text-sm font-bold text-emerald-600">Terverifikasi SIPD</span>
                            </div>
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
    <section class="py-24 bg-slate-50 dark:bg-[#020617] overflow-hidden transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 px-4 reveal">
                <span class="text-emerald-500 font-black uppercase tracking-[0.3em] text-[10px]">Struktur Pemerintahan</span>
                <h2 class="text-3xl md:text-5xl font-serif font-black text-slate-900 dark:text-white mt-4">Organisasi DPMD</h2>
                <div class="w-16 h-1 bg-gradient-to-r from-emerald-500 to-blue-500 mx-auto rounded-full mt-6"></div>
            </div>

            <!-- Team Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 px-4">
                @forelse($profile->staffs()->where('is_active', true)->orderBy('urutan')->get() as $staff)
                    <div class="group reveal" style="transition-delay: {{ $loop->index * 0.1 }}s">
                        <div class="relative p-6 bg-white/60 dark:bg-white/5 backdrop-blur-md border border-white/80 dark:border-white/10 rounded-[2.5rem] shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 text-center overflow-hidden">
                            <!-- Shine effect on hover -->
                            <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            
                            <div class="relative z-10">
                                <div class="w-28 h-28 mx-auto mb-6 rounded-3xl overflow-hidden ring-4 ring-emerald-500/10 group-hover:ring-emerald-500/30 transition-all shadow-inner">
                                    @if($staff->foto)
                                        <img src="{{ asset('storage/' . $staff->foto) }}" alt="{{ $staff->nama }}"
                                            class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-4xl bg-emerald-50 dark:bg-emerald-900/20 text-emerald-300">👤</div>
                                    @endif
                                </div>
                                <h4 class="font-bold text-slate-800 dark:text-white text-base mb-1 tracking-tight">
                                    {{ $staff->nama }}
                                </h4>
                                <p class="text-[9px] text-emerald-600 dark:text-emerald-400 font-black uppercase tracking-widest bg-emerald-50 dark:bg-emerald-900/30 py-1.5 px-3 rounded-full inline-block">
                                    {{ $staff->jabatan }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20 bg-white/40 dark:bg-white/5 backdrop-blur-md rounded-[3rem] border-2 border-dashed border-slate-200 dark:border-slate-800">
                        <p class="text-slate-400 italic font-medium">Data struktur organisasi belum tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Dynamic Gallery Section -->
    @if($profile && $profile->exists && $profile->galleries->count() > 0)
        <section class="py-24 bg-white dark:bg-[#020617] transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-20 px-4 reveal">
                    <span class="text-emerald-500 font-black uppercase tracking-[0.3em] text-[10px]">Dokumentasi</span>
                    <h2 class="text-3xl md:text-5xl font-serif font-black text-slate-900 dark:text-white mt-4">Galeri DPMD</h2>
                    <div class="w-16 h-1 bg-gradient-to-r from-emerald-500 to-blue-500 mx-auto rounded-full mt-6"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Photos with premium styling -->
                    @foreach($profile->galleries->where('type', 'foto')->take(6) as $photo)
                        <div class="group relative aspect-[4/3] rounded-[2.5rem] overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-700 reveal" style="transition-delay: {{ $loop->index * 0.1 }}s">
                            <img src="{{ asset('storage/' . $photo->url_or_path) }}"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-1000">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-8">
                                <div class="w-8 h-px bg-emerald-500 mb-2"></div>
                                <p class="text-white font-bold text-xs uppercase tracking-widest">Dokumentasi Kegiatan</p>
                            </div>
                        </div>
                    @endforeach

                    <!-- Video Containers -->
                    @foreach($profile->galleries->where('type', 'video')->take(2) as $video)
                        @php
                            $videoId = '';
                            if (str_contains($video->url_or_path, 'v=')) {
                                parse_str(parse_url($video->url_or_path, PHP_URL_QUERY), $vars);
                                $videoId = $vars['v'] ?? '';
                            } elseif (str_contains($video->url_or_path, 'youtu.be/')) {
                                $videoId = explode('youtu.be/', $video->url_or_path)[1] ?? '';
                                if (str_contains($videoId, '?')) $videoId = explode('?', $videoId)[0];
                            }
                        @endphp
                        @if($videoId)
                            <div class="lg:col-span-2 bg-white/40 dark:bg-white/5 backdrop-blur-xl p-4 rounded-[3rem] shadow-xl border border-white dark:border-white/10 reveal" style="transition-delay: 0.3s">
                                <div class="aspect-video rounded-[2rem] overflow-hidden shadow-inner ring-1 ring-slate-200/50 dark:ring-slate-700/50">
                                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $videoId }}"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen></iframe>
                                </div>
                            </div>
                        @else
                            <div class="group relative aspect-video rounded-[3rem] overflow-hidden bg-slate-100 dark:bg-slate-800 flex flex-col items-center justify-center p-8 border border-dashed border-slate-200 dark:border-slate-700 reveal">
                                <div class="text-4xl mb-4">📺</div>
                                <p class="text-slate-400 italic text-sm text-center font-medium">Pratinjau video tidak dapat dimuat</p>
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