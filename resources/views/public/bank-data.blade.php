<x-layouts.public>
    <!-- Hero -->
    <section class="pt-32 pb-16 bg-slate-900 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Bank Data & Regulasi</h1>
            <p class="text-slate-400 text-lg max-w-2xl mx-auto leading-relaxed">
                Pusat unduhan resmi untuk peraturan daerah, format laporan, template administrasi, dan materi
                sosialisasi
                DPMD Kabupaten Manggarai Timur.
            </p>
        </div>
    </section>

    <!-- Content -->
    <section class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filter Bar -->
            <div class="bg-white dark:bg-slate-800 p-4 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700 mb-12 flex flex-col md:flex-row gap-4">
                <form action="{{ route('public.bank-data') }}" method="GET" class="flex-1 flex flex-col md:flex-row gap-4">
                    <div class="flex-1 relative">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" name="q" value="{{ request('q') }}"
                            placeholder="Cari nama dokumen atau nomor regulasi..."
                            class="w-full pl-12 pr-4 py-3 bg-slate-50 dark:bg-slate-900/50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500/20 text-sm">
                    </div>
                    <div class="md:w-48">
                        <select name="tahun" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-900/50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500/20 text-sm appearance-none cursor-pointer">
                            <option value="">Semua Tahun</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>Tahun {{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="px-8 py-3 bg-slate-900 dark:bg-emerald-600 text-white font-bold rounded-2xl hover:bg-slate-800 dark:hover:bg-emerald-700 transition-all text-sm">
                        Filter Data
                    </button>
                    @if(request()->has('q') || request()->has('tahun'))
                        <a href="{{ route('public.bank-data') }}" class="px-6 py-3 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 font-bold rounded-2xl hover:bg-slate-200 transition-all text-sm text-center">
                            Reset
                        </a>
                    @endif
                </form>
            </div>
            <div class="space-y-16">
                @forelse($regulasis as $kategori => $items)
                    <div>
                        <div class="flex items-center justify-between mb-8">
                            <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-3">
                                <span class="w-2 h-8 bg-emerald-500 rounded-full"></span>
                                {{ $kategori }}
                            </h2>
                            <span class="px-4 py-1 bg-emerald-50 text-emerald-700 rounded-full text-xs font-bold uppercase tracking-wider">
                                {{ count($items) }} Dokumen
                            </span>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($items as $item)
                                <div
                                    class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group relative overflow-hidden">
                                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50/50 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-150 duration-700"></div>
                                    
                                    <div class="relative z-10">
                                        <div class="flex items-start gap-4 mb-6">
                                            <div
                                                class="p-4 bg-slate-50 text-slate-400 rounded-2xl group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300 shadow-inner">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex items-center gap-2 mb-1">
                                                    <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md uppercase tracking-tighter">Official</span>
                                                    <span class="text-[10px] font-medium text-slate-400">{{ $item->created_at->format('d M Y') }}</span>
                                                </div>
                                                <h3 class="font-bold text-slate-800 line-clamp-2 leading-snug group-hover:text-emerald-700 transition-colors">
                                                    {{ $item->judul }}</h3>
                                            </div>
                                        </div>

                                        @if($item->deskripsi)
                                            <p class="text-sm text-slate-500 mb-8 line-clamp-3 leading-relaxed min-h-[4.5rem]">{{ $item->deskripsi }}</p>
                                        @else
                                            <p class="text-sm text-slate-400 italic mb-8 min-h-[4.5rem]">Tidak ada deskripsi tambahan untuk dokumen ini.</p>
                                        @endif

                                        <a href="{{ route('dashboard.regulasi.download', $item->id) }}"
                                            class="flex items-center justify-center w-full py-4 bg-slate-900 group-hover:bg-emerald-600 text-white rounded-2xl text-sm font-bold transition-all duration-300 gap-3 shadow-lg shadow-slate-900/10 group-hover:shadow-emerald-600/30">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-bounce-subtle" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                            Unduh Dokumen Sekarang
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20">
                        <div class="inline-block p-6 bg-white rounded-full mb-6 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-300" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-2">Belum Ada Dokumen</h3>
                        <p class="text-slate-500">Admin DPMD belum mengunggah dokumen publik.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-layouts.public>