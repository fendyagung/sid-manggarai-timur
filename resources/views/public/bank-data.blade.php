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
    <section class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-16">
                @forelse($regulasis as $kategori => $items)
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800 mb-8 flex items-center gap-3">
                            <span class="w-3 h-3 bg-emerald-500 rounded-full"></span>
                            {{ $kategori }}
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($items as $item)
                                <div
                                    class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all group">
                                    <div class="flex items-start gap-4 mb-4">
                                        <div
                                            class="p-3 bg-slate-50 text-slate-400 rounded-xl group-hover:bg-emerald-50 group-hover:text-emerald-600 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-slate-800 line-clamp-2 leading-snug mb-1">
                                                {{ $item->judul }}</h3>
                                            <span class="text-xs text-slate-400">{{ $item->created_at->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                    @if($item->deskripsi)
                                        <p class="text-sm text-slate-500 mb-6 line-clamp-2">{{ $item->deskripsi }}</p>
                                    @else
                                        <div class="mb-6"></div>
                                    @endif

                                    <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank"
                                        class="flex items-center justify-center w-full py-3 border border-slate-200 rounded-xl text-sm font-bold text-slate-600 hover:border-emerald-500 hover:text-emerald-600 hover:bg-emerald-50 transition-all gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Unduh Dokumen
                                    </a>
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