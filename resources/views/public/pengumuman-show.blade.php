<x-layouts.public>
    <!-- Announcement Header -->
    <section class="pt-32 pb-4 bg-white dark:bg-slate-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('public.home') }}#pengumuman"
                class="inline-flex items-center gap-2 text-slate-400 hover:text-emerald-600 font-bold mb-8 transition-colors group">
                <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>

            <div class="space-y-6">
                <span
                    class="inline-block px-3 py-1 {{ $announcement->tipe === 'penting' ? 'bg-red-50 text-red-700 border-red-100' : 'bg-blue-50 text-blue-700 border-blue-100' }} text-[10px] font-bold rounded-full uppercase tracking-widest border">
                    {{ $announcement->tipe ?? 'Info' }}
                </span>
                <h1 class="text-2xl md:text-4xl font-bold text-slate-900 dark:text-white leading-tight">
                    {{ $announcement->judul }}
                </h1>
                <div
                    class="flex items-center gap-4 text-slate-500 text-sm font-medium pt-4 border-t border-slate-100 dark:border-slate-800">
                    <div
                        class="w-10 h-10 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center text-slate-400 font-bold uppercase">
                        {{ substr($announcement->user->name ?? 'D', 0, 1) }}
                    </div>
                    <div>
                        <div class="text-slate-900 dark:text-slate-200 font-bold">
                            {{ $announcement->user->name ?? 'Admin DMPD' }}</div>
                        <div>{{ $announcement->created_at->isoFormat('D MMMM Y') }} • {{ $announcement->created_at->format('H:i') }} WITA</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content -->
    <section class="pt-0 pb-20 bg-white dark:bg-slate-900 transition-colors">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg max-w-none text-slate-700 dark:text-slate-300 leading-relaxed font-serif">
                {!! nl2br(e($announcement->isi)) !!}
            </div>

            @if($announcement->file_path)
                <div class="mt-4">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        Lampiran Dokumen
                    </h3>
                    
                    <div class="bg-slate-100 dark:bg-slate-800 rounded-3xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-inner">
                        <div class="p-4 bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 flex justify-between items-center">
                            <span class="text-sm font-bold text-slate-600 dark:text-slate-400 truncate max-w-xs">
                                {{ $announcement->original_name ?? 'dokumen.pdf' }}
                            </span>
                            <div class="flex flex-col items-end flex-shrink-0">
                                <a href="{{ asset('storage/' . $announcement->file_path) }}" target="_blank" 
                                    class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl transition-all flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    Download PDF
                                </a>
                            </div>
                        </div>
                        
                        <!-- PDF Viewer -->
                        <div class="h-[800px] w-full bg-slate-200 dark:bg-slate-900 flex items-center justify-center relative">
                            <iframe src="{{ asset('storage/' . $announcement->file_path) }}" 
                                class="w-full h-full border-none shadow-lg"
                                title="Pratinjau Dokumen">
                                <p>Browser Anda tidak mendukung pratinjau PDF. 
                                   <a href="{{ asset('storage/' . $announcement->file_path) }}">Klik di sini untuk mengunduh.</a>
                                </p>
                            </iframe>
                        </div>

                        <!-- Mobile Tip positioned at bottom right (Icon only) -->
                        <div class="p-3 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-200 dark:border-slate-700 flex justify-end md:hidden">
                            <a href="{{ asset('storage/' . $announcement->file_path) }}" target="_blank"
                                class="p-2 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 hover:text-emerald-700 hover:bg-emerald-100 transition-all rounded-lg"
                                title="Lihat Full PDF">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
@endif

            <div
                class="mt-20 pt-10 border-t border-slate-100 dark:border-slate-800 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="text-slate-400 text-xs italic">
                    Sumber: Dinas Pemberdayaan Masyarakat dan Desa (DPMD) Kabupaten Manggarai Timur
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>