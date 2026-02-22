<x-layouts.admin>
    <div class="p-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Potensi Wisata & Budaya</h1>
                <p class="text-slate-500 dark:text-slate-400">Kelola informasi Kuliner, Kerajinan, dan Event di desa
                    Anda.</p>
            </div>
            <a href="{{ route('dashboard.potensi.create') }}"
                class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-700 hover:bg-emerald-800 text-white font-bold rounded-xl transition-all shadow-lg shadow-emerald-500/20 dark:bg-emerald-600 dark:hover:bg-emerald-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Potensi Baru
            </a>
        </div>

        <div
            class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden transition-colors duration-300">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 dark:bg-slate-700/50">
                            <th
                                class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                                Potensi</th>
                            <th
                                class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                                Kategori</th>
                            @if(Auth::user()->role === 'admin_dpmd')
                                <th
                                    class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                                    Desa</th>
                            @endif
                            <th
                                class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-slate-700">
                        @forelse($potensis as $item)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="h-12 w-12 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0">
                                            @if($item->foto_utama)
                                                <img src="{{ asset('storage/' . $item->foto_utama) }}"
                                                    class="h-full w-full object-cover">
                                            @else
                                                <div class="h-full w-full flex items-center justify-center text-slate-400">
                                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-800 dark:text-white">{{ $item->nama_potensi }}
                                            </div>
                                            <div class="text-xs text-slate-500 truncate max-w-xs">
                                                {{ Str::limit($item->deskripsi, 50) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider shadow-sm
                                                @if($item->kategori === 'kuliner') bg-amber-50 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400 
                                                @elseif($item->kategori === 'kerajinan') bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400
                                                @elseif($item->kategori === 'event') bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400
                                                @else bg-slate-50 text-slate-700 dark:bg-slate-500/10 dark:text-slate-400 @endif">
                                        {{ $item->kategori }}
                                    </span>
                                </td>
                                @if(Auth::user()->role === 'admin_dpmd')
                                    <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400 font-medium">
                                        {{ $item->desa->nama_desa ?? 'DPMD' }}
                                    </td>
                                @endif
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('dashboard.potensi.edit', $item->id) }}"
                                            class="p-2 text-[#166534] hover:bg-emerald-50 dark:hover:bg-emerald-500/10 rounded-lg transition-all"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('dashboard.potensi.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus potensi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-lg transition-all"
                                                title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
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
                                <td colspan="5" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center justify-center text-slate-400">
                                        <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M20.24 12.24a6 6 0 00-8.49-8.49L5 10.5V19h8.5z" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" />
                                            <path d="M16 8L2 22" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" />
                                            <path d="M17.5 15H9" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" />
                                        </svg>
                                        <p class="text-lg font-medium">Belum ada data potensi.</p>
                                        <p class="text-sm">Mulai tambahkan potensi kuliner, kerajinan, atau event budaya
                                            desa Anda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($potensis->hasPages())
                <div class="px-6 py-4 border-t border-slate-50 dark:border-slate-700 bg-slate-50/30 dark:bg-slate-800/30">
                    {{ $potensis->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layouts.admin>