<x-layouts.admin>
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Master Data Desa</h1>
            <p class="text-slate-500 dark:text-slate-400">Kelola daftar desa di Kabupaten Manggarai Timur</p>
        </div>
        <a href="{{ route('dashboard.dpmd.desa.create') }}"
            class="px-5 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white font-bold rounded-xl shadow-lg shadow-emerald-500/30 transition-all flex items-center gap-2 dark:bg-emerald-600 dark:hover:bg-emerald-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                    clip-rule="evenodd" />
            </svg>
            Tambah Desa Baru
        </a>
    </div>

    <div
        class="bg-white dark:bg-slate-800 shadow-sm rounded-2xl border border-slate-100 dark:border-slate-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead
                    class="bg-slate-50 dark:bg-slate-700/50 text-slate-500 dark:text-slate-400 font-medium font-bold">
                    <tr>
                        <th class="px-6 py-4">Kode Desa</th>
                        <th class="px-6 py-4">Nama Desa</th>
                        <th class="px-6 py-4">Kecamatan</th>
                        <th class="px-6 py-4">Admin Desa</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 dark:divide-slate-700">
                    @forelse($desas as $desa)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition-colors">
                            <td class="px-6 py-4 font-mono text-xs text-slate-400">{{ $desa->kode_desa ?? '-' }}</td>
                            <td class="px-6 py-4 font-bold text-slate-700 dark:text-slate-200">{{ $desa->nama_desa }}</td>
                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">{{ $desa->kecamatan }}</td>
                            <td class="px-6 py-4">
                                @if($desa->admin)
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                        <span
                                            class="text-emerald-600 dark:text-emerald-400 font-medium">{{ $desa->admin->name }}</span>
                                    </div>
                                @else
                                    <span
                                        class="bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 px-2.5 py-1 rounded-full text-[10px] font-bold">BELUM
                                        ADA ADMIN</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('dashboard.dpmd.desa.edit', $desa->id) }}"
                                        class="p-2 text-[#166534] hover:bg-emerald-50 dark:hover:bg-emerald-500/10 rounded-lg transition-all"
                                        title="Edit Desa">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    @if(!$desa->user_id)
                                        <form action="{{ route('dashboard.dpmd.desa.destroy', $desa->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus desa ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-lg transition-all"
                                                title="Hapus Desa">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic">
                                Belum ada data desa. Klik "Tambah Desa Baru" untuk memulai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-slate-50 dark:bg-slate-700/30 border-t border-slate-100 dark:border-slate-700">
            {{ $desas->links() }}
        </div>
    </div>
</x-layouts.admin>