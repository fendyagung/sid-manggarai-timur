<x-layouts.public>
    <div class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-bold text-slate-800 mb-4">Eksplorasi Desa & Kelurahan Wisata</h1>
                <div class="w-24 h-1.5 bg-emerald-500 mx-auto rounded-full mb-6"></div>
                <p class="text-slate-600 max-w-2xl mx-auto text-lg leading-relaxed">
                    Temukan pesona autentik Manggarai Timur melalui desa dan kelurahan wisata yang menawarkan keindahan
                    alam,
                    budaya, dan kearifan lokal yang unik.
                </p>
            </div>

            <!-- Tabs -->
            <div class="flex justify-center mb-12">
                <div class="bg-white p-1.5 rounded-2xl shadow-sm border border-slate-100 inline-flex">
                    <a href="{{ route('public.desa-wisata') }}"
                        class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all {{ !request('jenis') ? 'bg-emerald-500 text-white shadow-md' : 'text-slate-600 hover:bg-slate-50' }}">
                        Semua
                    </a>
                    <a href="{{ route('public.desa-wisata', ['jenis' => 'desa']) }}"
                        class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all {{ request('jenis') == 'desa' ? 'bg-emerald-500 text-white shadow-md' : 'text-slate-600 hover:bg-slate-50' }}">
                        Desa
                    </a>
                    <a href="{{ route('public.desa-wisata', ['jenis' => 'kelurahan']) }}"
                        class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all {{ request('jenis') == 'kelurahan' ? 'bg-emerald-500 text-white shadow-md' : 'text-slate-600 hover:bg-slate-50' }}">
                        Kelurahan
                    </a>
                </div>
            </div>

            @if($desas->isEmpty())
                <div class="text-center py-20">
                    <div class="inline-block p-6 bg-white rounded-3xl shadow-sm border border-slate-100">
                        <p class="text-slate-500 italic">Belum ada desa wisata yang terdaftar saat ini.</p>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach($desas as $desa)
                        <div
                            class="group bg-white rounded-[2rem] overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-slate-100">
                            <div class="relative h-72 overflow-hidden">
                                @if($desa->foto_profil)
                                    <img src="{{ asset('storage/' . $desa->foto_profil) }}" alt="{{ $desa->nama_desa }}"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @elseif($desa->potensis->isNotEmpty() && $desa->potensis->first()->foto_utama)
                                    <img src="{{ asset('storage/' . $desa->potensis->first()->foto_utama) }}"
                                        alt="{{ $desa->nama_desa }}"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <div class="w-full h-full bg-slate-200 flex items-center justify-center text-slate-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                                <div
                                    class="absolute top-4 right-4 bg-emerald-500 text-white px-4 py-1.5 rounded-full text-xs font-bold shadow-lg">
                                    Desa Wisata
                                </div>
                            </div>
                            <div class="p-8">
                                <div class="flex items-center text-sm text-emerald-600 font-bold mb-3 uppercase tracking-wider">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $desa->kecamatan }}
                                </div>
                                <h3
                                    class="text-2xl font-bold text-slate-800 mb-3 group-hover:text-emerald-600 transition-colors">
                                    {{ $desa->nama_desa }}
                                </h3>
                                <p class="text-slate-600 text-sm leading-relaxed mb-6 line-clamp-3">
                                    {{ $desa->deskripsi ?? 'Nikmati keindahan dan kearifan lokal di ' . $desa->nama_desa . '.' }}
                                </p>
                                <div class="pt-6 border-t border-slate-50 flex items-center justify-between">
                                    <a href="{{ route('public.desa.profil', $desa->id) }}"
                                        class="inline-flex items-center text-emerald-600 font-bold hover:gap-2 transition-all">
                                        Jelajahi Desa
                                        <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                    <div class="flex items-center gap-1 text-slate-400 text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span>Lihat</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $desas->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layouts.public>