<x-layouts.public>
    <!-- Hero Section -->
    <section class="pt-32 pb-16 bg-[#0f172a] text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <span
                    class="inline-block px-4 py-1.5 rounded-full bg-emerald-500/20 text-emerald-400 text-xs font-bold uppercase tracking-widest mb-6 border border-emerald-500/30">Karya
                    Seni & Budaya</span>
                <h1 class="text-4xl md:text-5xl font-extrabold mb-6 tracking-tight">Kerajinan Tangan Autentik</h1>
                <p class="text-slate-400 text-lg md:text-xl leading-relaxed">
                    Warisan keterampilan tangan masyarakat Manggarai Timur yang memadukan keindahan estetika dengan
                    makna filosofis yang mendalam.
                </p>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                @forelse($potensis as $item)
                    <!-- Dynamic Item -->
                    <div class="group h-full flex flex-col">
                        <div class="aspect-[4/3] rounded-[3rem] overflow-hidden bg-slate-100 mb-8 shadow-2xl relative">
                            @if($item->foto_utama)
                                <img src="{{ asset('storage/' . $item->foto_utama) }}" alt="{{ $item->nama_potensi }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-300">
                                    <svg class="h-20 w-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                    </svg>
                                </div>
                            @endif

                            @if($item->galleries->count() > 0)
                                <div
                                    class="absolute bottom-6 right-6 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                    <a data-fslightbox="gallery-{{ $item->id }}"
                                        href="{{ asset('storage/' . $item->foto_utama) }}"
                                        class="px-6 py-2.5 bg-emerald-600 text-white rounded-2xl shadow-xl hover:bg-emerald-700 transition-all flex items-center gap-2 text-sm font-bold">
                                        Lihat Galeri ({{ $item->galleries->count() + 1 }} Foto)
                                    </a>
                                    @foreach($item->galleries as $gallery)
                                        <a data-fslightbox="gallery-{{ $item->id }}" href="{{ asset('storage/' . $gallery->foto) }}"
                                            class="hidden"></a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="px-4 flex-1 flex flex-col">
                            <div class="flex items-center gap-4 mb-4">
                                <span
                                    class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-lg uppercase">Kerajinan</span>
                                <span
                                    class="text-slate-400 text-sm">{{ $item->desa->nama_desa ?? 'Manggarai Timur' }}</span>
                            </div>
                            <h3 class="text-3xl font-bold text-slate-800 mb-4">{{ $item->nama_potensi }}</h3>
                            <p class="text-slate-600 leading-relaxed mb-6 flex-1">{{ $item->deskripsi }}</p>
                            <div class="flex items-center gap-2 text-emerald-600 font-bold mt-auto pt-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $item->lokasi ?? ($item->desa->kecamatan ?? 'Manggarai Timur') }}
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Fallback -->
                    <div
                        class="col-span-2 text-center py-20 bg-slate-50 rounded-[3rem] border border-dashed border-slate-200">
                        <p class="text-slate-500 italic">Data kerajinan tangan sedang dikumpulkan dari desa-desa.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-24 bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-slate-900 mb-6">Mendukung Ekonomi Kreatif Desa</h2>
            <p class="text-slate-600 mb-10 text-lg">Dengan membeli produk kerajinan lokal, Anda membantu melestarikan
                budaya dan meningkatkan kesejahteraan para perajin di desa-desa Manggarai Timur.</p>
            <a href="{{ route('public.desa-wisata') }}"
                class="inline-flex items-center justify-center px-10 py-4 bg-emerald-600 text-white font-bold rounded-2xl shadow-xl hover:bg-emerald-700 transition-all">Lihat
                Desa Penghasil</a>
        </div>
    </section>
</x-layouts.public>