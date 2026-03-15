<x-layouts.admin>
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-800 dark:text-white transition-colors">Daftar Laporan Desa</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1 transition-colors">Riwayat seluruh laporan yang telah dikirim oleh {{ $desa->nama_desa }}.</p>
        </div>
        <a href="{{ route('dashboard.laporan.buat') }}"
            class="px-6 py-3 bg-[#166534] hover:bg-[#15803d] text-white font-bold rounded-2xl shadow-lg shadow-emerald-500/20 transition-all transform hover:-translate-y-1 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Buat Laporan Baru
        </a>
    </div>

    <div class="bg-white dark:bg-[#064e3b] rounded-3xl shadow-xl border border-slate-100 dark:border-white/5 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 dark:bg-black/20 text-slate-600 dark:text-slate-400 font-bold uppercase text-[10px] tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Judul Laporan</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                    @forelse($laporans as $l)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-black/10 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-800 dark:text-slate-100">{{ $l->judul }}</div>
                                @if($l->original_name)
                                    <div class="text-[10px] text-slate-400 mt-0.5">📎 {{ $l->original_name }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-slate-100 dark:bg-white/10 text-slate-600 dark:text-slate-300 rounded-lg text-[10px] font-bold uppercase">
                                    {{ $l->kategori }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">
                                {{ $l->tanggal_laporan->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusClass = [
                                        'pending' => 'bg-amber-100 text-amber-700',
                                        'diterima' => 'bg-emerald-100 text-emerald-700',
                                        'ditolak' => 'bg-red-100 text-red-700'
                                    ][$l->status] ?? 'bg-slate-100 text-slate-700';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $statusClass }}">
                                    {{ $l->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('dashboard.laporan.detail', $l->id) }}"
                                    class="text-[#c9900a] font-bold text-xs hover:underline">Detail →</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic">
                                Belum ada laporan yang dikirim.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($laporans->hasPages())
            <div class="px-6 py-4 bg-slate-50 dark:bg-black/10 border-t border-slate-100 dark:border-white/5">
                {{ $laporans->links() }}
            </div>
        @endif
    </div>
</x-layouts.admin>
