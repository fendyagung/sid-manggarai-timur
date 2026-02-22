<x-layouts.public>
    <div class="py-24 bg-white dark:bg-slate-900 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav class="flex mb-8 text-sm font-medium text-slate-500">
                <a href="{{ route('dashboard') }}" class="hover:text-emerald-600">Dashboard</a>
                <span class="mx-2">/</span>
                <span class="text-slate-800 dark:text-slate-100">Monitoring Desa</span>
            </nav>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Village Profile Card -->
                <aside class="w-full lg:w-80 flex-shrink-0">
                    <div
                        class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl overflow-hidden border border-slate-100 dark:border-slate-700 sticky top-28">
                        <div class="h-32 bg-[#2b529a] relative">
                            <div
                                class="absolute -bottom-10 left-1/2 -translate-x-1/2 w-20 h-20 bg-white rounded-2xl shadow-lg flex items-center justify-center text-[#2b529a] border border-slate-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                        </div>
                        <div class="pt-14 p-6 text-center">
                            <h2 class="text-xl font-bold text-slate-800 dark:text-white">{{ $desa->nama_desa }}</h2>
                            <p class="text-slate-500 dark:text-slate-400 text-sm mb-6">{{ $desa->kecamatan }}</p>

                            <div class="space-y-4 text-left border-t border-slate-50 pt-6">
                                <div>
                                    <span
                                        class="block text-slate-400 dark:text-slate-500 text-[10px] uppercase font-bold mb-1">Kepala
                                        Desa</span>
                                    <span
                                        class="font-bold text-slate-700 dark:text-slate-200">{{ $desa->kepala_desa ?? '-' }}</span>
                                </div>
                                <div>
                                    <span class="block text-slate-400 text-[10px] uppercase font-bold mb-1">Kode
                                        Desa</span>
                                    <span class="font-bold text-slate-700">{{ $desa->kode_desa ?? '-' }}</span>
                                </div>
                                <div>
                                    <span class="block text-slate-400 text-[10px] uppercase font-bold mb-1">Desa
                                        Wisata</span>
                                    @if($desa->is_desa_wisata)
                                        <span
                                            class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-green-100 text-green-700">YA</span>
                                    @else
                                        <span
                                            class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-400">TIDAK</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Reports History -->
                <div class="flex-1 space-y-8">
                    <!-- Gallery Photos -->
                    @if($desa->galleries->where('type', 'foto')->count() > 0)
                        <div
                            class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl overflow-hidden border border-slate-100 dark:border-slate-700 p-8">
                            <h3 class="font-bold text-xl text-slate-800 dark:text-white mb-6 flex items-center gap-2">
                                <span class="w-2 h-6 bg-emerald-500 rounded-full"></span>
                                Galeri Foto Desa
                            </h3>
                            <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($desa->galleries->where('type', 'foto') as $photo)
                                    <div
                                        class="aspect-square rounded-2xl overflow-hidden border border-slate-50 transition-transform hover:scale-[1.02] duration-300">
                                        <img src="{{ asset('storage/' . $photo->url_or_path) }}"
                                            class="w-full h-full object-cover" alt="Galeri {{ $desa->nama_desa }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Gallery Videos -->
                    @if($desa->galleries->where('type', 'video')->count() > 0)
                        <div
                            class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl overflow-hidden border border-slate-100 dark:border-slate-700 p-8">
                            <h3 class="font-bold text-xl text-slate-800 dark:text-white mb-6 flex items-center gap-2">
                                <span class="w-2 h-6 bg-red-500 rounded-full"></span>
                                Video Terkait
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($desa->galleries->where('type', 'video') as $video)
                                    @php
                                        $videoId = '';
                                        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video->url_or_path, $match)) {
                                            $videoId = $match[1];
                                        }
                                    @endphp
                                    @if($videoId)
                                        <div class="rounded-2xl overflow-hidden aspect-video border border-slate-50 shadow-sm">
                                            <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $videoId }}"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen></iframe>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Reports History -->
                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">

                        <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                            <h3 class="font-bold text-xl text-slate-800">Riwayat Laporan</h3>
                            <span
                                class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">{{ $desa->laporans->count() }}
                                Laporan</span>
                        </div>

                        <div class="p-0">
                            @if($desa->laporans->isEmpty())
                                <div class="p-12 text-center">
                                    <div
                                        class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <p class="text-slate-400 italic">Belum ada laporan yang dikirimkan oleh desa ini.</p>
                                </div>
                            @else
                                <div class="divide-y divide-slate-50">
                                    @foreach($desa->laporans as $laporan)
                                        <div
                                            class="p-6 hover:bg-slate-50 transition-all flex items-center justify-between group relative">
                                            <div class="flex-1">
                                                <a href="{{ route('dashboard.laporan.detail', $laporan->id) }}" class="block">
                                                    <div class="flex items-center gap-3 mb-1">
                                                        <span
                                                            class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider
                                                                                            {{ $laporan->kategori === 'keuangan' ? 'bg-indigo-100 text-indigo-700' : '' }}
                                                                                            {{ $laporan->kategori === 'penduduk' ? 'bg-teal-100 text-teal-700' : '' }}
                                                                                            {{ $laporan->kategori === 'kejadian' ? 'bg-red-100 text-red-700' : '' }}
                                                                                            {{ $laporan->kategori === 'lainnya' ? 'bg-slate-100 text-slate-700' : '' }}">
                                                            {{ $laporan->kategori }}
                                                        </span>
                                                        <span
                                                            class="text-xs text-slate-400">{{ $laporan->tanggal_laporan }}</span>
                                                    </div>
                                                    <h4
                                                        class="font-bold text-slate-800 group-hover:text-blue-600 transition-colors">
                                                        {{ $laporan->judul }}
                                                    </h4>
                                                </a>
                                                @if($laporan->file_path)
                                                    <div class="flex items-center gap-1 mt-1 text-[10px] text-blue-500 font-medium">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                                        </svg>
                                                        Ada Lampiran
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex items-center gap-4">
                                                <span
                                                    class="px-3 py-1 rounded-full text-xs font-bold 
                                                                                    {{ $laporan->status === 'pending' ? 'bg-orange-100 text-orange-700' : '' }}
                                                                                    {{ $laporan->status === 'diterima' ? 'bg-green-100 text-green-700' : '' }}
                                                                                    {{ $laporan->status === 'ditolak' ? 'bg-red-100 text-red-700' : '' }}">
                                                    {{ ucfirst($laporan->status) }}
                                                </span>
                                                <form action="{{ route('dashboard.laporan.destroy', $laporan->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini? Tindakan ini tidak dapat dibatalkan.');"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="p-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-xl transition-all shadow-sm flex items-center justify-center"
                                                        title="Hapus Laporan">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.public>