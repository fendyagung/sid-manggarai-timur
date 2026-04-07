<x-layouts.public>
    @php
        // Calculate Reading Time (Simple: ~200 words per minute)
        $wordCount = str_word_count(strip_tags($announcement->isi));
        $readTime = max(1, ceil($wordCount / 200));
    @endphp

    <!-- Article Header & Background -->
    <section class="pt-32 pb-12 bg-slate-50 dark:bg-slate-900/50 transition-colors">
        <div class="max-w-4xl mx-auto px-6">
            <!-- Navigation Back -->
            <a href="{{ route('public.home') }}#pengumuman" 
               class="inline-flex items-center gap-2 text-slate-400 hover:text-emerald-600 font-bold mb-10 transition-all group text-sm uppercase tracking-widest">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>

            <!-- Announcement Meta & Title -->
            <div class="text-center space-y-6 mb-12">
                <span class="inline-block px-4 py-1.5 {{ $announcement->tipe === 'penting' ? 'bg-amber-50 text-amber-700 border-amber-100' : ($announcement->tipe === 'darurat' ? 'bg-rose-50 text-rose-700 border-rose-100' : 'bg-emerald-50 text-emerald-700 border-emerald-100') }} text-[11px] font-black rounded-full uppercase tracking-[0.2em] border shadow-sm">
                    {{ $announcement->tipe ?? 'Info' }}
                </span>
                
                <h1 class="text-3xl md:text-5xl font-black text-slate-900 dark:text-white leading-[1.1] font-serif max-w-3xl mx-auto">
                    {{ $announcement->judul }}
                </h1>

                <!-- Detail Meta Row -->
                <div class="flex flex-wrap items-center justify-center gap-6 pt-4 text-slate-400 text-[11px] font-bold uppercase tracking-widest border-t border-slate-200 dark:border-slate-800">
                    <div class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $announcement->created_at->isoFormat('D MMM YYYY') }}
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253" />
                        </svg>
                        {{ $readTime }} Menit Baca
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        {{ number_format($announcement->views) }} Kali Dilihat
                    </div>
                </div>
            </div>

            <!-- Main Featured Image -->
            @if($announcement->foto)
                <div class="relative rounded-[2.5rem] overflow-hidden shadow-2xl mb-16 aspect-video group">
                    <img src="{{ asset('storage/' . $announcement->foto) }}" 
                         alt="{{ $announcement->judul }}" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                </div>
            @endif
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="pb-24 bg-white dark:bg-slate-900 transition-colors">
        <div class="max-w-4xl mx-auto px-6">
            <!-- Article Body -->
            <article class="prose prose-lg dark:prose-invert max-w-none text-slate-700 dark:prose-p:text-slate-300 leading-relaxed font-lora mb-20 text-justify">
                {!! nl2br(e($announcement->isi)) !!}
            </article>

            <!-- Attachment Section (PDF Viewer) -->
            @if($announcement->file_path)
                <div class="space-y-8 animate-fadeIn -mx-4 md:-mx-12 lg:-mx-20">
                    <div class="flex items-center justify-between border-b pb-6 border-slate-100 dark:border-slate-800 px-6">
                        <h3 class="text-2xl font-black text-slate-900 dark:text-white flex items-center gap-3 font-serif">
                            <span class="w-12 h-12 bg-rose-500 rounded-2xl flex items-center justify-center text-white text-xl shadow-xl shadow-rose-500/20">📄</span>
                            Berita Utama Terlampir
                        </h3>
                        <a href="{{ asset('storage/' . $announcement->file_path) }}" 
                           download
                           class="px-8 py-4 bg-slate-900 hover:bg-emerald-800 text-white text-[10px] font-black rounded-2xl transition-all flex items-center gap-2 tracking-[0.2em] shadow-2xl">
                           UNDUH DOKUMEN PDF
                        </a>
                    </div>

                    <div class="bg-slate-900 rounded-[3rem] overflow-hidden shadow-2xl border border-slate-800 p-1 lg:p-2 relative group mx-4">
                        <!-- Pop-out Icon (Precision style like example) -->
                        <a href="{{ asset('storage/' . $announcement->file_path) }}" target="_blank" 
                           class="absolute top-6 right-6 z-10 w-12 h-12 bg-black/60 hover:bg-black text-white rounded-xl flex items-center justify-center border border-white/10 transition-all shadow-2xl hover:scale-110"
                           title="Buka Penuh">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>

                        <div class="relative h-[1200px] md:h-[2000px] w-full rounded-[2.5rem] overflow-hidden bg-slate-900">
                             <!-- PDF Loader Frame -->
                            <iframe src="{{ asset('storage/' . $announcement->file_path) }}" 
                                    class="w-full h-full border-none bg-slate-900"
                                    title="Pratinjau Dokumen">
                                <div class="p-20 text-center text-white">
                                    <p class="font-bold mb-4 text-slate-500">Pratinjau tidak tersedia di browser ini.</p>
                                    <a href="{{ asset('storage/' . $announcement->file_path) }}" class="text-emerald-400 underline lowercase">Klik di sini untuk unduh</a>
                                </div>
                            </iframe>
                        </div>
                        
                        <!-- Mobile Download Helper -->
                        <div class="p-6 text-center bg-slate-900/80">
                            <p class="text-slate-500 text-[10px] uppercase font-black tracking-[0.3em]">Gunakan mode landscape untuk pratinjau yang lebih baik</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Footer Meta -->
            <div class="mt-20 pt-12 border-t border-slate-100 dark:border-slate-800">
                <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center text-white font-black shadow-lg">
                            {{ substr($announcement->user->name ?? 'A', 0, 1) }}
                        </div>
                        <div>
                            <p class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-widest">Diterbitkan Oleh</p>
                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $announcement->user->name ?? 'Dinas PMD Manggarai Timur' }}</p>
                        </div>
                    </div>
                    
                    <!-- Attribution -->
                    <div class="text-right">
                        <p class="text-[10px] text-slate-400 dark:text-slate-600 italic leading-relaxed">
                            Sumber Resmi: Dinas Pemberdayaan Masyarakat dan Desa (DPMD)<br>
                            Kabupaten Manggarai Timur — Prov. Nusa Tenggara Timur
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .font-lora { font-family: 'Lora', serif; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fadeIn { animation: fadeIn 0.8s ease-out forwards; }
    </style>
</x-layouts.public>