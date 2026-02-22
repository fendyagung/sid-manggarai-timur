<x-layouts.public>
    <!-- Hero Section -->
    <section class="pt-32 pb-24 bg-gradient-to-br from-red-900 to-red-700 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-20 pointer-events-none">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white" />
            </svg>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-5xl md:text-6xl font-black mb-6 tracking-tight uppercase">Event & Budaya</h1>
                <p class="text-red-100 text-xl leading-relaxed">
                    Saksikan kemegahan tradisi leluhur Manggarai Timur melalui festival budaya dan ritual sakral yang
                    memikat jiwa.
                </p>
            </div>
        </div>
    </section>

    <!-- Events Timeline / List -->
    <section class="py-24 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-24">
                @forelse($potensis as $index => $item)
                    <!-- Dynamic Event Item (Alternating side) -->
                    <div
                        class="flex flex-col {{ $index % 2 == 0 ? 'md:flex-row' : 'md:flex-row-reverse' }} gap-12 items-center">
                        <div class="md:w-1/2 w-full">
                            <div class="relative group cursor-pointer">
                                <div
                                    class="absolute -inset-4 {{ $index % 2 == 0 ? 'bg-red-100 -rotate-3' : 'bg-emerald-100 rotate-3' }} rounded-[3rem]">
                                </div>
                                <div
                                    class="relative rounded-[2.5rem] w-full h-[400px] overflow-hidden shadow-2xl bg-slate-100">
                                    @if($item->foto_utama)
                                        <img src="{{ asset('storage/' . $item->foto_utama) }}" alt="{{ $item->nama_potensi }}"
                                            class="w-full h-full object-cover">
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
                                            class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                            <a data-fslightbox="gallery-{{ $item->id }}"
                                                href="{{ asset('storage/' . $item->foto_utama) }}"
                                                class="p-4 bg-white text-red-700 rounded-full shadow-2xl font-bold flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                Buka Galeri ({{ $item->galleries->count() + 1 }} Foto)
                                            </a>
                                            @foreach($item->galleries as $gallery)
                                                <a data-fslightbox="gallery-{{ $item->id }}"
                                                    href="{{ asset('storage/' . $gallery->foto) }}" class="hidden"></a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="md:w-1/2">
                            <span class="text-red-600 font-bold tracking-widest uppercase text-sm mb-4 block">Budaya
                                {{ $item->desa->nama_desa ?? '' }}</span>
                            <h3 class="text-4xl font-extrabold text-slate-800 mb-6">{{ $item->nama_potensi }}</h3>
                            <p class="text-slate-600 text-lg leading-relaxed mb-8">
                                {{ $item->deskripsi }}
                            </p>
                            <div class="flex items-center gap-6">
                                <div class="flex items-center gap-2 text-slate-500 font-medium">
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
                    </div>
                @empty
                    <div class="text-center py-20 text-slate-400">
                        <p class="text-xl">Agenda event budaya sedang disusun.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Support Section -->
    <section class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="bg-red-900 rounded-[3rem] p-12 md:p-20 text-white flex flex-col md:flex-row items-center justify-between gap-12">
                <div class="md:w-2/3">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Ingin Mengunjungi Event Budaya?</h2>
                    <p class="text-red-100 text-lg mb-0 text-balance">Hubungi admin atau petugas desa setempat untuk
                        mendapatkan jadwal pasti event budaya di tiap kecamatan agar Anda tidak ketinggalan momen
                        berharga.</p>
                </div>
                <a href="{{ route('public.kontak') }}"
                    class="px-10 py-5 bg-white text-red-900 font-extrabold rounded-2xl shadow-2xl hover:bg-red-50 transition-all whitespace-nowrap">Hubungi
                    Admin</a>
            </div>
        </div>
    </section>
</x-layouts.public>