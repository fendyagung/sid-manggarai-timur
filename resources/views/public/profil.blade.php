<x-layouts.public>
    @php
        $profile = $profile ?? new \App\Models\DpmdProfile();
    @endphp
    <!-- Combined Hero & Greeting Section -->
    <section class="relative min-h-[90vh] flex items-center pt-32 pb-24 bg-white dark:bg-[#020617] overflow-hidden">
        <!-- Decoration Background (Matching Homepage) -->
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-[120px] -mr-64 -mt-64"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-blue-500/10 rounded-full blur-[100px] -ml-32 -mb-32" style="animation-delay: 2s"></div>
        
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
                                <div class="absolute inset-x-0 bottom-0 p-8 bg-gradient-to-t from-slate-950 via-slate-900/60 to-transparent text-center">
                                    <h3 class="text-2xl font-black text-white tracking-tight leading-tight">
                                        {{ $profile->nama_kadis ?? 'Nama Kepala Dinas' }}
                                    </h3>
                                    <div class="flex items-center justify-center gap-3 mt-3">
                                        <span class="w-6 h-px bg-emerald-500/50"></span>
                                        <p class="text-emerald-400 text-[10px] font-black uppercase tracking-[0.2em]">Kepala Dinas PMD</p>
                                        <span class="w-6 h-px bg-emerald-500/50"></span>
                                    </div>
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
                            <h1 class="font-serif leading-tight text-slate-900 dark:text-white">
                                <span class="block text-2xl md:text-3xl font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-widest mb-2">Membangun Desa</span>
                                <span class="block text-4xl md:text-6xl font-black">Membangun <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 via-emerald-500 to-blue-600">Indonesia</span></span>
                                <span class="block text-xl md:text-2xl font-medium italic text-slate-500 dark:text-slate-400 mt-4">"Desa Maju, Rakyat Sejahtera"</span>
                            </h1>
                        </div>

                        <div class="relative">
                            <div class="absolute -left-6 top-0 bottom-0 w-1 bg-gradient-to-b from-emerald-500 to-transparent opacity-30"></div>
                            <div class="text-slate-600 dark:text-slate-300 text-lg leading-relaxed font-serif pl-0 md:pl-4 border-l-4 border-emerald-500/20">
                                @php
                                    $teks = $profile->sambutan_teks;
                                    // Hilangkan kalimat branding dari teks sambutan jika ada untuk dipindah ke section khusus
                                    $teksClean = preg_replace('/Branding Dinas PMD:.*?\./s', '', $teks);
                                    $teksClean = trim($teksClean);
                                @endphp
                                {!! nl2br(e($teksClean)) !!}
                            </div>

                            <!-- HEPI Branding Section - Styled Neatly -->
                            <div class="pt-8">
                                <div class="bg-gradient-to-br from-emerald-50 to-blue-50 dark:from-emerald-900/10 dark:to-blue-900/10 p-8 rounded-[2rem] border border-emerald-100/50 dark:border-emerald-500/10">
                                    <div class="flex items-center gap-3 mb-6">
                                        <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-emerald-500/20">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-xs font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-widest">Branding Dinas PMD</h3>
                                            <p class="text-lg font-bold text-slate-800 dark:text-white">Desa Melayani dengan <span class="text-emerald-600">"HEPI"</span></p>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                                        @foreach([
                                            ['H', 'Humanis', 'bg-white border border-emerald-500/20 text-emerald-600'],
                                            ['E', 'Edukatif', 'bg-blue-500 text-white'],
                                            ['P', 'Profesional', 'bg-emerald-500 text-white'],
                                            ['I', 'Inovatif', 'bg-amber-500 text-white']
                                        ] as $item)
                                            <div class="text-center group">
                                                <div class="w-12 h-12 {{ $item[2] }} mx-auto rounded-xl flex items-center justify-center font-black text-xl mb-2 shadow-lg group-hover:scale-110 transition-transform">
                                                    {{ $item[0] }}
                                                </div>
                                                <span class="text-[10px] font-black uppercase text-slate-500 tracking-tighter">{{ $item[1] }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
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
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white mb-4">Visi & Misi Bupati & Wakil Bupati</h2>
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
                    <h3 class="text-2xl font-bold text-slate-800 dark:text-white mb-6">Visi</h3>
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

    <!-- Organizational Structure Section -->
    <section class="py-24 bg-white dark:bg-[#020617] relative overflow-hidden transition-colors duration-300">
        <!-- Background Decorations -->
        <div class="absolute top-1/2 left-0 w-96 h-96 bg-emerald-500/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute top-1/2 right-0 w-96 h-96 bg-blue-500/5 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-20 reveal">
                <span class="text-emerald-500 font-black uppercase tracking-[0.3em] text-[10px]">Struktur Organisasi</span>
                <h2 class="text-3xl md:text-5xl font-serif font-black text-slate-900 dark:text-white mt-4">Bagan Kepemimpinan DPMD</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-4 max-w-2xl mx-auto text-sm">Sinergi kepemimpinan dalam mewujudkan pemberdayaan masyarakat desa yang mandiri dan kompetitif.</p>
                <div class="w-16 h-1.5 bg-gradient-to-r from-emerald-500 to-blue-500 mx-auto rounded-full mt-8"></div>
            </div>

            @php
                $allStaff = $profile->staffs()->where('is_active', true)->get()->map(function($s) {
                    $s->jabatan_upper = strtoupper(trim($s->jabatan));
                    return $s;
                });

                $kadis = (object)[
                    'nama' => $profile->nama_kadis ?? 'Gaspar Nanggar, S.ST',
                    'jabatan' => 'Kepala Dinas',
                    'foto' => $profile->foto_kadis,
                    'nip' => $profile->nip_kadis,
                    'pangkat' => $profile->pangkat_kadis
                ];
                
                $sekretaris = $allStaff->filter(fn($s) => str_contains($s->jabatan_upper, 'SEKR') || str_contains($s->jabatan_upper, 'SEKERTARIS'))->first();
                $kasubagKepegawaian = $allStaff->filter(fn($s) => str_contains($s->jabatan_upper, 'KEPEGAWAIAN') && (str_contains($s->jabatan_upper, 'SUB') || str_contains($s->jabatan_upper, 'KASUBAG')))->first();
                $kasubagKeuangan = $allStaff->filter(fn($s) => str_contains($s->jabatan_upper, 'KEUANGAN') && (str_contains($s->jabatan_upper, 'SUB') || str_contains($s->jabatan_upper, 'KASUBAG')))->first();
                $kabidPemerintahan = $allStaff->filter(fn($s) => str_contains($s->jabatan_upper, 'PEMERINTAHAN') && str_contains($s->jabatan_upper, 'BIDANG'))->first();
                $kabidPenataan = $allStaff->filter(fn($s) => str_contains($s->jabatan_upper, 'PENATAAN') && str_contains($s->jabatan_upper, 'BIDANG'))->first();
                $kabidPemberdayaan = $allStaff->filter(fn($s) => str_contains($s->jabatan_upper, 'PEMBERDAYAAN') && str_contains($s->jabatan_upper, 'BIDANG'))->first();
                
                // Functional Group (Fungsional) - excluding those already picked above
                $pickedIds = collect([
                    $sekretaris?->id, 
                    $kasubagKepegawaian?->id, 
                    $kasubagKeuangan?->id, 
                    $kabidPemerintahan?->id, 
                    $kabidPenataan?->id, 
                    $kabidPemberdayaan?->id
                ])->filter();

                $staffFungsional = $allStaff->whereNotIn('id', $pickedIds);
            @endphp

            <style>
                .reveal {
                    opacity: 0;
                    transform: translateY(30px);
                    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
                }
                .reveal.active {
                    opacity: 1;
                    transform: translateY(0);
                }
            </style>

            <!-- CSS ORG CHART -->
            <div class="flex flex-col items-center gap-12 w-full">
                
                <!-- LEVEL 1: KEPALA DINAS -->
                <div class="relative group reveal">
                    <div class="relative p-8 bg-white dark:bg-slate-900 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 w-72 md:w-80 border-2 border-emerald-500/30">
                        <div class="space-y-1.5 text-center">
                            <h4 class="font-black text-black dark:text-white leading-tight text-[12px] uppercase">{{ $kadis->nama }}</h4>
                            <div class="pt-2 border-t border-slate-100 dark:border-slate-800">
                                <span class="font-black uppercase tracking-widest italic text-black dark:text-white text-[10px]">Kepala Dinas</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- LEVEL 2 & 3: MIDDLE MANAGEMENT (Asymmetrical Tree) -->
                <div class="relative w-full max-w-6xl mx-auto">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-start">
                        
                        <!-- LEFT SIDE: KELOMPOK JABATAN FUNGSIONAL -->
                        <div class="flex flex-col items-center">
                            <div class="w-full max-w-[360px] p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm hover:shadow-md transition-shadow reveal" style="transition-delay: 0.1s">
                                <div class="space-y-4">
                                    <div class="pb-3 border-b border-slate-50 dark:border-slate-800 text-center">
                                        <span class="font-black uppercase tracking-widest italic text-black dark:text-white text-[10px]">Kelompok Jabatan Fungsional</span>
                                    </div>
                                    <ul class="grid grid-cols-1 gap-1.5 text-left list-none">
                                        @foreach($staffFungsional->take(11) as $index => $staff)
                                        <li class="flex gap-2 text-[10px] text-slate-700 dark:text-slate-300 font-bold uppercase leading-tight">
                                            <span class="w-4 text-slate-400 font-medium">{{ $index + 1 }}.</span>
                                            <span>{{ $staff->nama }}</span>
                                        </li>
                                        @endforeach
                                        
                                        @if($staffFungsional->isEmpty())
                                            @php
                                                $fallbackNames = [
                                                    'ALEKSANDER TANDUNG, S. PT', 'VITALIS JEBARUS', 'YOHANES TRIATMA, S.SOS',
                                                    'GRADIANA I.H.MURNIATI, SE', 'FRANSISKUS SIMAN, S.IP', 'FLORIANUS MASRUL, SE',
                                                    'WILHELMUS RAMBUNG, S.SOS', 'FIDENSIANUS SARU', 'SERVASIUS DAUD, S.IP',
                                                    'VINSENSIA PRISCILLA SASMITA, S.IP', 'ALFIANUS HAMIN, S.M'
                                                ];
                                            @endphp
                                            @foreach($fallbackNames as $index => $name)
                                            <li class="flex gap-2 text-[10px] text-slate-700 dark:text-slate-300 font-bold uppercase leading-tight">
                                                <span class="w-4 text-slate-400 font-medium">{{ $index + 1 }}.</span>
                                                <span>{{ $name }}</span>
                                            </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT SIDE: SEKRETARIAT -->
                        <div class="flex flex-col items-center gap-8">
                            <!-- Sekretaris Box -->
                            <div class="relative group reveal" style="transition-delay: 0.2s">
                                <div class="relative p-8 bg-white dark:bg-slate-900 rounded-2xl shadow-md border-2 border-blue-500/30 text-center w-72 md:w-80">
                                    <div class="space-y-1.5">
                                        <h4 class="font-black leading-tight text-black dark:text-white text-[12px] uppercase">{{ $sekretaris->nama ?? 'Nama Sekretaris' }}</h4>
                                        <div class="pt-2 border-t border-slate-50 dark:border-slate-800">
                                            <span class="font-black uppercase tracking-widest italic text-black dark:text-white text-[10px]">Sekretaris</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sub Bagian Level (L+R) -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full">
                                <!-- Sub Bagian 1 -->
                                <div class="reveal" style="transition-delay: 0.3s">
                                    <div class="p-6 bg-slate-50/50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 rounded-2xl text-center min-h-[140px] flex flex-col justify-center">
                                        <h4 class="text-black dark:text-white font-bold text-[11px] uppercase leading-tight mb-2">{{ $kasubagKepegawaian->nama ?? '-' }}</h4>
                                        <div class="pt-2 border-t border-slate-100 dark:border-slate-800">
                                            <span class="font-bold uppercase tracking-widest italic text-slate-500 dark:text-slate-400 text-[9px] leading-tight">Sub Bagian <br> Kepegawaian Dan Umum</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sub Bagian 2 -->
                                <div class="reveal" style="transition-delay: 0.4s">
                                    <div class="p-6 bg-slate-50/50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 rounded-2xl text-center min-h-[140px] flex flex-col justify-center">
                                        <h4 class="text-black dark:text-white font-bold text-[11px] uppercase leading-tight mb-2">{{ $kasubagKeuangan->nama ?? '-' }}</h4>
                                        <div class="pt-2 border-t border-slate-100 dark:border-slate-800">
                                            <span class="font-bold uppercase tracking-widest italic text-slate-500 dark:text-slate-400 text-[9px] leading-tight">Sub Bagian <br> Keuangan</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BOTTOM LEVEL: BIDANG-BIDANG -->
                    <div class="mt-16 pt-12 border-t border-slate-200/60 dark:border-slate-800/60">
                        <div class="text-center mb-10">
                            <span class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Unsur Pelaksana Teknis</span>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                            
                            <!-- BIDANG 1 -->
                            <div class="flex flex-col items-center reveal" style="transition-delay: 0.5s">
                                <div class="p-8 bg-white dark:bg-slate-900 border-2 border-amber-500/30 rounded-2xl shadow-sm hover:shadow-md transition-all text-center w-full min-h-[180px] flex flex-col group">
                                    <div class="mb-auto">
                                        <h4 class="font-black leading-tight text-black dark:text-white text-[12px] uppercase">{{ $kabidPemerintahan->nama ?? 'Nama Kabid' }}</h4>
                                    </div>
                                    <div class="pt-4 border-t border-slate-50 dark:border-slate-800">
                                        <span class="font-black tracking-widest italic text-black dark:text-white text-[10px] leading-tight flex items-center justify-center min-h-[2.5rem]">Bidang <br> Pemerintahan Desa</span>
                                    </div>
                                </div>
                            </div>

                            <!-- BIDANG 2 -->
                            <div class="flex flex-col items-center reveal" style="transition-delay: 0.6s">
                                <div class="p-8 bg-white dark:bg-slate-900 border-2 border-emerald-500/30 rounded-2xl shadow-sm hover:shadow-md transition-all text-center w-full min-h-[180px] flex flex-col group">
                                    <div class="mb-auto">
                                        <h4 class="font-black leading-tight text-black dark:text-white text-[12px] uppercase">{{ $kabidPenataan->nama ?? 'Nama Kabid' }}</h4>
                                    </div>
                                    <div class="pt-4 border-t border-slate-50 dark:border-slate-800">
                                        <span class="font-black tracking-widest italic text-black dark:text-white text-[10px] leading-tight flex items-center justify-center min-h-[2.5rem]">Bidang <br> Penataan dan kerja sama Desa</span>
                                    </div>
                                </div>
                            </div>

                            <!-- BIDANG 3 -->
                            <div class="flex flex-col items-center reveal" style="transition-delay: 0.7s">
                                <div class="p-8 bg-white dark:bg-slate-900 border-2 border-blue-500/30 rounded-2xl shadow-sm hover:shadow-md transition-all text-center w-full min-h-[180px] flex flex-col group">
                                    <div class="mb-auto">
                                        <h4 class="font-black leading-tight text-black dark:text-white text-[12px] uppercase">{{ $kabidPemberdayaan->nama ?? 'Nama Kabid' }}</h4>
                                    </div>
                                    <div class="pt-4 border-t border-slate-50 dark:border-slate-800">
                                        <span class="font-black tracking-widest italic text-black dark:text-white text-[10px] leading-tight flex items-center justify-center min-h-[2.5rem]">Bidang <br> pemberdayaan Lembaga Kemasyarakatan (PLK)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- DOWNLOAD BUTTON FOR ORIGINAL IMAGE -->
                @if($profile->foto_struktur)
                <div class="mt-12 reveal">
                    <a href="{{ asset('storage/' . $profile->foto_struktur) }}" target="_blank" class="inline-flex items-center gap-2 text-xs font-black text-slate-400 hover:text-emerald-500 transition-colors uppercase tracking-[0.2em] group">
                        <span>📥</span> Unduh Bagan Format Gambar
                        <span class="w-8 h-px bg-slate-200 group-hover:bg-emerald-500 transition-colors"></span>
                    </a>
                </div>
                @endif

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
                                <p class="text-white font-bold text-xs uppercase tracking-widest">Dokumentasi Berita</p>
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