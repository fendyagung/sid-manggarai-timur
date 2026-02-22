<x-layouts.admin>
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-800 dark:text-white transition-colors">Kotak Berkas</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1 transition-colors">Pusat pertukaran dokumen internal
                antara Desa dan DPMD.</p>
        </div>
        <a href="{{ route('dashboard.dokumen.create') }}"
            class="px-6 py-3 bg-[#166534] hover:bg-[#15803d] text-white font-bold rounded-2xl shadow-lg shadow-emerald-500/20 transition-all transform hover:-translate-y-1 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Kirim Berkas Baru
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center gap-3 text-emerald-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="font-bold text-sm">{{ session('success') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Inbox -->
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
            <div class="p-6 bg-emerald-50/50 border-b border-slate-100 flex items-center gap-3">
                <div class="p-2 bg-emerald-100 rounded-xl text-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-2-2v4m0 0h4m-4 0H8m4 0l-4 4m4-4l4 4" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-slate-800 dark:text-white transition-colors">Berkas Masuk</h2>
            </div>
            <div class="divide-y divide-slate-50">
                @forelse($inbox as $doc)
                    <div
                        class="p-6 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-all flex items-center justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span
                                    class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest transition-colors">
                                    Diterima: {{ $doc->created_at->format('d/m/y H:i') }}
                                </span>
                                @if(!$doc->is_read)
                                    <span
                                        class="px-2 py-0.5 bg-red-100 text-red-600 text-[10px] font-bold rounded-full">BARU</span>
                                @endif
                            </div>
                            <h3
                                class="font-bold text-slate-800 dark:text-slate-100 text-lg leading-tight transition-colors">
                                {{ $doc->judul }}</h3>
                            <p class="text-sm text-slate-500 mt-1">Dari:
                                <span class="text-[#064e3b] dark:text-emerald-400 font-bold transition-colors">
                                    @if($doc->sender?->role === 'admin_dpmd')
                                        Admin (DPMD) Manggarai Timur
                                    @else
                                        {{ $doc->sender?->desa?->nama_desa ?? ($doc->sender?->name ?? 'Pengirim') }}
                                    @endif
                                </span>
                            </p>
                        </div>
                        <a href="{{ route('dashboard.dokumen.download', $doc->id) }}"
                            class="p-4 bg-[#166534] hover:bg-[#15803d] text-white rounded-2xl shadow-lg shadow-emerald-500/20 transition-all transform hover:-translate-y-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                        </a>
                    </div>
                @empty
                    <div class="p-12 text-center text-slate-400 italic">
                        Belum ada berkas masuk.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Outbox -->
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
            <div class="p-6 bg-slate-50 border-b border-slate-100 flex items-center gap-3">
                <div class="p-2 bg-slate-200 rounded-xl text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-slate-800 dark:text-white transition-colors">Berkas Terkirim</h2>
            </div>
            <div class="divide-y divide-slate-50">
                @forelse($outbox as $doc)
                    <div
                        class="p-6 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-all flex items-center justify-between gap-4">
                        <div class="flex-1 opacity-80">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                    Dikirim: {{ $doc->created_at->format('d/m/y H:i') }}
                                </span>
                                @if($doc->is_read)
                                    <span class="text-[10px] font-bold text-emerald-500 flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        DILIHAT
                                    </span>
                                @endif
                            </div>
                            <h3 class="font-bold text-slate-800 dark:text-slate-100 leading-tight transition-colors">
                                {{ $doc->judul }}</h3>
                            <p class="text-sm text-slate-500 mt-1">Ke:
                                <span class="font-bold italic dark:text-slate-300 transition-colors">
                                    @if(Auth::user()->role === 'admin_dpmd')
                                        {{ $doc->receiverDesa?->nama_desa ?? 'Penerima' }}
                                    @else
                                        Admin (DPMD) Manggarai Timur
                                    @endif
                                </span>
                            </p>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('dashboard.dokumen.download', $doc->id) }}"
                                class="p-3 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </a>
                            <form action="{{ route('dashboard.dokumen.destroy', $doc->id) }}" method="POST"
                                onsubmit="return confirm('Batalkan pengiriman berkas ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="p-3 bg-red-50 hover:bg-red-100 text-red-500 rounded-xl transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center text-slate-400 italic">
                        Belum ada riwayat pengiriman.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.admin>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('a[href*="/dashboard/dokumen/download/"]').forEach(link => {
            link.addEventListener('click', function () {
                // Find the "BARU" badge in the same item
                const item = this.closest('div.p-6');
                if (item) {
                    const badge = item.querySelector('span.bg-red-100');
                    if (badge) {
                        badge.style.display = 'none';

                        // Also update the sidebar count
                        const sidebarBadge = document.querySelector('a[href*="/dashboard/dokumen"] span.ni-badge');
                        if (sidebarBadge) {
                            let count = parseInt(sidebarBadge.innerText);
                            if (count > 1) {
                                sidebarBadge.innerText = count - 1;
                            } else {
                                sidebarBadge.style.display = 'none';
                            }
                        }
                    }
                }
            });
        });
    });
</script>