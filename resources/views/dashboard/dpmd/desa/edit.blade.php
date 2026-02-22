<x-layouts.admin>
    <div class="mb-8">
        <a href="{{ route('dashboard.dpmd.desa.index') }}"
            class="text-[#166534] hover:text-[#064e3b] flex items-center gap-2 mb-4 font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Daftar
        </a>
        <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Edit Data Desa</h1>
        <p class="text-slate-500 dark:text-slate-400">Perbarui informasi dasar desa {{ $desa->nama_desa }}</p>
    </div>

    <div
        class="max-w-2xl bg-white dark:bg-slate-800 rounded-3xl shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-700 overflow-hidden">
        <form action="{{ route('dashboard.dpmd.desa.update', $desa->id) }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('POST') {{-- Using POST since controller defines it as regular POST or we can use PUT --}}

            <div>
                <label for="nama_desa" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nama
                    Desa</label>
                <input type="text" name="nama_desa" id="nama_desa" required
                    value="{{ old('nama_desa', $desa->nama_desa) }}"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-[#064e3b] transition-all">
                <x-input-error :messages="$errors->get('nama_desa')" class="mt-2" />
            </div>

            <div>
                <label for="jenis" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Jenis
                    Wilayah</label>
                <select name="jenis" id="jenis" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-[#064e3b] transition-all">
                    <option value="desa" {{ $desa->jenis === 'desa' ? 'selected' : '' }}>Desa</option>
                    <option value="kelurahan" {{ $desa->jenis === 'kelurahan' ? 'selected' : '' }}>Kelurahan</option>
                </select>
            </div>

            <div>
                <label for="kode_desa" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Kode
                    Desa</label>
                <input type="text" name="kode_desa" id="kode_desa" value="{{ old('kode_desa', $desa->kode_desa) }}"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-[#064e3b] transition-all">
                <x-input-error :messages="$errors->get('kode_desa')" class="mt-2" />
            </div>

            <div>
                <label for="kecamatan"
                    class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Kecamatan</label>
                <select name="kecamatan" id="kecamatan" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-[#064e3b] transition-all">
                    <option value="" disabled>-- Pilih Kecamatan --</option>
                    @foreach($kecamatans as $k)
                        <option value="{{ $k->nama }}" {{ old('kecamatan', $desa->kecamatan) == $k->nama ? 'selected' : '' }}>
                            {{ $k->nama }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('kecamatan')" class="mt-2" />
            </div>

            @if($desa->admin)
                <div
                    class="p-4 bg-emerald-50 dark:bg-emerald-500/10 rounded-xl border border-emerald-100 dark:border-emerald-500/20">
                    <p class="text-sm text-emerald-800 dark:text-emerald-400">
                        <strong>Info Admin:</strong> Desa ini sudah terdaftar atas nama
                        <strong>{{ $desa->admin->name }}</strong> ({{ $desa->admin->email }}).
                    </p>
                </div>
            @endif

            <div class="pt-4">
                <button type="submit"
                    class="w-full py-4 bg-[#166534] hover:bg-[#15803d] text-white font-bold rounded-xl shadow-lg shadow-emerald-500/30 transition-all transform hover:-translate-y-0.5">
                    UPDATE DATA DESA
                </button>
            </div>
        </form>
    </div>
</x-layouts.admin>