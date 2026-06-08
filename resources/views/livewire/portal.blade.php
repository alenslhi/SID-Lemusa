<div class="min-h-screen bg-[#020617] text-slate-300 font-sans selection:bg-emerald-500/30">
    {{-- Background Glows --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] rounded-full bg-emerald-500/10 blur-[120px]"></div>
        <div class="absolute top-[20%] -right-[10%] w-[30%] h-[50%] rounded-full bg-blue-500/10 blur-[120px]"></div>
        <div class="absolute -bottom-[10%] left-[20%] w-[50%] h-[30%] rounded-full bg-purple-500/10 blur-[120px]"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Navbar / Top Bar --}}
        <div class="flex justify-between items-center mb-16">
            <div class="flex items-center gap-4">
                <div class="p-2.5 bg-white/5 backdrop-blur-md rounded-2xl border border-white/10 shadow-xl">
                    <img src="{{ asset('assets/images/logos/logo-parimo.png') }}" alt="Logo" class="h-10 w-auto">
                </div>
                <div>
                    <h2 class="text-white font-bold tracking-tight text-lg leading-none">SID LEMUSA</h2>
                    <span class="text-[10px] text-emerald-500 font-bold uppercase tracking-[0.2em]">Digital Government</span>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="hidden sm:flex flex-col text-right mr-2">
                    <span class="text-sm font-bold text-white leading-none">{{ $user->name }}</span>
                    <span class="text-[10px] text-slate-500 uppercase font-bold tracking-wider mt-1">{{ $roles->first() }}</span>
                </div>
                <form method="POST" action="/admin/logout">
                    @csrf
                    <button type="submit" class="p-3 bg-white/5 hover:bg-rose-500/20 hover:text-rose-400 border border-white/10 rounded-2xl transition-all duration-300 group">
                        <x-heroicon-o-arrow-right-start-on-rectangle class="w-6 h-6 transition-transform group-hover:translate-x-1" />
                    </button>
                </form>
            </div>
        </div>

        {{-- Hero Section --}}
        <div class="relative mb-20">
            <div class="max-w-3xl">
                <h1 class="text-5xl sm:text-7xl font-black text-white leading-[1.1] tracking-tight mb-8" style="font-family: 'Outfit', sans-serif;">
                    Layanan Digital <br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-cyan-400 to-blue-500">
                        Satu Pintu.
                    </span>
                </h1>
                <p class="text-lg text-slate-400 leading-relaxed max-w-xl">
                    Selamat datang di ekosistem digital Desa Lemusa. Akses semua layanan administrasi, kependudukan, dan informasi publik dalam satu platform terintegrasi.
                </p>
            </div>
        </div>

        {{-- Main Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 lg:gap-8">
            
            {{-- System Admin Card (LGC: 4/12) --}}
            @if($user->hasAnyRole(['Super Admin', 'Kepala Desa', 'Operator Desa']))
            <div class="md:col-span-12 lg:col-span-5 group relative">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-[2.5rem] blur opacity-20 group-hover:opacity-40 transition duration-500"></div>
                <div class="relative h-full bg-[#0f172a]/80 backdrop-blur-xl border border-white/10 p-10 rounded-[2.5rem] flex flex-col overflow-hidden">
                    <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:opacity-20 transition-opacity duration-500">
                        <x-heroicon-o-cpu-chip class="w-32 h-32 text-emerald-500" />
                    </div>
                    
                    <div class="mb-8 p-4 bg-emerald-500/10 rounded-2xl w-max border border-emerald-500/20 text-emerald-400">
                        <x-heroicon-o-squares-plus class="w-8 h-8" />
                    </div>

                    <h3 class="text-3xl font-bold text-white mb-4 leading-tight">Sistem <br/>Administrasi Desa</h3>
                    <p class="text-slate-400 mb-10 flex-grow leading-relaxed">
                        Kelola infrastruktur data desa, validasi pengajuan warga, dan kendalikan operasional pemerintahan dalam satu dashboard kontrol.
                    </p>

                    <a href="{{ route('desa.dashboard') }}" class="group/btn relative inline-flex items-center justify-center px-8 py-4 font-bold text-white transition-all duration-300 bg-emerald-600 rounded-2xl hover:bg-emerald-500 shadow-[0_10px_40px_-10px_rgba(16,185,129,0.5)]">
                        <span>Buka Dashboard Admin</span>
                        <x-heroicon-s-arrow-right class="w-5 h-5 ml-3 transition-transform group-hover/btn:translate-x-2" />
                    </a>
                </div>
            </div>
            @endif

            {{-- Right Column (Grid 7/12) --}}
            <div class="md:col-span-12 lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-6 lg:gap-8">
                
                {{-- Citizen Card --}}
                <div class="group relative">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-[2rem] blur opacity-10 group-hover:opacity-30 transition duration-500"></div>
                    <div class="relative h-full bg-[#0f172a]/80 backdrop-blur-xl border border-white/10 p-8 rounded-[2rem] flex flex-col transition-all duration-300 hover:translate-y-[-4px]">
                        <div class="mb-6 p-3.5 bg-blue-500/10 rounded-xl w-max border border-blue-500/20 text-blue-400">
                            <x-heroicon-o-user-group class="w-7 h-7" />
                        </div>
                        
                        <h3 class="text-xl font-bold text-white mb-3">Portal Warga</h3>
                        
                        @if($personal)
                            <div class="flex flex-col gap-2 mb-6">
                                <div class="flex items-center justify-between text-xs font-bold text-slate-500 uppercase tracking-widest bg-blue-500/5 p-3 rounded-xl border border-blue-500/10">
                                    <span>Approval Surat</span>
                                    <span class="text-blue-400">{{ $personal['surat_pending'] }}</span>
                                </div>
                                <div class="flex items-center justify-between text-xs font-bold text-slate-500 uppercase tracking-widest bg-indigo-500/5 p-3 rounded-xl border border-indigo-500/10">
                                    <span>Riwayat Aduan</span>
                                    <span class="text-indigo-400">{{ $personal['pengaduan_total'] }}</span>
                                </div>
                            </div>
                        @else
                            <p class="text-sm text-slate-500 mb-8 flex-grow leading-relaxed">
                                Akses data kependudukan secara mandiri dan ajukan surat keterangan tanpa harus ke kantor desa.
                            </p>
                        @endif

                        <a href="/warga/dashboard" class="mt-auto px-6 py-3 rounded-xl bg-blue-600/10 hover:bg-blue-600 text-blue-400 hover:text-white border border-blue-500/20 transition-all text-center font-bold">
                            Masuk Portal
                        </a>
                    </div>
                </div>

                {{-- Public Web Card --}}
                <div class="group relative">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-amber-500 to-orange-500 rounded-[2rem] blur opacity-10 group-hover:opacity-30 transition duration-500"></div>
                    <div class="relative h-full bg-[#0f172a]/80 backdrop-blur-xl border border-white/10 p-8 rounded-[2rem] flex flex-col transition-all duration-300 hover:translate-y-[-4px]">
                        <div class="mb-6 p-3.5 bg-amber-500/10 rounded-xl w-max border border-amber-500/20 text-amber-400">
                            <x-heroicon-o-globe-alt class="w-7 h-7" />
                        </div>
                        
                        <h3 class="text-xl font-bold text-white mb-2">Informasi Publik</h3>
                        <p class="text-sm text-slate-500 mb-6 flex-grow leading-relaxed">
                            Informasi berita pembangunan, agenda desa, dan transparansi anggaran untuk seluruh masyarakat.
                        </p>

                        <div class="flex items-center gap-4 mb-8">
                            <div class="text-center bg-white/5 px-3 py-2 rounded-lg flex-1">
                                <span class="block text-white font-bold text-lg leading-none">{{ $stats['berita'] }}</span>
                                <span class="text-[9px] text-slate-500 font-bold uppercase tracking-tighter">Berita</span>
                            </div>
                            <div class="text-center bg-white/5 px-3 py-2 rounded-lg flex-1">
                                <span class="block text-white font-bold text-lg leading-none">{{ $stats['agenda'] }}</span>
                                <span class="text-[9px] text-slate-500 font-bold uppercase tracking-tighter">Agenda</span>
                            </div>
                        </div>

                        <a href="/" class="mt-auto px-6 py-3 rounded-xl bg-amber-600/10 hover:bg-amber-600 text-amber-400 hover:text-white border border-amber-500/20 transition-all text-center font-bold">
                            Lihat Website
                        </a>
                    </div>
                </div>

            </div>
        </div>

        {{-- Footer Info --}}
        <div class="mt-20 pt-10 border-t border-white/5 flex flex-col sm:flex-row justify-between items-center gap-6">
            <p class="text-sm text-slate-500">
                &copy; {{ date('Y') }} SID Lemusa. Dikembangkan untuk masyarakat yang lebih maju.
            </p>
            <div class="flex items-center gap-2">
                <span class="inline-block w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">Environment: Stable v1.02</span>
            </div>
        </div>
    </div>
</div>
