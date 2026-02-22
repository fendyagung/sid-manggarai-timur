<x-layouts.public>
    <div class="py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav class="flex mb-8 text-sm font-medium text-slate-500">
                <a href="{{ route('dashboard') }}" class="hover:text-emerald-600">Dashboard</a>
                <span class="mx-2">/</span>
                <span class="text-slate-800 text-truncate max-w-[200px]">Detail Laporan</span>
            </nav>

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
                <!-- Header -->
                <div class="p-8 bg-[#2b529a] text-white">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div>
                            <span
                                class="px-3 py-1 rounded-full text-xs font-bold bg-white/20 backdrop-blur-sm text-white mb-3 inline-block uppercase tracking-wider">
                                {{ $laporan->kategori }}
                            </span>
                            <h1 class="text-2xl md:text-3xl font-bold">{{ $laporan->judul }}</h1>
                        </div>
                        <div class="text-right">
                            <span class="block text-blue-200 text-xs uppercase tracking-widest font-bold">Status</span>
                            <span
                                class="px-4 py-1.5 rounded-full text-sm font-bold mt-1 inline-block
                                {{ $laporan->status === 'pending' ? 'bg-orange-400 text-white shadow-lg shadow-orange-500/30' : '' }}
                                {{ $laporan->status === 'diterima' ? 'bg-emerald-400 text-white shadow-lg shadow-emerald-500/30' : '' }}
                                {{ $laporan->status === 'ditolak' ? 'bg-red-400 text-white shadow-lg shadow-red-500/30' : '' }}">
                                {{ strtoupper($laporan->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                            <span class="block text-slate-400 text-[10px] uppercase font-bold mb-1">Pengirim</span>
                            <span class="font-bold text-slate-700">{{ $laporan->desa->nama_desa }}</span>
                        </div>
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                            <span class="block text-slate-400 text-[10px] uppercase font-bold mb-1">Tanggal Kirim</span>
                            <span class="font-bold text-slate-700">{{ $laporan->tanggal_laporan }}</span>
                        </div>
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                            <span class="block text-slate-400 text-[10px] uppercase font-bold mb-1">ID Laporan</span>
                            <span
                                class="font-bold text-slate-700">#LP-{{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </div>

                    @if(Auth::user()->role === 'admin_dpmd' && $laporan->desa)
                        <div class="mb-8">
                            <a href="{{ route('dashboard.desa.detail', $laporan->desa->id) }}"
                                class="flex items-center justify-center gap-3 p-4 bg-gradient-to-r from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 border-2 border-blue-200 rounded-2xl transition-all group">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-blue-600 group-hover:scale-110 transition-transform" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="font-bold text-blue-700">Lihat Profil Lengkap
                                    {{ $laporan->desa->nama_desa }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-blue-600 group-hover:translate-x-1 transition-transform" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    @endif

                    <div class="mb-8">
                        <h3 class="font-bold text-slate-800 mb-3 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                            Deskripsi Laporan
                        </h3>
                        <div
                            class="p-6 bg-slate-50 rounded-2xl border border-slate-100 text-slate-600 leading-relaxed italic">
                            {{ $laporan->keterangan ?? 'Tidak ada deskripsi tambahan.' }}
                        </div>
                    </div>

                    <!-- Attachment Section -->
                    <div class="mb-8">
                        <h3 class="font-bold text-slate-800 mb-3 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                            </svg>
                            Lampiran File
                        </h3>
                        @if($laporan->file_path)
                            <div
                                class="flex items-center p-4 bg-blue-50 border border-blue-100 rounded-2xl group hover:border-blue-300 transition-all">
                                <div class="p-3 bg-blue-100 rounded-xl text-blue-600 mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-bold text-blue-900 truncate max-w-xs">
                                        {{ $laporan->original_name ?? $laporan->judul }}
                                    </p>
                                    <p class="text-xs text-blue-600">Klik untuk melihat atau mengunduh dokumen</p>
                                </div>
                                <a href="{{ asset('storage/' . $laporan->file_path) }}" target="_blank"
                                    class="px-5 py-2 bg-[#2b529a] text-white text-sm font-bold rounded-xl shadow-lg shadow-blue-500/20 hover:-translate-y-1 transition-all">
                                    Lihat File
                                </a>
                            </div>
                        @else
                            <div
                                class="p-6 bg-slate-50 border border-dashed border-slate-200 rounded-2xl text-center text-slate-400 italic">
                                Laporan ini tidak memiliki lampiran file.
                            </div>
                        @endif
                    </div>

                    @if(Auth::user()->role === 'admin_dpmd' && $laporan->status === 'pending')
                        <!-- Actions for DPMD -->
                        <div class="pt-6 border-t border-slate-100 flex flex-wrap gap-4">
                            <form action="{{ route('dashboard.laporan.approve', $laporan->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="px-8 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-500/20 transition-all transform hover:-translate-y-1">
                                    Terima Laporan
                                </button>
                            </form>

                            <form action="{{ route('dashboard.laporan.reject', $laporan->id) }}" method="POST"
                                class="flex items-center gap-2">
                                @csrf
                                <input type="text" name="catatan" placeholder="Alasan penolakan..."
                                    class="px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-red-500 outline-none text-sm w-64">
                                <button type="submit"
                                    class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl shadow-lg shadow-red-500/20 transition-all transform hover:-translate-y-1">
                                    Tolak
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.public>