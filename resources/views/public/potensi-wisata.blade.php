@php
    $potensis = \App\Models\Potensi::with('desa')->latest()->paginate(12);
@endphp

<x-layouts.public>
    <!-- Hero Section -->
    <section class="pt-32 pb-16 bg-[#064e3b] text-white relative overflow-hidden">


        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl">
                <span class="px-4 py-1.5 bg-white/10 backdrop-blur-sm text-amber-400 text-[11px] font-black uppercase tracking-widest rounded-full border border-white/20 mb-6 inline-block">🗺️ Destinasi Lokal</span>
                <h1 class="text-4xl md:text-5xl font-black mb-6 tracking-tight font-serif">Katalog Potensi &<br><span style="color: #f59e0b;">Destinasi Desa</span></h1>
                <p class="text-emerald-50 text-lg md:text-xl leading-relaxed">
                    Setiap sudut Manggarai Timur memiliki cerita. Jelajahi kekayaan alam, budaya, kuliner, dan kerajinan tangan terbaik dari tiap desa.
                </p>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-24 bg-slate-50 dark:bg-slate-900 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-12">
                @forelse($potensis as $item)
                    <div class="bg-white dark:bg-slate-800 rounded-[2rem] overflow-hidden shadow-sm hover:shadow-2xl border border-slate-100 dark:border-slate-700 transition-all group flex flex-col h-full relative">
                        <div class="h-56 relative overflow-hidden">
                            @if($item->foto_utama)
                                <img src="{{ asset('storage/' . $item->foto_utama) }}" alt="{{ $item->nama_potensi }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="w-full h-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-4xl">🏝️</div>
                            @endif
                            <div class="absolute top-5 left-5 bg-amber-500 text-white px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest shadow-lg">
                                {{ $item->kategori }}
                            </div>
                        </div>
                        <div class="p-8 flex flex-col flex-1 z-10">
                            <div class="flex items-center gap-1.5 text-red-600 dark:text-red-400 font-bold text-[10px] uppercase tracking-widest mb-3">
                                <svg width="16" height="16" style="width: 16px; height: 16px; min-width: 16px;" class="mr-1.5 flex-shrink-0" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="#ea4335" d="M12 2C8.14 2 5 5.14 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.86-3.14-7-7-7z"/>
                                    <circle fill="#b31412" cx="12" cy="9" r="3"/>
                                </svg>
                                {{ $item->desa->nama_desa ?? '-' }}, Kec. {{ $item->desa->kecamatan ?? '-' }}
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-4 group-hover:text-red-600 transition-colors">{{ $item->nama_potensi }}</h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed mb-6 flex-1 line-clamp-6">
                                {{ strip_tags($item->deskripsi) }}
                            </p>
                            <div class="mt-auto pt-6 border-t border-slate-50 dark:border-slate-700 flex justify-between items-center">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic tracking-tighter">{{ $item->lokasi ?: 'Lokasi Tersedia' }}</span>
                                <a href="{{ route('public.potensi-wisata.detail', $item->id) }}" class="text-[10px] font-black text-red-600 dark:text-red-400 uppercase tracking-widest">Detail →</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-24 text-center">
                        <div class="text-6xl mb-6">🏜️</div>
                        <h3 class="text-xl font-bold text-slate-400">Belum ada potensi wisata yang dibagikan.</h3>
                        <p class="text-slate-400 mt-2">Daftar ini akan diperbarui secara berkala oleh admin desa.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $potensis->links() }}
            </div>
        </div>
    </section>
</x-layouts.public>