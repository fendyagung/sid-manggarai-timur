<x-layouts.public>
    <!-- Announcement Header -->
    <section class="pt-32 pb-16 bg-white dark:bg-slate-900">
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
                <h1 class="text-3xl md:text-5xl font-bold text-slate-900 dark:text-white leading-tight">
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
                        <div>{{ $announcement->created_at->isoFormat('D MMMM Y • H:i') }} WITA</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content -->
    <section class="py-20 bg-white dark:bg-slate-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg max-w-none text-slate-700 dark:text-slate-300 leading-relaxed font-serif">
                {!! nl2br(e($announcement->isi)) !!}
            </div>

            <div
                class="mt-20 pt-10 border-t border-slate-100 dark:border-slate-800 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="text-slate-400 text-xs italic">
                    Sumber: Dinas Pemberdayaan Masyarakat dan Desa (DPMD) Kabupaten Manggarai Timur
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>