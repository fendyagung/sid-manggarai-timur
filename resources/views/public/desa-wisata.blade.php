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
                                @if($desa->potensis->isNotEmpty() && $desa->potensis->first()->foto_utama)
                                    <img src="{{ asset('storage/' . $desa->potensis->first()->foto_utama) }}"
                                        alt="{{ $desa->nama_desa }}"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @elseif($desa->foto_profil)
                                    <img src="{{ asset('storage/' . $desa->foto_profil) }}" alt="{{ $desa->nama_desa }}"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <!-- Beautiful Gradient Fallback for Cards -->
                                    <div class="w-full h-full bg-gradient-to-br from-emerald-800 to-[#064e3b] relative">
                                        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 20px 20px;"></div>
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <span class="text-white/30 font-black text-2xl uppercase tracking-widest">{{ substr($desa->nama_desa, 0, 1) }}</span>
                                        </div>
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
                                <div class="flex items-center text-sm text-red-600 font-bold mb-3 uppercase tracking-wider">
                                    <svg width="16" height="16" style="width: 16px; height: 16px; min-width: 16px;" class="mr-1.5 flex-shrink-0" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="#ea4335" d="M12 2C8.14 2 5 5.14 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.86-3.14-7-7-7z"/>
                                        <circle fill="#b31412" cx="12" cy="9" r="3"/>
                                    </svg>
                                    {{ $desa->kecamatan }}
                                </div>
                                <h3
                                    class="text-2xl font-bold text-slate-800 mb-3 group-hover:text-emerald-600 transition-colors">
                                    {{ $desa->nama_desa }}
                                </h3>
                                <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed mb-6 flex-1 line-clamp-6">
                                    {{ strip_tags($desa->sejarah ?? 'Jelajahi pesona dan keunikan desa kami.') }}
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