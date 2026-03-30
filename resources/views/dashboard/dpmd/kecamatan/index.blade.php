<x-layouts.admin title="Kelola Kecamatan">
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800 dark:text-white flex items-center gap-3">
                    <span class="p-2 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg">📍</span>
                    Data Kecamatan
                </h2>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Kelola data wilayah kecamatan di Kabupaten Manggarai Timur</p>
            </div>
            
            <button onclick="openModal('modal-tambah')" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-500/20 transition-all flex items-center gap-2">
                <span>➕</span> Tambah Kecamatan
            </button>
        </div>

        <!-- Stats Card (Optional but looks premium) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/20 rounded-2xl flex items-center justify-center text-xl">🗺️</div>
                    <div>
                        <p class="text-slate-500 dark:text-slate-400 text-xs font-bold uppercase tracking-wider">Total Kecamatan</p>
                        <p class="text-2xl font-black text-slate-800 dark:text-white">{{ count($kecamatans) }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/20 rounded-2xl flex items-center justify-center text-xl">🏘️</div>
                    <div>
                        <p class="text-slate-500 dark:text-slate-400 text-xs font-bold uppercase tracking-wider">Total Desa Terdata</p>
                        <p class="text-2xl font-black text-slate-800 dark:text-white">{{ \App\Models\Desa::count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-900/50 border-bottom border-slate-200 dark:border-slate-700">
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Kecamatan</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Admin Kecamatan</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Jumlah Desa</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        @foreach($kecamatans as $index => $kec)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-900/20 transition-colors">
                            <td class="px-6 py-4 text-sm font-medium text-slate-600 dark:text-slate-300">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-slate-800 dark:text-white">{{ $kec->nama }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($kec->admin)
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                        <span class="text-sm font-bold text-blue-600 dark:text-blue-400">{{ $kec->admin->name }}</span>
                                    </div>
                                @else
                                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 text-slate-400 text-[10px] font-black rounded uppercase">Belum ada Admin</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-full text-xs font-black">
                                    {{ $kec->desas_count }} Desa
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    @if($kec->admin)
                                        <button type="button" 
                                            onclick="resetKecamatanPassword({{ $kec->id }}, '{{ $kec->nama }}', '{{ $kec->admin->name }}')"
                                            class="p-2 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 hover:bg-emerald-100 dark:hover:bg-emerald-900/40 rounded-lg transition-all" 
                                            title="Reset Kata Sandi Admin Kecamatan">
                                            🔑
                                        </button>
                                    @endif
                                    <button onclick="openEditModal({{ $kec->id }}, '{{ $kec->nama }}')" class="p-2 bg-amber-50 dark:bg-amber-900/20 text-amber-600 hover:bg-amber-100 dark:hover:bg-amber-900/40 rounded-lg transition-all" title="Edit">
                                        ✏️
                                    </button>
                                    <button onclick="confirmDelete({{ $kec->id }}, '{{ $kec->nama }}')" class="p-2 bg-red-50 dark:bg-red-900/20 text-red-600 hover:bg-red-100 dark:hover:bg-red-900/40 rounded-lg transition-all" title="Hapus">
                                        🗑️
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div id="modal-tambah" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeModal('modal-tambah')"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md p-6 bg-white dark:bg-slate-800 rounded-3xl shadow-2xl border border-white/20">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-black text-slate-800 dark:text-white">Tambah Kecamatan</h3>
                <button onclick="closeModal('modal-tambah')" class="text-slate-400 hover:text-slate-600 font-bold">✕</button>
            </div>
            
            <form action="{{ route('dashboard.dpmd.kecamatan.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Nama Kecamatan</label>
                        <input type="text" name="nama" required class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all dark:text-white" placeholder="Contoh: Borong">
                    </div>
                </div>
                <div class="mt-8 flex gap-3">
                    <button type="button" onclick="closeModal('modal-tambah')" class="flex-1 py-3 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 font-bold rounded-2xl hover:bg-slate-200 transition-all text-sm">Batal</button>
                    <button type="submit" class="flex-2 px-8 py-3 bg-emerald-600 text-white font-black rounded-2xl hover:bg-emerald-700 shadow-lg shadow-emerald-500/20 transition-all text-sm">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="modal-edit" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeModal('modal-edit')"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md p-6 bg-white dark:bg-slate-800 rounded-3xl shadow-2xl border border-white/20">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-black text-slate-800 dark:text-white">Edit Kecamatan</h3>
                <button onclick="closeModal('modal-edit')" class="text-slate-400 hover:text-slate-600 font-bold">✕</button>
            </div>
            
            <form id="form-edit" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Nama Kecamatan</label>
                        <input type="text" name="nama" id="edit-nama" required class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all dark:text-white">
                    </div>
                </div>
                <div class="mt-8 flex gap-3">
                    <button type="button" onclick="closeModal('modal-edit')" class="flex-1 py-3 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 font-bold rounded-2xl hover:bg-slate-200 transition-all text-sm">Batal</button>
                    <button type="submit" class="flex-2 px-8 py-3 bg-amber-600 text-white font-black rounded-2xl hover:bg-amber-700 shadow-lg shadow-amber-500/20 transition-all text-sm">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div id="modal-hapus" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeModal('modal-hapus')"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-sm p-8 bg-white dark:bg-slate-800 rounded-3xl shadow-2xl border border-white/20 text-center">
            <div class="w-20 h-20 bg-red-100 dark:bg-red-900/20 rounded-full flex items-center justify-center text-4xl mx-auto mb-6">⚠️</div>
            <h3 class="text-xl font-black text-slate-800 dark:text-white mb-2">Hapus Kecamatan?</h3>
            <p class="text-slate-500 dark:text-slate-400 text-sm mb-8">Kecamatan <span id="hapus-nama" class="font-bold text-red-600"></span> akan dihapus permanen dari sistem.</p>
            
            <form id="form-hapus" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex gap-3">
                    <button type="button" onclick="closeModal('modal-hapus')" class="flex-1 py-3 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 font-bold rounded-2xl hover:bg-slate-200 transition-all text-sm">Batal</button>
                    <button type="submit" class="flex-1 py-3 bg-red-600 text-white font-bold rounded-2xl hover:bg-red-700 transition-all text-sm">Hapus</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function openEditModal(id, nama) {
            const form = document.getElementById('form-edit');
            form.action = `/dashboard/dpmd/kecamatan/${id}/update`;
            document.getElementById('edit-nama').value = nama;
            openModal('modal-edit');
        }

        function confirmDelete(id, nama) {
            const form = document.getElementById('form-hapus');
            form.action = `/dashboard/dpmd/kecamatan/${id}`;
            document.getElementById('hapus-nama').textContent = nama;
            openModal('modal-hapus');
        }

        function resetKecamatanPassword(id, namaKec, namaAdmin) {
            const newPassword = prompt(`Masukkan kata sandi baru untuk Admin Kecamatan ${namaKec} (${namaAdmin}):\n(Minimal 8 karakter)`);
            
            if (newPassword === null) return;
            
            if (newPassword.length < 8) {
                alert('Kata sandi harus minimal 8 karakter!');
                return;
            }
            
            if (confirm(`Apakah Anda yakin ingin mereset kata sandi ${namaAdmin} menjadi: "${newPassword}"?`)) {
                const form = document.getElementById('resetPasswordForm');
                form.action = `/dashboard/dpmd/kecamatan/${id}/reset-password`;
                document.getElementById('newPasswordInput').value = newPassword;
                form.submit();
            }
        }
    </script>
    
    {{-- Form Hidden untuk Reset Password --}}
    <form id="resetPasswordForm" method="POST" action="" class="hidden">
        @csrf
        <input type="hidden" name="password" id="newPasswordInput">
    </form>
</x-layouts.admin>
