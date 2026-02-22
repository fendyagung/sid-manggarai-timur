<x-layouts.admin>
    <div
        class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl overflow-hidden border border-slate-100 dark:border-slate-700 mb-8 transition-colors">
        <div class="p-8 bg-emerald-900 text-white flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold">Manajemen Berita & Kegiatan</h1>
                <p class="text-emerald-100/80">Kelola semua artikel berita yang tampil di halaman publik.</p>
            </div>
            <a href="{{ route('dashboard.beritas.create') }}"
                class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 dark:bg-emerald-500 dark:hover:bg-emerald-400 rounded-xl transition-all shadow-lg shadow-emerald-900/20 font-bold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tulis Berita Baru
            </a>
        </div>

        <div class="p-0">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead
                        class="bg-slate-50 dark:bg-slate-700/50 border-b border-slate-100 dark:border-slate-700 text-slate-500 dark:text-slate-400 font-bold uppercase text-xs">
                        <tr>
                            <th class="px-8 py-4">Gambar</th>
                            <th class="px-8 py-4">Judul Berita</th>
                            @if(Auth::user()->role === 'admin_dpmd')
                                <th class="px-8 py-4">Penulis</th>
                            @endif
                            <th class="px-8 py-4">Kategori</th>
                            <th class="px-8 py-4">Status</th>
                            <th class="px-8 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-slate-700">
                        @forelse($beritas as $berita)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-4">
                                    <div class="w-16 h-12 rounded-lg bg-slate-100 overflow-hidden border border-slate-200">
                                        @if($berita->foto)
                                            <a href="{{ asset('storage/' . $berita->foto) }}" data-fslightbox="gallery"
                                                class="block w-full h-full group/img">
                                                <img src="{{ asset('storage/' . $berita->foto) }}"
                                                    class="w-full h-full object-cover transition-transform group-hover/img:scale-110">
                                            </a>
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-8 py-4">
                                    <div class="font-bold text-slate-800">{{ $berita->judul }}</div>
                                    <div class="text-xs text-slate-400">{{ $berita->created_at->format('d M Y') }}</div>
                                </td>
                                @if(Auth::user()->role === 'admin_dpmd')
                                    <td class="px-8 py-4">
                                        <div class="inline-flex items-center gap-2 px-2 py-1 bg-slate-100 rounded-md">
                                            <span class="text-xs font-semibold text-slate-600">{{ $berita->penulis }}</span>
                                        </div>
                                    </td>
                                @endif
                                <td class="px-8 py-4">
                                    <span class="text-xs font-medium px-2 py-1 bg-blue-50 text-blue-600 rounded-md">
                                        {{ ucfirst($berita->kategori) }}
                                    </span>
                                </td>
                                <td class="px-8 py-4">
                                    <span
                                        class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-bold {{ $berita->status === 'publikasi' ? 'bg-emerald-100 text-emerald-700' : 'bg-orange-100 text-orange-700' }}">
                                        <span
                                            class="w-1.5 h-1.5 rounded-full {{ $berita->status === 'publikasi' ? 'bg-emerald-500' : 'bg-orange-500' }}"></span>
                                        {{ ucfirst($berita->status) }}
                                    </span>
                                </td>
                                <td class="px-8 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('dashboard.beritas.edit', $berita->id) }}"
                                            class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('dashboard.beritas.destroy', $berita->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-8 py-20 text-center">
                                    <div
                                        class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                        </svg>
                                    </div>
                                    <p class="text-slate-500 font-medium">Belum ada berita yang diterbitkan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($beritas->hasPages())
            <div class="px-8 py-6 bg-slate-50 border-t border-slate-100">
                {{ $beritas->links() }}
            </div>
        @endif
    </div>
    </div>
</x-layouts.admin>