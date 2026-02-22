<x-layouts.public>
    <div class="py-24 bg-slate-50 relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-yellow-100 rounded-full blur-3xl opacity-50"></div>
            <div class="absolute top-1/2 -left-24 w-72 h-72 bg-emerald-100 rounded-full blur-3xl opacity-50"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <span class="text-emerald-600 font-bold tracking-wider uppercase text-sm mb-2 block">Potensi Ekonomi
                    Daerah</span>
                <h1 class="text-4xl md:text-5xl font-bold text-slate-800 mb-4">Komoditi Unggulan</h1>
                <div class="w-24 h-1.5 bg-yellow-400 mx-auto rounded-full mb-6"></div>
                <p class="text-slate-600 max-w-2xl mx-auto text-lg leading-relaxed">
                    Menjelajahi kekayaan hasil bumi Manggarai Timur. Dari biji kopi terbaik hingga rempah-rempah yang
                    mendunia.
                </p>
            </div>

            @if($potensis->isEmpty())
                <div class="text-center py-20">
                    <div class="inline-block p-8 bg-white rounded-3xl shadow-lg border border-slate-100 text-center">
                        <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <h3 class="text-lg font-bold text-slate-700 mb-2">Belum Ada Data</h3>
                        <p class="text-slate-500 italic">Belum ada komoditi unggulan yang ditambahkan.</p>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($potensis as $potensi)
                        <div
                            class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-slate-100 flex flex-col h-full">
                            <div class="relative h-64 overflow-hidden">
                                @if($potensi->foto_utama)
                                    <img src="{{ asset('storage/' . $potensi->foto_utama) }}" alt="{{ $potensi->nama_potensi }}"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="bg-yellow-400 text-yellow-900 text-xs font-bold px-3 py-1 rounded-full shadow-md">
                                        {{ $potensi->desa->nama_desa }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-8 flex-grow flex flex-col">
                                <h3
                                    class="text-2xl font-bold text-slate-800 mb-3 group-hover:text-emerald-600 transition-colors">
                                    {{ $potensi->nama_potensi }}
                                </h3>
                                <p class="text-slate-600 text-sm leading-relaxed mb-6 line-clamp-3 flex-grow">
                                    {{ $potensi->deskripsi }}
                                </p>
                                <div class="pt-6 border-t border-slate-50 mt-auto">
                                    <a href="{{ route('public.desa.profil', $potensi->desa_id) }}"
                                        class="inline-flex items-center text-sm font-bold text-emerald-600 hover:text-emerald-700 transition-colors">
                                        Lihat Desa Penghasil
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layouts.public>