<x-layouts.admin>
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('dashboard.dokumen.index') }}"
            class="p-3 bg-white border border-slate-100 rounded-2xl text-slate-500 hover:text-[#064e3b] shadow-sm transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-3xl font-bold text-slate-800 dark:text-white">Kirim Berkas</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Unggah dokumen untuk dikirim ke
                @if(Auth::user()->role === 'admin_dpmd') Desa
                @else DPMD @endif.
            </p>
        </div>
    </div>

    <div class="max-w-3xl">
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
            <form action="{{ route('dashboard.dokumen.store') }}" method="POST" enctype="multipart/form-data"
                class="p-8 space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama / Judul Berkas</label>
                    <input type="text" name="judul" required
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-emerald-50 focus:border-[#064e3b] outline-none transition-all placeholder:text-slate-400"
                        placeholder="Contoh: Lampiran Perencanaan Desa 2026">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Pilih Penerima Berkas</label>
                    <div class="relative">
                        <select name="receiver_id" required
                            class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all appearance-none cursor-pointer">
                            @if(Auth::user()->role === 'admin_dpmd')
                                <option value="" disabled selected>-- Pilih Desa Tujuan --</option>
                                <option value="all" class="font-bold text-[#d97706] tracking-wide bg-amber-50">✨ KIRIM KE
                                    SEMUA
                                    DESA (BROADCAST)</option>
                                @foreach($desas as $desa)
                                    <option value="{{ $desa->id }}">{{ $desa->nama_desa }}</option>
                                @endforeach
                            @else
                                @foreach($dpmdAdmins as $admin)
                                    <option value="{{ $admin->id }}" selected>Admin (DPMD) Manggarai Timur ({{ $admin->name }})
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <div
                            class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    @if(Auth::user()->role === 'admin_desa')
                        <p class="mt-2 text-xs text-[#064e3b] font-medium">✨ Berkas ini akan dikirimkan langsung ke
                            Dashboard
                            Admin (DPMD) Manggarai Timur.</p>
                    @endif
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Unggah File (Max
                        10MB)</label>
                    <input type="file" name="file" required
                        class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl focus:ring-4 focus:ring-emerald-50 dark:focus:ring-emerald-900/20 focus:border-[#064e3b] outline-none transition-all file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-emerald-700 file:text-white hover:file:bg-emerald-800 dark:file:bg-emerald-600 dark:hover:file:bg-emerald-500">
                    <p class="mt-2 text-xs text-slate-400 dark:text-slate-500 italic font-medium">* Format dokumen: pdf,
                        doc, docx, xls,
                        xlsx, zip, rar, dll.</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Keterangan / Pesan Tambahan
                        (Opsional)</label>
                    <textarea name="keterangan" rows="4"
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all placeholder:text-slate-400"
                        placeholder="Tambahkan catatan singkat mengenai berkas ini jika perlu..."></textarea>
                </div>

                <div class="pt-4 border-t border-slate-50 dark:border-slate-700 flex justify-end">
                    <button type="submit"
                        class="px-10 py-4 bg-emerald-700 hover:bg-emerald-800 text-white font-bold rounded-2xl shadow-xl shadow-emerald-500/20 transition-all transform hover:-translate-y-1 flex items-center gap-3 dark:bg-emerald-600 dark:hover:bg-emerald-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        Kirim Berkas Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>