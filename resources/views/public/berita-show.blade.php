<x-layouts.public>
    <!-- Article Header -->
    <section class="pt-32 pb-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('public.berita') }}"
                class="inline-flex items-center gap-2 text-slate-400 hover:text-emerald-600 font-bold mb-8 transition-colors group">
                <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Berita
            </a>

            <div class="space-y-6">
                <span
                    class="inline-block px-3 py-1 bg-emerald-50 text-emerald-700 text-[10px] font-bold rounded-full uppercase tracking-widest border border-emerald-100">
                    {{ $berita->kategori }}
                </span>
                <h1 class="text-3xl md:text-5xl font-bold text-slate-900 leading-tight">
                    {{ $berita->judul }}
                </h1>
                <div class="flex items-center gap-4 text-slate-500 text-sm font-medium pt-4 border-t border-slate-100">
                    <div
                        class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center text-slate-400 font-bold uppercase">
                        {{ substr($berita->user->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="text-slate-900 font-bold">{{ $berita->user->name }}</div>
                        <div>{{ $berita->created_at->format('d F Y • H:i') }} WITA</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Image -->
    @if($berita->foto)
        <section class="bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="rounded-[3rem] overflow-hidden shadow-2xl h-[400px] md:h-[600px] w-full">
                    <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}"
                        class="w-full h-full object-cover">
                </div>
            </div>
        </section>
    @endif

    <!-- Article Content -->
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg max-w-none text-slate-700 leading-relaxed font-serif">
                {!! nl2br(e($berita->isi)) !!}
            </div>

            <div
                class="mt-20 pt-10 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-4">
                    <span class="text-sm font-bold text-slate-400 uppercase tracking-widest">Bagikan:</span>
                    <div class="flex gap-3">
                        <button
                            class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-emerald-500 hover:text-white transition-all shadow-sm">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </button>
                        <button
                            class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-emerald-500 hover:text-white transition-all shadow-sm">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="text-slate-400 text-xs italic">
                    Sumber: DPMD Kabupaten Manggarai Timur
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>