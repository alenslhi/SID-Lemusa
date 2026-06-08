<div class="min-h-screen bg-slate-950 text-slate-100 flex flex-col md:flex-row relative">
    {{-- CSS styling local to citizen dashboard --}}
    <style>
        .premium-font-heading {
            font-family: 'Outfit', sans-serif;
        }
        .premium-card {
            background: rgba(30, 41, 59, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            border-radius: 1rem;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .premium-card:hover {
            border-color: rgba(16, 185, 129, 0.2);
            box-shadow: 0 10px 30px -10px rgba(16, 185, 129, 0.1);
            transform: translateY(-2px);
        }
        .glass-input {
            background: rgba(15, 23, 42, 0.6) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #f8fafc !important;
        }
        .glass-input:focus {
            border-color: #10b981 !important;
            box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2) !important;
        }
    </style>

    {{-- SIDEBAR NAVIGATION --}}
    <aside class="w-full md:w-80 bg-slate-900 border-r border-slate-800 flex flex-col justify-between shrink-0">
        <div>
            <!-- Header Brand -->
            <div class="p-6 border-b border-slate-800 flex items-center gap-3">
                <img src="{{ asset('assets/images/logos/logo-parimo.png') }}" alt="Logo Parimo" class="h-10 w-auto">
                <div>
                    <span class="block premium-font-heading font-bold text-base text-white tracking-wide">Portal Warga</span>
                    <span class="block text-xs text-emerald-400 font-semibold mt-0.5">Desa Lemusa</span>
                </div>
            </div>

            <!-- Profile Info Widget -->
            <div class="p-6 border-b border-slate-800 bg-slate-950/20">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 rounded-full bg-emerald-600/20 border border-emerald-500/30 flex items-center justify-center text-emerald-400 font-bold text-lg">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <div class="overflow-hidden">
                        <h4 class="font-bold text-white text-sm truncate">{{ $user->name }}</h4>
                        <span class="inline-block px-2 py-0.5 rounded-full bg-emerald-500/10 text-emerald-400 text-[10px] font-semibold mt-1">
                            NIK: {{ $penduduk->nik ?? 'Belum tertaut' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Menu Navigation -->
            <nav class="p-4 space-y-1.5">
                <button 
                    wire:click="setTab('overview')"
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all {{ $activeTab === 'overview' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}"
                >
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path>
                    </svg>
                    Ringkasan Dashboard
                </button>

                <button 
                    wire:click="setTab('profile')"
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all {{ $activeTab === 'profile' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}"
                >
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profil Saya
                </button>

                <button 
                    wire:click="setTab('surat')"
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all {{ $activeTab === 'surat' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}"
                >
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Pengajuan Surat
                </button>

                <button 
                    wire:click="setTab('pengaduan')"
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all {{ $activeTab === 'pengaduan' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}"
                >
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                    Pengaduan Warga
                </button>
            </nav>
        </div>

        <!-- Logout Area -->
        <div class="p-4 border-t border-slate-800">
            <button 
                wire:click="logout"
                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-rose-400 hover:bg-rose-500/10 transition-colors"
            >
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                Keluar Portal
            </button>
        </div>
    </aside>

    {{-- MAIN CONTENT AREA --}}
    <main class="flex-grow p-6 sm:p-10 md:p-12 overflow-y-auto max-h-screen">
        
        {{-- Flash Session Alerts --}}
        @if (session()->has('error'))
            <div class="mb-6 rounded-xl bg-rose-500/10 border border-rose-500/20 px-5 py-4 flex items-start gap-3 text-rose-400 text-sm">
                <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.072 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if (session()->has('success_surat') || session()->has('success_pengaduan'))
            <div class="mb-6 rounded-xl bg-emerald-500/10 border border-emerald-500/20 px-5 py-4 flex items-start gap-3 text-emerald-400 text-sm animate-pulse">
                <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('success_surat') ?: session('success_pengaduan') }}</span>
            </div>
        @endif

        {{-- TAB VIEW CONTENT --}}
        @if ($activeTab === 'overview')
            
            {{-- Welcome Banner --}}
            <div class="relative bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 overflow-hidden mb-8 shadow-xl">
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-600/10 via-teal-600/5 to-transparent"></div>
                <div class="relative z-10">
                    <span class="inline-block px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-400 text-xs font-semibold mb-4 border border-emerald-500/20">
                        {{ now()->translatedFormat('l, d F Y') }}
                    </span>
                    <h1 class="premium-font-heading text-2xl sm:text-3xl font-extrabold text-white leading-tight">
                        Selamat Datang Kembali, <br class="sm:hidden" />
                        <span class="text-emerald-400">{{ $user->name }}</span>!
                    </h1>
                    <p class="text-slate-400 text-sm mt-2 max-w-xl">
                        Selamat datang di portal pelayanan mandiri warga Desa Lemusa. Di sini Anda dapat melakukan pengajuan surat dan pelaporan pengaduan secara mandiri.
                    </p>
                </div>
            </div>

            {{-- Stats Summary Grid --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="premium-card p-6">
                    <span class="text-xs text-slate-400 font-semibold block mb-2 uppercase tracking-wide">Surat Diajukan</span>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-extrabold text-white">{{ $stats['total_surat'] }}</span>
                        <span class="text-xs text-slate-500">total</span>
                    </div>
                </div>
                <div class="premium-card p-6">
                    <span class="text-xs text-slate-400 font-semibold block mb-2 uppercase tracking-wide">Surat Diproses</span>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-extrabold text-sky-400">{{ $stats['surat_proses'] }}</span>
                        <span class="text-xs text-slate-500">aktif</span>
                    </div>
                </div>
                <div class="premium-card p-6">
                    <span class="text-xs text-slate-400 font-semibold block mb-2 uppercase tracking-wide">Laporan Pengaduan</span>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-extrabold text-amber-400">{{ $stats['total_pengaduan'] }}</span>
                        <span class="text-xs text-slate-500">total</span>
                    </div>
                </div>
                <div class="premium-card p-6">
                    <span class="text-xs text-slate-400 font-semibold block mb-2 uppercase tracking-wide">Pengaduan Selesai</span>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-extrabold text-emerald-400">{{ $stats['pengaduan_selesai'] }}</span>
                        <span class="text-xs text-slate-500">selesai</span>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <h3 class="premium-font-heading text-lg font-bold text-white mb-4">Layanan Cepat Mandiri</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                <!-- Action 1 -->
                <div class="premium-card p-6 flex items-start gap-5 cursor-pointer" wire:click="openSuratModal">
                    <div class="p-3.5 bg-emerald-600/10 border border-emerald-500/20 text-emerald-400 rounded-xl">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-white text-base">Ajukan Surat Keterangan</h4>
                        <p class="text-xs text-slate-400 mt-1">Buat permohonan surat domisili, SKU, keterangan tidak mampu, dll.</p>
                        <span class="inline-flex items-center gap-1 text-xs text-emerald-400 font-semibold mt-3">
                            Mulai Pengajuan
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                        </span>
                    </div>
                </div>
                <!-- Action 2 -->
                <div class="premium-card p-6 flex items-start gap-5 cursor-pointer" wire:click="openPengaduanModal">
                    <div class="p-3.5 bg-amber-600/10 border border-amber-500/20 text-amber-400 rounded-xl">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-white text-base">Lapor Pengaduan Warga</h4>
                        <p class="text-xs text-slate-400 mt-1">Sampaikan keluhan terkait infrastruktur, kebersihan, atau pelayanan desa.</p>
                        <span class="inline-flex items-center gap-1 text-xs text-amber-400 font-semibold mt-3">
                            Buat Laporan
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                        </span>
                    </div>
                </div>
            </div>

            {{-- Recent Activity / Status Lacak --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Surat -->
                <div class="premium-card p-6">
                    <div class="flex justify-between items-center mb-5">
                        <h4 class="premium-font-heading font-bold text-white text-base">Status Surat Terakhir</h4>
                        <button wire:click="setTab('surat')" class="text-xs text-emerald-400 font-bold hover:underline">Lihat Semua</button>
                    </div>
                    <div class="space-y-4">
                        @forelse ($suratList->take(3) as $s)
                            <div class="p-4 rounded-xl bg-slate-900/40 border border-slate-800 flex justify-between items-center gap-4">
                                <div class="overflow-hidden">
                                    <span class="text-[10px] font-bold text-slate-500 block uppercase">{{ $s->kode_pengajuan }}</span>
                                    <span class="font-bold text-white text-sm block mt-0.5 truncate">{{ $s->jenisSurat?->nama }}</span>
                                    <span class="text-xs text-slate-400 mt-1 block">Diajukan: {{ $s->created_at->translatedFormat('d M Y') }}</span>
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs font-bold shrink-0
                                    {{ $s->statusSurat?->nama === 'Selesai' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : '' }}
                                    {{ $s->statusSurat?->nama === 'Ditolak' ? 'bg-rose-500/10 text-rose-400 border border-rose-500/20' : '' }}
                                    {{ !in_array($s->statusSurat?->nama, ['Selesai', 'Ditolak']) ? 'bg-sky-500/10 text-sky-400 border border-sky-500/20' : '' }}
                                ">
                                    {{ $s->statusSurat?->nama }}
                                </span>
                            </div>
                        @empty
                            <p class="text-xs text-slate-500 py-6 text-center">Belum ada pengajuan surat.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Pengaduan -->
                <div class="premium-card p-6">
                    <div class="flex justify-between items-center mb-5">
                        <h4 class="premium-font-heading font-bold text-white text-base">Aduan Warga Terakhir</h4>
                        <button wire:click="setTab('pengaduan')" class="text-xs text-amber-400 font-bold hover:underline">Lihat Semua</button>
                    </div>
                    <div class="space-y-4">
                        @forelse ($pengaduanList->take(3) as $p)
                            <div class="p-4 rounded-xl bg-slate-900/40 border border-slate-800 flex justify-between items-center gap-4">
                                <div class="overflow-hidden">
                                    <span class="text-[10px] font-bold text-slate-500 block uppercase">KATEGORI: {{ $p->kategoriPengaduan?->nama }}</span>
                                    <span class="font-bold text-white text-sm block mt-0.5 truncate">{{ $p->judul }}</span>
                                    <span class="text-xs text-slate-400 mt-1 block">Laporan: {{ $p->created_at->translatedFormat('d M Y') }}</span>
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs font-bold shrink-0 uppercase
                                    {{ $p->status === 'selesai' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : '' }}
                                    {{ $p->status === 'diproses' || $p->status === 'proses' ? 'bg-sky-500/10 text-sky-400 border border-sky-500/20' : '' }}
                                    {{ $p->status === 'baru' ? 'bg-amber-500/10 text-amber-400 border border-amber-500/20' : '' }}
                                ">
                                    {{ $p->status }}
                                </span>
                            </div>
                        @empty
                            <p class="text-xs text-slate-500 py-6 text-center">Belum ada pengaduan laporan.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        @elseif ($activeTab === 'profile')
            
            {{-- PROFILE SECTION --}}
            <h2 class="premium-font-heading text-2xl font-extrabold text-white mb-6">Profil Saya</h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- User Account Info -->
                <div class="premium-card p-6 flex flex-col items-center text-center">
                    <div class="h-20 w-20 rounded-full bg-emerald-600/10 border-2 border-emerald-500/30 flex items-center justify-center text-emerald-400 font-bold text-3xl mb-4">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <h3 class="font-bold text-white text-lg">{{ $user->name }}</h3>
                    <p class="text-xs text-slate-400 mt-1">{{ $user->email }}</p>
                    <span class="mt-4 px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-400 text-xs font-semibold border border-emerald-500/20">
                        Hak Akses: Warga Desa
                    </span>

                    <div class="w-full border-t border-slate-800 mt-6 pt-6 text-left space-y-3">
                        <div>
                            <span class="text-[10px] text-slate-500 font-bold uppercase block">Status Akun</span>
                            <span class="text-sm font-semibold text-emerald-400">Aktif</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-slate-500 font-bold uppercase block">Terdaftar Sejak</span>
                            <span class="text-sm font-semibold text-slate-300">{{ $user->created_at->translatedFormat('d F Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Personal Data Penduduk -->
                <div class="premium-card p-6 lg:col-span-2">
                    <h4 class="premium-font-heading font-bold text-white text-base border-b border-slate-800 pb-3 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-5l-2-2z"></path></svg>
                        Biodata Kependudukan Resmi
                    </h4>

                    @if ($penduduk)
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4">
                            <div>
                                <span class="text-[10px] text-slate-500 font-bold uppercase block">NIK (Nomor Induk Kependudukan)</span>
                                <span class="text-sm font-semibold text-white">{{ $penduduk->nik }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 font-bold uppercase block">Nama Lengkap</span>
                                <span class="text-sm font-semibold text-white">{{ $penduduk->nama_lengkap }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 font-bold uppercase block">Tempat & Tanggal Lahir</span>
                                <span class="text-sm font-semibold text-white">{{ $penduduk->tempat_lahir }}, {{ $penduduk->tanggal_lahir?->translatedFormat('d F Y') }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 font-bold uppercase block">Jenis Kelamin</span>
                                <span class="text-sm font-semibold text-white">{{ $penduduk->jenis_kelamin?->getLabel() ?? ($penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan') }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 font-bold uppercase block">Agama</span>
                                <span class="text-sm font-semibold text-white">{{ $penduduk->agama?->nama ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 font-bold uppercase block">Pendidikan Terakhir</span>
                                <span class="text-sm font-semibold text-white">{{ $penduduk->pendidikan?->nama ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 font-bold uppercase block">Pekerjaan</span>
                                <span class="text-sm font-semibold text-white">{{ $penduduk->pekerjaan?->nama ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 font-bold uppercase block">Status Perkawinan</span>
                                <span class="text-sm font-semibold text-white">{{ $penduduk->statusPerkawinan?->nama ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 font-bold uppercase block">Nomor Telepon/HP</span>
                                <span class="text-sm font-semibold text-white">{{ $penduduk->no_hp ?? '-' }}</span>
                            </div>
                        </div>

                        <!-- Hubungan Keluarga -->
                        <h4 class="premium-font-heading font-bold text-white text-base border-b border-slate-800 pb-3 mb-4 mt-8 flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            Informasi Keluarga (KK)
                        </h4>
                        @if ($penduduk->keluarga)
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4">
                                <div>
                                    <span class="text-[10px] text-slate-500 font-bold uppercase block">Nomor KK (Kartu Keluarga)</span>
                                    <span class="text-sm font-semibold text-white">{{ $penduduk->keluarga->nomor_kk }}</span>
                                </div>
                                <div>
                                    <span class="text-[10px] text-slate-500 font-bold uppercase block">Alamat Rumah</span>
                                    <span class="text-sm font-semibold text-white">{{ $penduduk->keluarga->alamat }}</span>
                                </div>
                                <div>
                                    <span class="text-[10px] text-slate-500 font-bold uppercase block">RT / RW</span>
                                    <span class="text-sm font-semibold text-white">RT {{ $penduduk->keluarga->rt }} / RW {{ $penduduk->keluarga->rw }}</span>
                                </div>
                                <div>
                                    <span class="text-[10px] text-slate-500 font-bold uppercase block">Dusun</span>
                                    <span class="text-sm font-semibold text-white">{{ $penduduk->keluarga->dusun?->nama }}</span>
                                </div>
                            </div>
                        @else
                            <p class="text-xs text-slate-500 py-2">Data keluarga Anda belum dimasukkan dalam database desa.</p>
                        @endif
                    @else
                        <div class="py-12 text-center text-slate-500">
                            <p class="text-sm">Akun pengguna Anda belum ditautkan dengan data kependudukan resmi desa Lemusa.</p>
                            <p class="text-xs mt-1">Harap hubungi perangkat desa atau operator SID untuk menautkan akun menggunakan NIK Anda.</p>
                        </div>
                    @endif
                </div>
            </div>

        @elseif ($activeTab === 'surat')
            
            {{-- PERSURATAN TAB --}}
            <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6">
                <div>
                    <h2 class="premium-font-heading text-2xl font-extrabold text-white">Layanan Persuratan Mandiri</h2>
                    <p class="text-xs text-slate-400 mt-1">Lacak permohonan surat keterangan Anda atau ajukan surat baru secara mandiri.</p>
                </div>
                <button 
                    wire:click="openSuratModal"
                    class="px-5 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-sm shadow-lg shadow-emerald-600/20 transition-all active:scale-[0.98] shrink-0"
                >
                    Ajukan Surat Baru
                </button>
            </div>

            <!-- List Surat -->
            <div class="premium-card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm border-collapse">
                        <thead>
                            <tr class="bg-slate-900/60 border-b border-slate-800 text-slate-400 font-bold text-xs uppercase">
                                <th class="p-5">Kode Pengajuan</th>
                                <th class="p-5">Jenis Surat</th>
                                <th class="p-5">Tanggal Diajukan</th>
                                <th class="p-5">Estimasi Selesai</th>
                                <th class="p-5">Status</th>
                                <th class="p-5">Catatan Admin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60">
                            @forelse ($suratList as $s)
                                <tr class="hover:bg-slate-900/10 transition-colors">
                                    <td class="p-5 font-mono text-xs text-emerald-400 font-bold uppercase">{{ $s->kode_pengajuan }}</td>
                                    <td class="p-5 font-bold text-white">{{ $s->jenisSurat?->nama }}</td>
                                    <td class="p-5 text-slate-300 text-xs">{{ $s->created_at->translatedFormat('d F Y H:i') }}</td>
                                    <td class="p-5 text-slate-300 text-xs">{{ $s->estimasi_selesai ? $s->estimasi_selesai->translatedFormat('d F Y') : '-' }}</td>
                                    <td class="p-5">
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold
                                            {{ $s->statusSurat?->nama === 'Selesai' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : '' }}
                                            {{ $s->statusSurat?->nama === 'Ditolak' ? 'bg-rose-500/10 text-rose-400 border border-rose-500/20' : '' }}
                                            {{ !in_array($s->statusSurat?->nama, ['Selesai', 'Ditolak']) ? 'bg-sky-500/10 text-sky-400 border border-sky-500/20' : '' }}
                                        ">
                                            {{ $s->statusSurat?->nama }}
                                        </span>
                                    </td>
                                    <td class="p-5 text-xs text-slate-400 italic max-w-xs truncate">{{ $s->catatan_admin ?: 'Tidak ada catatan' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-10 text-center text-slate-500">
                                        <svg class="mx-auto h-10 w-10 text-slate-600 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <p class="text-sm">Belum ada riwayat pengajuan surat.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        @elseif ($activeTab === 'pengaduan')
            
            {{-- PENGADUAN TAB --}}
            <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6">
                <div>
                    <h2 class="premium-font-heading text-2xl font-extrabold text-white">Layanan Pengaduan & Aspirasi</h2>
                    <p class="text-xs text-slate-400 mt-1">Sampaikan laporan aduan terkait infrastruktur, kebersihan, atau keluhan masyarakat.</p>
                </div>
                <button 
                    wire:click="openPengaduanModal"
                    class="px-5 py-3 rounded-xl bg-amber-600 hover:bg-amber-500 text-white font-semibold text-sm shadow-lg shadow-amber-600/20 transition-all active:scale-[0.98] shrink-0"
                >
                    Buat Laporan Baru
                </button>
            </div>

            <!-- List Pengaduan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse ($pengaduanList as $p)
                    <div class="premium-card p-6 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start gap-4">
                                <span class="px-2 py-0.5 rounded bg-slate-800 text-emerald-400 font-semibold text-[10px] uppercase">
                                    {{ $p->kategoriPengaduan?->nama }}
                                </span>
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase border
                                    {{ $p->status === 'selesai' ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20' : '' }}
                                    {{ $p->status === 'diproses' || $p->status === 'proses' ? 'bg-sky-500/10 text-sky-400 border-sky-500/20' : '' }}
                                    {{ $p->status === 'baru' ? 'bg-amber-500/10 text-amber-400 border-amber-500/20' : '' }}
                                ">
                                    {{ $p->status }}
                                </span>
                            </div>
                            
                            <h4 class="font-bold text-white text-base mt-3 leading-snug">{{ $p->judul }}</h4>
                            <p class="text-xs text-slate-400 mt-1">Dikirim: {{ $p->created_at->translatedFormat('d F Y H:i') }}</p>
                            
                            <div class="p-4 rounded-xl bg-slate-950/40 border border-slate-800/60 mt-4">
                                <p class="text-xs text-slate-300 leading-relaxed whitespace-pre-wrap">{{ $p->isi_laporan }}</p>
                            </div>
                        </div>

                        <!-- Tanggapan Admin -->
                        @if ($p->tanggapan)
                            <div class="mt-4 p-4 rounded-xl bg-emerald-950/20 border border-emerald-800/30">
                                <span class="text-[10px] text-emerald-400 font-bold uppercase block">Tanggapan Perangkat Desa</span>
                                <p class="text-xs text-slate-300 leading-relaxed mt-1 whitespace-pre-wrap">{{ $p->tanggapan }}</p>
                            </div>
                        @else
                            <div class="mt-4 text-xs text-slate-500 italic block">
                                Belum ada tanggapan resmi dari perangkat desa.
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="col-span-2 premium-card p-10 text-center text-slate-500">
                        <svg class="mx-auto h-10 w-10 text-slate-600 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <p class="text-sm">Belum ada riwayat laporan pengaduan.</p>
                    </div>
                @endforelse
            </div>

        @endif
    </main>

    {{-- MODAL MODUL: AJUKAN SURAT --}}
    @if ($showSuratModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <!-- Backdrop -->
            <div class="absolute inset-0 bg-slate-950/80 backdrop-blur-sm" wire:click="$set('showSuratModal', false)"></div>
            
            <!-- Modal Body -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl w-full max-w-md p-6 sm:p-8 relative z-10 shadow-2xl animate-in fade-in zoom-in-95 duration-200">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h3 class="premium-font-heading text-lg font-bold text-white">Ajukan Surat Keterangan</h3>
                        <p class="text-xs text-slate-400 mt-1">Pilih jenis surat keterangan desa yang ingin diajukan.</p>
                    </div>
                    <button 
                        wire:click="$set('showSuratModal', false)"
                        class="p-1 rounded-lg hover:bg-slate-800 text-slate-400 hover:text-slate-200"
                    >
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <form wire:submit.prevent="submitSurat" class="space-y-6">
                    <div>
                        <label for="jenis_surat_id" class="block text-xs font-semibold text-slate-300 uppercase tracking-wide mb-2">Jenis Surat Keterangan</label>
                        <select 
                            id="jenis_surat_id"
                            wire:model="jenis_surat_id" 
                            class="w-full px-4 py-3 rounded-xl glass-input text-sm focus:outline-none"
                        >
                            <option value="" class="bg-slate-900">-- Pilih Jenis Surat --</option>
                            @foreach ($jenisSurat as $js)
                                <option value="{{ $js->id }}" class="bg-slate-900">{{ $js->nama }}</option>
                            @endforeach
                        </select>
                        @error('jenis_surat_id') 
                            <span class="text-xs text-rose-400 mt-1 block font-semibold">{{ $message }}</span> 
                        @enderror
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-800">
                        <button 
                            type="button"
                            wire:click="$set('showSuratModal', false)"
                            class="px-4 py-2.5 rounded-xl border border-slate-800 hover:bg-slate-800 text-slate-300 text-xs font-semibold"
                        >
                            Batal
                        </button>
                        <button 
                            type="submit"
                            class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-semibold shadow-lg shadow-emerald-600/20"
                        >
                            Ajukan Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- MODAL MODUL: BUAT PENGADUAN --}}
    @if ($showPengaduanModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <!-- Backdrop -->
            <div class="absolute inset-0 bg-slate-950/80 backdrop-blur-sm" wire:click="$set('showPengaduanModal', false)"></div>
            
            <!-- Modal Body -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl w-full max-w-lg p-6 sm:p-8 relative z-10 shadow-2xl animate-in fade-in zoom-in-95 duration-200">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h3 class="premium-font-heading text-lg font-bold text-white">Buat Laporan Pengaduan Baru</h3>
                        <p class="text-xs text-slate-400 mt-1">Sampaikan laporan aduan desa dengan rinci agar mudah diproses.</p>
                    </div>
                    <button 
                        wire:click="$set('showPengaduanModal', false)"
                        class="p-1 rounded-lg hover:bg-slate-800 text-slate-400 hover:text-slate-200"
                    >
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <form wire:submit.prevent="submitPengaduan" class="space-y-5">
                    <div>
                        <label for="judul" class="block text-xs font-semibold text-slate-300 uppercase tracking-wide mb-2">Judul Laporan/Aduan</label>
                        <input 
                            type="text" 
                            id="judul"
                            wire:model="judul" 
                            placeholder="Contoh: Lampu Penerangan Jalan Dusun II Padam"
                            class="w-full px-4 py-3 rounded-xl glass-input text-sm focus:outline-none"
                        >
                        @error('judul') 
                            <span class="text-xs text-rose-400 mt-1 block font-semibold">{{ $message }}</span> 
                        @enderror
                    </div>

                    <div>
                        <label for="kategori_pengaduan_id" class="block text-xs font-semibold text-slate-300 uppercase tracking-wide mb-2">Kategori Pengaduan</label>
                        <select 
                            id="kategori_pengaduan_id"
                            wire:model="kategori_pengaduan_id" 
                            class="w-full px-4 py-3 rounded-xl glass-input text-sm focus:outline-none"
                        >
                            <option value="" class="bg-slate-900">-- Pilih Kategori --</option>
                            @foreach ($kategoriPengaduan as $kp)
                                <option value="{{ $kp->id }}" class="bg-slate-900">{{ $kp->nama }}</option>
                            @endforeach
                        </select>
                        @error('kategori_pengaduan_id') 
                            <span class="text-xs text-rose-400 mt-1 block font-semibold">{{ $message }}</span> 
                        @enderror
                    </div>

                    <div>
                        <label for="isi_laporan" class="block text-xs font-semibold text-slate-300 uppercase tracking-wide mb-2">Rincian Laporan (Isi Aduan)</label>
                        <textarea 
                            id="isi_laporan"
                            wire:model="isi_laporan" 
                            rows="5"
                            placeholder="Jelaskan secara rinci tentang keluhan Anda (lokasi, kronologi, dll.) agar memudahkan proses investigasi dan perbaikan."
                            class="w-full px-4 py-3 rounded-xl glass-input text-sm focus:outline-none resize-none"
                        ></textarea>
                        @error('isi_laporan') 
                            <span class="text-xs text-rose-400 mt-1 block font-semibold">{{ $message }}</span> 
                        @enderror
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-800">
                        <button 
                            type="button"
                            wire:click="$set('showPengaduanModal', false)"
                            class="px-4 py-2.5 rounded-xl border border-slate-800 hover:bg-slate-800 text-slate-300 text-xs font-semibold"
                        >
                            Batal
                        </button>
                        <button 
                            type="submit"
                            class="px-5 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-500 text-white text-xs font-semibold shadow-lg shadow-amber-600/20"
                        >
                            Kirim Pengaduan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
