<x-layouts.public>
    <div class="relative min-h-[60vh] pt-32 pb-20 overflow-hidden">
        <!-- Background Decor -->
        <div class="absolute top-0 left-0 w-full h-full bg-slate-50 dark:bg-slate-900 -z-10"></div>
        <div class="absolute top-[-10%] right-[-10%] w-[40%] h-[40%] bg-amber-500/5 rounded-full blur-[120px] -z-10"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-500/5 rounded-full blur-[120px] -z-10"></div>

        <div class="max-w-5xl mx-auto px-4">
            <div class="mb-12">
                <h1 class="text-4xl md:text-5xl font-bold text-slate-800 dark:text-white mb-4">
                    Hasil Pencarian
                </h1>
                <p class="text-lg text-slate-500 dark:text-slate-400">
                    Menampilkan <span class="font-bold text-amber-500">{{ $total }}</span> hasil untuk <span class="italic">"{{ $query }}"</span>
                </p>
            </div>

            @if($results->isEmpty())
                <div class="bg-white dark:bg-slate-800 rounded-[2.5rem] p-12 text-center border border-slate-100 dark:border-slate-700 shadow-sm">
                    <div class="w-24 h-24 bg-slate-50 dark:bg-slate-900 rounded-3xl flex items-center justify-center text-4xl mx-auto mb-6">🔍</div>
                    <h3 class="text-2xl font-bold text-slate-800 dark:text-white mb-2">Tidak ada hasil ditemukan</h3>
                    <p class="text-slate-500 dark:text-slate-400 max-w-md mx-auto">Maaf, kami tidak menemukan data yang cocok dengan kata kunci Anda. Coba gunakan kata kunci yang lebih umum.</p>
                    <button onclick="document.getElementById('search-open').click()" class="mt-8 px-8 py-3 bg-amber-500 text-white font-bold rounded-2xl hover:bg-amber-600 transition-all">Cari Lagi</button>
                </div>
            @else
                <div class="space-y-6">
                    @foreach($results as $result)
                        <a href="{{ $result->search_url }}" class="group block bg-white dark:bg-slate-800 rounded-[2rem] p-6 md:p-8 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-xl hover:border-amber-500/30 transition-all duration-300">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
                                <span class="px-4 py-1.5 bg-slate-100 dark:bg-slate-900 text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest rounded-full group-hover:bg-amber-500 group-hover:text-white transition-all">
                                    {{ $result->search_type }}
                                </span>
                                @if(isset($result->created_at))
                                    <span class="text-xs text-slate-400">{{ $result->created_at->format('d M Y') }}</span>
                                @endif
                            </div>
                            <h3 class="text-xl md:text-2xl font-bold text-slate-800 dark:text-white mb-3 group-hover:text-amber-500 transition-colors">
                                {{ $result->search_title }}
                            </h3>
                            <p class="text-slate-500 dark:text-slate-400 leading-relaxed line-clamp-2">
                                {{ $result->search_desc }}
                            </p>
                            <div class="mt-6 flex items-center text-amber-500 font-bold text-sm gap-2">
                                <span>Lihat Selengkapnya</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layouts.public>
