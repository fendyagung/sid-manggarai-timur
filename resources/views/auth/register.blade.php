<x-layouts.public>
    <div style="display:none">v1.0.2-checked</div>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <!-- Register Card -->
        <div class="max-w-sm w-full mx-auto space-y-6 bg-white p-6 rounded-2xl shadow-xl" style="max-width: 400px;">
            <div class="text-center">
                <h2 class="text-slate-700 text-lg font-bold mb-1">
                    @if($role === 'admin_dpmd')
                        🏛️ Registrasi Admin Dinas
                    @else
                        🏘️ Registrasi Admin Desa
                    @endif
                </h2>

                @if($role === 'admin_dpmd' && $dpmdAdminExists)
                    <div class="mt-4 p-4 bg-amber-50 border border-amber-200 rounded-xl">
                        <p class="text-amber-800 text-sm font-semibold">⚠️ Akun Sudah Ada</p>
                        <p class="text-amber-600 text-xs mt-1">Sistem hanya mengizinkan satu akun Admin Dinas. Silakan
                            hubungi admin utama jika Anda lupa password.</p>
                        <a href="{{ route('login') }}"
                            class="inline-block mt-3 text-xs font-bold text-amber-700 hover:underline">Kembali ke Login</a>
                    </div>
                @elseif($role === 'admin_desa' && $availableDesas->isEmpty())
                    <div class="mt-4 p-4 bg-amber-50 border border-amber-200 rounded-xl">
                        <p class="text-amber-800 text-sm font-semibold">⚠️ Kuota Penuh</p>
                        <p class="text-amber-600 text-xs mt-1">Seluruh desa saat ini sudah memiliki admin terdaftar atau
                            tidak ada desa tersedia.</p>
                        <a href="{{ route('login') }}"
                            class="inline-block mt-3 text-xs font-bold text-amber-700 hover:underline">Kembali ke Login</a>
                    </div>
                @else
                    <p class="text-slate-400 text-xs">Buat akun untuk mengakses sistem</p>
                @endif
            </div>

            @if(!($role === 'admin_dpmd' && $dpmdAdminExists) && !($role === 'admin_desa' && $availableDesas->isEmpty()))
                <form action="{{ route('register') }}" method="POST" class="space-y-4">
                    @csrf
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-400 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" id="name" required autofocus value="{{ old('name') }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg text-gray-900 placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                            placeholder="John Doe">
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-400 mb-1">Email Address</label>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg text-gray-900 placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                            placeholder="nama@email.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <!-- Role Display & Logic -->
                    <input type="hidden" name="role" value="{{ $role ?? 'admin_desa' }}">
                    <div>
                        <label class="block text-sm font-medium text-slate-400 mb-1">Tingkatan Akun</label>
                        <div
                            class="px-3 py-2 text-sm border border-gray-200 bg-gray-50 rounded-lg text-gray-700 font-medium">
                            {{ $role === 'admin_dpmd' ? '🏛️ Admin Dinas' : '🏘️ Admin Desa' }}
                        </div>
                    </div>

                    <!-- Desa Selector (Only for Admin Desa) -->
                    @if($role !== 'admin_dpmd')
                        <div id="desa_selector">
                            <label for="desa_id" class="block text-sm font-medium text-slate-400 mb-1">Pilih Desa</label>
                            <select name="desa_id" id="desa_id" required
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                                <option value="">-- Pilih Desa Anda --</option>
                                @foreach($availableDesas as $desa)
                                    <option value="{{ $desa->id }}" {{ old('desa_id') == $desa->id ? 'selected' : '' }}>
                                        {{ $desa->nama_desa }} ({{ $desa->kecamatan }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('desa_id')" class="mt-1" />
                        </div>
                    @endif

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-400 mb-1">Password</label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg text-gray-900 placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                            placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-400 mb-1">Konfirmasi
                            Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg text-gray-900 placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                            placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                    </div>

                    <button type="submit"
                        class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg shadow-lg shadow-indigo-500/30 transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Daftar
                    </button>
                </form>
            @endif

            <div class="text-center mt-4 border-t border-gray-100 pt-4">
                <p class="text-sm text-gray-400">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-medium text-indigo-500 hover:text-indigo-400">
                        Masuk disini
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-layouts.public>