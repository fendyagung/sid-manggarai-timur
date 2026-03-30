<x-layouts.public title="Pintu Darurat - SID Manggarai Timur">
    <div class="min-h-screen bg-canvas dark:bg-slate-900 flex items-center justify-center p-6">
        <div class="glass-card w-full max-w-md p-10 bg-white/70 backdrop-blur-2xl rounded-3xl border border-white/50 shadow-2xl">
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-amber-50 dark:bg-amber-900/30 rounded-3xl flex items-center justify-center text-4xl mx-auto mb-6 shadow-lg shadow-amber-500/20">🔑</div>
                <h2 class="text-2xl font-black text-slate-800 dark:text-white">Pintu Darurat</h2>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-2">Gunakan salah satu dari 10 kode pemulihan Anda untuk mengatur ulang kata sandi.</p>
            </div>

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-100 dark:border-red-800 text-red-600 dark:text-red-400 rounded-2xl text-xs font-bold leading-relaxed">
                    ⚠️ {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('password.recovery') }}" method="POST">
                @csrf
                <div class="space-y-5">
                    <div class="form-group">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Username / Email Dinas</label>
                        <input type="text" name="login" required class="w-full px-5 py-4 bg-white/50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all dark:text-white" placeholder="admin@dmpd.go.id">
                    </div>

                    <div class="form-group">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Kode Pemulihan</label>
                        <input type="text" name="recovery_code" required class="w-full px-5 py-4 bg-white/50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all dark:text-white font-mono uppercase tracking-widest" placeholder="XXXX-XXXX">
                    </div>

                    <div class="form-group">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Kata Sandi Baru</label>
                        <input type="password" name="password" required class="w-full px-5 py-4 bg-white/50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all dark:text-white" placeholder="Min 8 karakter">
                    </div>

                    <div class="form-group">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Konfirmasi Kata Sandi</label>
                        <input type="password" name="password_confirmation" required class="w-full px-5 py-4 bg-white/50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all dark:text-white" placeholder="Ulangi kata sandi baru">
                    </div>

                    <button type="submit" class="w-full py-4 mt-6 bg-amber-600 hover:bg-amber-700 text-white font-black rounded-2xl shadow-xl shadow-amber-500/30 transition-all flex items-center justify-center gap-3">
                        Perbarui Kata Sandi & Masuk
                    </button>
                    
                    <a href="{{ route('login') }}" class="block text-center text-slate-400 dark:text-slate-500 text-xs font-bold hover:text-slate-600 transition-all">Kembali ke Halaman Login</a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.public>
