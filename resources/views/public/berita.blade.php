@php
    $allBeritas = \App\Models\Berita::with('user')->where('is_published', true)->latest()->paginate(9);
    $featuredBerita = $allBeritas->first();
    $newsGrid = $allBeritas->skip(1);
@endphp

<x-layouts.public>
    <!-- Header Section -->
    <section class="pt-32 pb-16 bg-white border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <span
                    class="inline-block py-1 px-3 rounded-full bg-blue-50 text-blue-600 text-xs font-bold uppercase tracking-widest mb-6">
                    Update Terkini
                </span>
                <h1 class="text-4xl md:text-5xl font-bold text-slate-900 mb-6">Kegiatan & Informasi Desa</h1>
                <p class="text-slate-500 text-lg leading-relaxed">
                    Kumpulan dokumentasi kegiatan dari pelosok desa, kebijakan Pemerintah Kabupaten, dan pengumuman resmi DPMD
                    Manggarai Timur.
                </p>
            </div>
        </div>
    </section>

    @if($featuredBerita)
        <!-- Featured News: Re-structured to stacked layout -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <a href="{{ route('public.berita.detail', $featuredBerita->slug) }}" class="block group">
                    <div class="bg-white rounded-[3rem] overflow-hidden shadow-2xl border border-slate-100 transition-all duration-500 hover:shadow-emerald-900/10">
                        <!-- Image on Top -->
                        <div class="relative h-[400px] md:h-[500px] overflow-hidden">
                            @if($featuredBerita->foto)
                                <img src="{{ asset('storage/' . $featuredBerita->foto) }}" alt="{{ $featuredBerita->judul }}"
                                    class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                            @else
                                <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb773b09?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80"
                                    class="w-full h-full object-cover grayscale opacity-20">
                            @endif
                            <div class="absolute top-8 left-8">
                                <span class="px-4 py-2 bg-emerald-600 text-white text-xs font-black rounded-full shadow-lg shadow-emerald-900/20 uppercase tracking-widest italic">Kegiatan Utama</span>
                            </div>
                        </div>

                        <!-- Content Below Image -->
                        <div class="p-10 md:p-16">
                            <div class="flex items-center gap-2 mb-6">
                                <div class="w-10 h-0.5 bg-amber-500"></div>
                                <span class="text-amber-600 text-xs font-black uppercase tracking-[0.2em]">{{ $featuredBerita->kategori ?? 'KEGIATAN' }}</span>
                            </div>

                            <h2 class="text-3xl md:text-5xl font-bold text-slate-900 mb-8 leading-tight group-hover:text-emerald-600 transition-colors font-serif italic">
                                {{ $featuredBerita->judul }}
                            </h2>

                            <p class="text-slate-600 text-lg leading-relaxed mb-10 line-clamp-3">
                                {{ Str::limit(strip_tags($featuredBerita->isi), 300) }}
                            </p>

                            <div class="flex flex-wrap items-center justify-between gap-6 pt-10 border-t border-slate-100">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-slate-900 rounded-xl flex items-center justify-center text-white font-black text-xl shadow-lg shadow-slate-200">
                                        {{ substr($featuredBerita->user->name, 0, 1) }}
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm font-black text-slate-900 uppercase tracking-widest">{{ $featuredBerita->user->name }}</span>
                                        <span class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">{{ $featuredBerita->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2 text-emerald-600 font-black text-xs uppercase tracking-widest group-hover:translate-x-2 transition-transform">
                                    Baca Selengkapnya
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </section>
    @endif

    <!-- News Grid -->
    <section class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($newsGrid as $item)
                    <a href="{{ route('public.berita.detail', $item->slug) }}" class="group block h-full">
                        <div
                            class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all h-full border border-slate-100 flex flex-col">
                            <div class="relative h-56 overflow-hidden">
                                @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300">
                                        <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="bg-white/90 backdrop-blur-sm text-[10px] font-bold py-1 px-3 rounded-full text-slate-800 uppercase">{{ $item->kategori }}</span>
                                </div>
                            </div>
                            <div class="p-8 flex-grow">
                                <div class="text-xs text-slate-400 font-bold mb-3 uppercase tracking-tighter">
                                    {{ $item->created_at->format('d F Y') }}</div>
                                <h3
                                    class="text-xl font-bold text-slate-800 mb-4 group-hover:text-emerald-600 transition-colors">
                                    {{ $item->judul }}</h3>
                                <p class="text-slate-500 text-sm leading-relaxed line-clamp-6">
                                    {{ strip_tags($item->isi) }}</p>
                            </div>
                            <div
                                class="px-8 py-4 bg-slate-50 border-t border-slate-50 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                Oleh {{ $item->user->name }}
                            </div>
                        </div>
                    </a>
                @empty
                    @if(!$featuredBerita)
                        <div class="col-span-full py-20 text-center">
                            <p class="text-slate-400">Belum ada berita yang diterbitkan.</p>
                        </div>
                    @endif
                @endforelse
            </div>

            @if($allBeritas->hasPages())
                <div class="mt-16 flex justify-center">
                    {{ $allBeritas->links() }}
                </div>
            @endif
        </div>
    </section>
</x-layouts.public>