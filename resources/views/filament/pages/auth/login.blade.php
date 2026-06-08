<div
    class="login-container flex min-h-screen bg-slate-950 text-slate-100 selection:bg-emerald-500 selection:text-white w-full overflow-y-auto"
>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Custom Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        .login-container {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .heading-font {
            font-family: 'Outfit', sans-serif;
        }
        .glass-input input {
            background: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            border-radius: 0.75rem !important;
            color: #f1f5f9 !important;
            transition: all 0.2s ease-in-out !important;
        }
        .glass-input input:focus {
            border-color: #10b981 !important;
            box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2) !important;
            background: rgba(255, 255, 255, 0.05) !important;
        }
        .glass-input input::placeholder {
            color: #64748b !important;
        }
        .fi-fo-field-wrp-label label {
            color: #cbd5e1 !important;
            font-weight: 500 !important;
            font-size: 0.875rem !important;
        }
        /* Filament notifications positioning for dark login */
        .fi-notification {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }
        /* Error text styling */
        .fi-fo-field-wrp-error-message {
            color: #f87171 !important;
            font-size: 0.8rem !important;
            margin-top: 0.25rem;
        }
        /* Password toggle icon color */
        .fi-input-wrp button svg {
            color: #94a3b8 !important;
        }
        .fi-input-wrp button:hover svg {
            color: #e2e8f0 !important;
        }
    </style>

    {{-- LEFT PANEL: Visuals & Branding (Desktop Only) --}}
    <div class="hidden lg:flex lg:w-[55%] xl:w-[60%] relative overflow-hidden flex-col justify-between p-16 select-none">
        {{-- Background Image with Overlay --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('assets/images/backgrounds/hero.jpg') }}" alt="Desa Lemusa" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/80 to-slate-950/50"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
        </div>

        {{-- Top Header Info --}}
        <div class="relative z-10 flex items-center gap-3">
            <img src="{{ asset('assets/images/logos/logo-parimo.png') }}" alt="Logo Parimo" class="h-12 w-auto object-contain">
            <div>
                <span class="block heading-font font-bold text-lg text-white leading-none tracking-wide">Pemerintah Kabupaten Parigi Moutong</span>
                <span class="block text-xs text-slate-400 mt-1">Kecamatan Parigi Selatan</span>
            </div>
        </div>

        {{-- Middle Core Welcome --}}
        <div class="relative z-10 max-w-xl my-auto">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-500/10 text-emerald-400 text-xs font-semibold mb-6 border border-emerald-500/20 backdrop-blur-md">
                <span class="flex h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                Sistem Informasi Desa
            </div>
            <h1 class="heading-font text-4xl xl:text-5xl font-extrabold text-white leading-tight mb-6 tracking-tight">
                Portal Pelayanan Digital <br/>
                <span class="text-emerald-400 bg-gradient-to-r from-emerald-400 to-teal-300 bg-clip-text text-transparent">Desa Lemusa</span>
            </h1>
            <p class="text-base text-slate-300 leading-relaxed mb-8">
                Masuk ke dalam sistem informasi untuk mengakses pengajuan surat mandiri, laporan pengaduan, dan data kependudukan terpadu dengan cepat, aman, dan transparan.
            </p>

            {{-- Feature Checklist Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="flex gap-3 items-start">
                    <div class="p-2 bg-emerald-500/10 rounded-lg text-emerald-400 border border-emerald-500/10">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-white text-sm">Persuratan Mandiri</h4>
                        <p class="text-xs text-slate-400 mt-0.5">Pembuatan surat online tanpa antre lama.</p>
                    </div>
                </div>
                <div class="flex gap-3 items-start">
                    <div class="p-2 bg-emerald-500/10 rounded-lg text-emerald-400 border border-emerald-500/10">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-white text-sm">Aspirasi & Laporan</h4>
                        <p class="text-xs text-slate-400 mt-0.5">Sampaikan pengaduan infrastruktur langsung.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer Info --}}
        <div class="relative z-10 text-xs text-slate-500">
            &copy; 2026 Pemerintah Desa Lemusa. Hak Cipta Dilindungi.
        </div>
    </div>

    {{-- RIGHT PANEL: Login Form --}}
    <div class="w-full lg:w-[45%] xl:w-[40%] flex flex-col justify-between p-6 sm:p-12 md:p-16 lg:p-12 xl:p-16 bg-slate-900/60 backdrop-blur-md relative border-l border-white/5 min-h-screen">
        {{-- Top Back Nav & Brand Logo for mobile --}}
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs text-slate-400 hover:text-emerald-400 font-semibold transition-colors group">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Beranda
            </a>

            <div class="lg:hidden flex items-center gap-2">
                <img src="{{ asset('assets/images/logos/logo-parimo.png') }}" alt="Logo" class="h-8 w-auto">
                <span class="heading-font font-bold text-sm text-white">Desa Lemusa</span>
            </div>
        </div>

        {{-- Center Login Area --}}
        <div class="my-auto py-8">
            <div class="mb-8">
                <h2 class="heading-font text-3xl font-extrabold text-white tracking-tight">Selamat Datang</h2>
                <p class="text-sm text-slate-400 mt-2">Silakan masuk menggunakan kredensial terdaftar Anda.</p>
            </div>

            {{-- Login Form --}}
            <form wire:submit="authenticate" class="space-y-5 mt-6">
                <div class="glass-input">
                    {{ $this->form }}
                </div>

                {{-- Inline Validation Error Messages --}}
                @if ($errors->any())
                    <div class="rounded-xl bg-red-500/10 border border-red-500/20 px-4 py-3 mt-2">
                        @foreach ($errors->all() as $error)
                            <p class="text-sm text-red-400 flex items-start gap-2">
                                <svg class="w-4 h-4 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.072 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                                {{ $error }}
                            </p>
                        @endforeach
                    </div>
                @endif

                {{-- Submit Button --}}
                <button
                    type="submit"
                    class="w-full flex justify-center items-center py-3.5 px-4 rounded-xl text-white bg-emerald-600 hover:bg-emerald-500 active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-slate-900 transition-all font-semibold shadow-lg shadow-emerald-600/30 text-sm tracking-wide disabled:opacity-60 disabled:cursor-not-allowed"
                    wire:loading.attr="disabled"
                >
                    {{-- Normal text state --}}
                    <span wire:loading.remove wire:target="authenticate" class="flex items-center gap-2">
                        Masuk Portal
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </span>
                    {{-- Loading state --}}
                    <span wire:loading wire:target="authenticate" class="flex items-center justify-center gap-2" x-cloak>
                        <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memverifikasi...
                    </span>
                </button>
            </form>
        </div>

        {{-- Footer Helper Support --}}
        <div class="border-t border-white/5 pt-6 text-center lg:text-left">
            <p class="text-xs text-slate-400 leading-relaxed">
                Butuh bantuan login atau pendaftaran akun? <br class="hidden sm:block" />
                Hubungi administrator kantor desa Lemusa di <a href="mailto:pemdes@lemusa.desa.id" class="text-emerald-400 hover:text-emerald-300 font-semibold underline decoration-dotted">pemdes@lemusa.desa.id</a>
            </p>
        </div>
    </div>
</div>
