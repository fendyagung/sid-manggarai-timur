<x-layouts.public>
    <!-- Hero Section -->
    <section class="pt-32 pb-16 bg-slate-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto">
                <h1 class="text-4xl font-bold text-slate-900 mb-6">Hubungi Kami</h1>
                <p class="text-slate-500 text-lg">
                    Tim kami siap membantu Anda dengan informasi mengenai tata kelola desa, potensi wisata, maupun
                    bantuan teknis sistem.
                </p>
            </div>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Office Info -->
            <div class="max-w-3xl mx-auto space-y-12">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-8 flex items-center gap-3">
                        <span class="w-2 h-8 bg-blue-500 rounded-full"></span>
                        Kantor DPMD Manggarai Timur
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="flex items-start gap-5">
                            <div
                                class="w-12 h-12 bg-slate-100 rounded-2xl flex items-center justify-center text-blue-600 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 mb-1">Alamat</h4>
                                <p class="text-slate-500 text-sm leading-relaxed">
                                    {{ $profile->alamat ?? 'Jl. Trans Flores, Borong, Kabupaten Manggarai Timur, Nusa Tenggara Timur.' }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start gap-5">
                            <div
                                class="w-12 h-12 bg-slate-100 rounded-2xl flex items-center justify-center text-blue-600 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 mb-1">Telepon & Email</h4>
                                <p class="text-slate-500 text-sm">
                                    {{ $profile->telepon ?? '(0385) 123456' }} • {{ $profile->email ??
                                    'info@dpmdmatim.go.id' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Interactive Map -->
                <div
                    class="relative h-[450px] bg-slate-100 rounded-[2.5rem] overflow-hidden border border-slate-200 shadow-inner">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31555.265898516016!2d120.6080554!3d-8.831597!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2db4965ef259074b%3A0x633d26279f6e61f!2sBorong%2C%20Kabupaten%20Manggarai%20Timur!5e0!3m2!1sid!2sid!4v1706322300000!5m2!1sid!2sid"
                        class="w-full h-full border-0" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
        </div>
    </section>
</x-layouts.public>