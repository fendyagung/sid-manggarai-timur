<x-layouts.public>
    <!-- Hero Section -->
    <section class="pt-32 pb-16 bg-[#2b529a] text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-6 tracking-tight">Kelezatan Kuliner Tradisional</h1>
                <p class="text-blue-100 text-lg md:text-xl leading-relaxed">
                    Eksplorasi cita rasa autentik dari bumi Manggarai Timur. Setiap hidangan membawa cerita dan tradisi
                    yang diwariskan turun-temurun.
                </p>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @forelse($potensis as $item)
                    <!-- Dynamic Item -->
                    <div
                        class="bg-white rounded-[2.5rem] overflow-hidden shadow-xl border border-slate-100 group flex flex-col h-full">
                        <div class="h-64 bg-slate-200 relative overflow-hidden">
                            @if($item->foto_utama)
                                <img src="{{ asset('storage/' . $item->foto_utama) }}" alt="{{ $item->nama_potensi }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400">
                                    <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                    </svg>
                                </div>
                            @endif
                            <div
                                class="absolute top-6 left-6 bg-amber-500 text-white px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest">
                                Kuliner</div>

                            @if($item->galleries->count() > 0)
                                <div
                                    class="absolute bottom-4 right-4 translate-y-12 group-hover:translate-y-0 transition-transform duration-500">
                                    <a data-fslightbox="gallery-{{ $item->id }}"
                                        href="{{ asset('storage/' . $item->foto_utama) }}"
                                        class="p-3 bg-white/90 backdrop-blur text-[#2b529a] rounded-full shadow-lg hover:bg-white transition-all flex items-center gap-2 text-xs font-bold">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        +{{ $item->galleries->count() }} Foto
                                    </a>
                                    @foreach($item->galleries as $gallery)
                                        <a data-fslightbox="gallery-{{ $item->id }}" href="{{ asset('storage/' . $gallery->foto) }}"
                                            class="hidden"></a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="p-10 flex flex-col flex-1">
                            <h3 class="text-2xl font-bold text-slate-800 mb-4">{{ $item->nama_potensi }}</h3>
                            <p class="text-slate-600 text-sm leading-relaxed mb-6 flex-1">{{ $item->deskripsi }}</p>
                            <div class="flex items-center gap-2 text-blue-600 font-bold text-sm mt-auto">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 110-9.9zm4.24 9.9a1 1 0 101.42-1.42l-2.12-2.12a1 1 0 10-1.42 1.42l2.12 2.12z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $item->lokasi ?? ($item->desa->nama_desa ?? 'Manggarai Timur') }}
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Fallback Dummy Content -->
                    <div class="col-span-full text-center py-20 text-slate-400">
                        <p class="text-lg">Belum ada konten kuliner yang ditambahkan oleh admin desa.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-20 p-12 bg-[#2b529a]/5 rounded-[3rem] border border-[#2b529a]/10 text-center">
                <h4 class="text-xl font-bold text-slate-800 mb-2">Punya Info Kuliner Desa?</h4>
                <p class="text-slate-500 mb-8 max-w-lg mx-auto">Kami terus memperbarui data potensi kuliner di tiap
                    desa. Silakan hubungi admin untuk mendaftarkan kuliner khas desa Anda.</p>
                <a href="{{ route('public.kontak') }}"
                    class="px-8 py-3 bg-[#2b529a] text-white font-bold rounded-2xl shadow-lg hover:bg-blue-700 transition-all">Hubungi
                    Admin</a>
            </div>
        </div>
    </section>
</x-layouts.public>