<x-layouts.admin>
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
        <div
            class="p-8 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center text-slate-600 dark:text-slate-400 transition-colors">
            <a href="{{ route('dashboard.pesans') }}"
                class="flex items-center gap-2 hover:text-emerald-600 dark:hover:text-emerald-400 font-bold transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Inbox
            </a>
            <div class="text-sm font-medium">{{ \Carbon\Carbon::parse($pesan->created_at)->format('d F Y • H:i') }}
            </div>
        </div>

        <div class="p-8 md:p-12">
            <div
                class="flex items-center gap-6 mb-10 pb-8 border-b border-slate-100 dark:border-slate-700 transition-colors">
                <div
                    class="w-16 h-16 rounded-2xl bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-700 dark:text-emerald-400 text-2xl font-bold uppercase transition-colors">
                    {{ substr($pesan->nama, 0, 1) }}
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-1 transition-colors">
                        {{ $pesan->nama }}</h2>
                    <p class="text-slate-500 dark:text-slate-400 transition-colors">{{ $pesan->email }}</p>
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <label
                        class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest block mb-2 transition-colors">Perihal
                        / Subjek</label>
                    <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 transition-colors">
                        {{ $pesan->subjek ?? 'Tanpa Subjek' }}</h3>
                </div>

                <div class="pt-6">
                    <label
                        class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest block mb-4 transition-colors">Isi
                        Pesan</label>
                    <div
                        class="text-lg text-slate-700 dark:text-slate-200 leading-relaxed bg-slate-50 dark:bg-slate-800/50 p-8 rounded-3xl border border-slate-100 dark:border-slate-700 min-h-[200px] transition-colors">
                        {!! nl2br(e($pesan->pesan)) !!}
                    </div>
                </div>

                @if($pesan->lampiran)
                    <div class="pt-6">
                        <label
                            class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-4">Lampiran</label>
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 flex items-center gap-4">
                            @php
                                $extension = pathinfo($pesan->lampiran, PATHINFO_EXTENSION);
                                $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                            @endphp

                            @if($isImage)
                                <div class="w-20 h-20 rounded-xl overflow-hidden border border-slate-200 bg-white">
                                    <img src="{{ asset('storage/' . $pesan->lampiran) }}" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div
                                    class="w-20 h-20 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-400">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif

                            <div>
                                <p class="text-sm font-bold text-slate-700 dark:text-slate-200 mb-1">File Lampiran
                                    ({{ strtoupper($extension) }})</p>
                                <a href="{{ asset('storage/' . $pesan->lampiran) }}" target="_blank"
                                    class="text-emerald-700 dark:text-emerald-400 hover:text-emerald-800 dark:hover:text-emerald-300 text-sm font-bold underline transition-colors">
                                    Lihat / Download File →
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
                @if($pesan->balasan)
                    <div class="pt-8 mt-8 border-t border-slate-100 dark:border-slate-700 transition-colors">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600 dark:text-emerald-400 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M3 10h10a8 8 0 018 8v2M3 10l5 5m-5-5l5-5" />
                                </svg>
                            </div>
                            <label
                                class="text-[10px] font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-widest transition-colors">Balasan
                                dari
                                Admin DPMD</label>
                            <span
                                class="text-[10px] text-slate-400 dark:text-slate-500 font-medium ml-auto transition-colors">{{ $pesan->balasan_at ? \Carbon\Carbon::parse($pesan->balasan_at)->format('d M Y • H:i') : '' }}</span>
                        </div>
                        <div
                            class="text-lg text-emerald-900 dark:text-emerald-100 leading-relaxed bg-emerald-50/50 dark:bg-emerald-900/10 p-8 rounded-3xl border border-emerald-100 dark:border-emerald-800 transition-colors">
                            {!! nl2br(e($pesan->balasan)) !!}
                        </div>
                    </div>
                @endif
            </div>

            @if(Auth::user()->role === 'admin_dpmd')
                <div
                    class="mt-12 flex flex-wrap items-center gap-4 border-t border-slate-100 dark:border-slate-700 pt-8 transition-colors">
                    <a href="#reply-section"
                        class="px-8 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-2xl shadow-xl shadow-emerald-500/20 transition-all transform hover:-translate-y-1">
                        Tulis Balasan
                    </a>
                    <button onclick="copyEmail('{{ $pesan->email }}')"
                        class="px-8 py-4 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 hover:bg-emerald-100 dark:hover:bg-emerald-900/50 font-bold rounded-2xl transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                        </svg>
                        Salin Alamat Email
                    </button>
                    <button onclick="window.print()"
                        class="px-8 py-4 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 font-bold rounded-2xl transition-all">
                        Cetak Pesan
                    </button>
                    <form action="{{ route('dashboard.pesans.destroy', $pesan->id) }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-8 py-4 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900/40 font-bold rounded-2xl transition-all">
                            Hapus Pesan
                        </button>
                    </form>
                </div>

                <div id="reply-section"
                    class="mt-12 pt-12 border-t border-slate-100 dark:border-slate-700 transition-colors">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Tulis Balasan</h3>
                    <form action="{{ route('dashboard.pesans.reply', $pesan->id) }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <textarea name="balasan" rows="6" required
                                class="w-full p-6 text-lg bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-3xl focus:ring-4 focus:ring-emerald-50 dark:focus:ring-emerald-900/20 focus:border-emerald-500 dark:focus:border-emerald-500 transition-all outline-none dark:text-slate-200"
                                placeholder="Ketik balasan Anda di sini..."></textarea>
                        </div>
                        <div>
                            <button type="submit"
                                class="px-10 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-2xl shadow-xl shadow-emerald-500/20 transition-all transform hover:-translate-y-1 flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                Kirim Balasan & Simpan di Database
                            </button>
                        </div>
                    </form>
                </div>
            @endif


            <script>
                function copyEmail(email) {
                    navigator.clipboard.writeText(email).then(() => {
                        alert('Alamat email berhasil disalin ke clipboard!');
                    });
                }
            </script>
        </div>
    </div>
</x-layouts.admin>