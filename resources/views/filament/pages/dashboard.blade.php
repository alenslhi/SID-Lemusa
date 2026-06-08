<x-filament-panels::page>
    {{-- ═══════════════════════════════════════════════════════════
        WELCOME BANNER
    ═══════════════════════════════════════════════════════════ --}}
    <div class="relative overflow-hidden rounded-2xl border border-white/[0.06] mb-8"
         style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.12) 0%, rgba(6, 182, 212, 0.06) 50%, rgba(15, 23, 42, 0.8) 100%);">
        {{-- Decorative Elements --}}
        <div class="absolute top-0 right-0 w-80 h-80 rounded-full opacity-[0.03]"
             style="background: radial-gradient(circle, #10b981, transparent); filter: blur(60px);"></div>
        <div class="absolute -bottom-10 -left-10 w-60 h-60 rounded-full opacity-[0.04]"
             style="background: radial-gradient(circle, #06b6d4, transparent); filter: blur(50px);"></div>

        <div class="relative z-10 p-8 md:p-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            {{-- Left: Welcome Text --}}
            <div class="flex-1">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold mb-4 border"
                     style="background: rgba(16, 185, 129, 0.1); border-color: rgba(16, 185, 129, 0.2); color: #34d399;">
                    <span class="flex h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    {{ $roleName }}
                </div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight mb-2" style="font-family: 'Outfit', sans-serif;">
                    {{ $greeting }}, {{ $user->name }}! 👋
                </h1>
                <p class="text-sm text-slate-400 max-w-lg leading-relaxed">
                    Selamat datang kembali di Sistem Informasi Desa Lemusa. Berikut ringkasan aktivitas dan akses cepat untuk pekerjaan Anda hari ini.
                </p>
            </div>

            {{-- Right: Date & Time --}}
            <div class="text-right shrink-0 hidden md:block">
                <p class="text-2xl font-bold text-white" style="font-family: 'Outfit', sans-serif;">
                    {{ now()->translatedFormat('d F Y') }}
                </p>
                <p class="text-sm text-slate-400 mt-1">
                    {{ now()->translatedFormat('l') }}
                </p>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════
        QUICK STATS MINI CARDS
    ═══════════════════════════════════════════════════════════ --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        {{-- Stat: Total Penduduk --}}
        <div class="group relative overflow-hidden rounded-xl border border-white/[0.06] p-5 transition-all duration-300 hover:border-emerald-500/20 hover:shadow-lg hover:shadow-emerald-500/5"
             style="background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(12px);">
            <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-emerald-500 to-teal-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="flex items-center gap-3 mb-3">
                <div class="p-2 rounded-lg" style="background: rgba(16, 185, 129, 0.1);">
                    <x-heroicon-o-users class="w-5 h-5 text-emerald-400" />
                </div>
                <span class="text-[0.6875rem] font-semibold uppercase tracking-wider text-slate-500">Penduduk</span>
            </div>
            <p class="text-2xl font-extrabold text-white" style="font-family: 'Outfit', sans-serif;">
                {{ number_format($totalPenduduk) }}
            </p>
            <p class="text-xs text-slate-500 mt-1">Penduduk aktif</p>
        </div>

        {{-- Stat: Kartu Keluarga --}}
        <div class="group relative overflow-hidden rounded-xl border border-white/[0.06] p-5 transition-all duration-300 hover:border-sky-500/20 hover:shadow-lg hover:shadow-sky-500/5"
             style="background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(12px);">
            <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-sky-500 to-blue-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="flex items-center gap-3 mb-3">
                <div class="p-2 rounded-lg" style="background: rgba(56, 189, 248, 0.1);">
                    <x-heroicon-o-home class="w-5 h-5 text-sky-400" />
                </div>
                <span class="text-[0.6875rem] font-semibold uppercase tracking-wider text-slate-500">KK</span>
            </div>
            <p class="text-2xl font-extrabold text-white" style="font-family: 'Outfit', sans-serif;">
                {{ number_format($totalKK) }}
            </p>
            <p class="text-xs text-slate-500 mt-1">Total KK terdaftar</p>
        </div>

        {{-- Stat: Surat Diproses --}}
        <div class="group relative overflow-hidden rounded-xl border border-white/[0.06] p-5 transition-all duration-300 hover:border-amber-500/20 hover:shadow-lg hover:shadow-amber-500/5"
             style="background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(12px);">
            <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-amber-500 to-orange-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="flex items-center gap-3 mb-3">
                <div class="p-2 rounded-lg" style="background: rgba(245, 158, 11, 0.1);">
                    <x-heroicon-o-document-text class="w-5 h-5 text-amber-400" />
                </div>
                <span class="text-[0.6875rem] font-semibold uppercase tracking-wider text-slate-500">Surat</span>
            </div>
            <p class="text-2xl font-extrabold text-white" style="font-family: 'Outfit', sans-serif;">
                {{ number_format($suratDiproses) }}
            </p>
            <p class="text-xs text-slate-500 mt-1">Sedang diproses</p>
        </div>

        {{-- Stat: Pengaduan Baru --}}
        <div class="group relative overflow-hidden rounded-xl border border-white/[0.06] p-5 transition-all duration-300 hover:border-rose-500/20 hover:shadow-lg hover:shadow-rose-500/5"
             style="background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(12px);">
            <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-rose-500 to-pink-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="flex items-center gap-3 mb-3">
                <div class="p-2 rounded-lg" style="background: rgba(244, 63, 94, 0.1);">
                    <x-heroicon-o-megaphone class="w-5 h-5 text-rose-400" />
                </div>
                <span class="text-[0.6875rem] font-semibold uppercase tracking-wider text-slate-500">Pengaduan</span>
            </div>
            <p class="text-2xl font-extrabold text-white" style="font-family: 'Outfit', sans-serif;">
                {{ number_format($pengaduanBaru) }}
            </p>
            <p class="text-xs text-slate-500 mt-1">Pengaduan baru</p>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════
        QUICK ACTIONS
    ═══════════════════════════════════════════════════════════ --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-5">
            <div class="p-1.5 rounded-lg" style="background: rgba(16, 185, 129, 0.1);">
                <x-heroicon-o-bolt class="w-4 h-4 text-emerald-400" />
            </div>
            <h2 class="text-lg font-bold text-white" style="font-family: 'Outfit', sans-serif;">Aksi Cepat</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($quickActions as $action)
                <a href="{{ $action['url'] }}"
                   class="group relative overflow-hidden rounded-xl border border-white/[0.06] p-5 transition-all duration-300 hover:border-{{ $action['color'] }}-500/20 hover:-translate-y-1 hover:shadow-lg block"
                   style="background: rgba(15, 23, 42, 0.5); backdrop-filter: blur(12px);">
                    {{-- Hover gradient overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-br {{ $action['gradient'] }} opacity-0 group-hover:opacity-[0.06] transition-opacity duration-300"></div>

                    {{-- Icon --}}
                    <div class="relative z-10">
                        <div class="p-2.5 rounded-xl mb-4 inline-flex transition-transform duration-300 group-hover:scale-110"
                             style="background: linear-gradient(135deg, rgba(255,255,255,0.05), rgba(255,255,255,0.02));">
                            @switch($action['icon'])
                                @case('document-plus')
                                    <x-heroicon-o-document-plus class="w-6 h-6 text-emerald-400" />
                                    @break
                                @case('megaphone')
                                    <x-heroicon-o-megaphone class="w-6 h-6 text-amber-400" />
                                    @break
                                @case('users')
                                    <x-heroicon-o-users class="w-6 h-6 text-sky-400" />
                                    @break
                                @case('document-check')
                                    <x-heroicon-o-document-check class="w-6 h-6 text-violet-400" />
                                    @break
                                @case('home')
                                    <x-heroicon-o-home class="w-6 h-6 text-rose-400" />
                                    @break
                                @case('chat-bubble-left-right')
                                    <x-heroicon-o-chat-bubble-left-right class="w-6 h-6 text-cyan-400" />
                                    @break
                                @case('magnifying-glass')
                                    <x-heroicon-o-magnifying-glass class="w-6 h-6 text-sky-400" />
                                    @break
                                @case('clock')
                                    <x-heroicon-o-clock class="w-6 h-6 text-violet-400" />
                                    @break
                                @default
                                    <x-heroicon-o-square-3-stack-3d class="w-6 h-6 text-slate-400" />
                            @endswitch
                        </div>

                        <h3 class="text-sm font-semibold text-white mb-1 group-hover:text-{{ $action['color'] }}-400 transition-colors">
                            {{ $action['label'] }}
                        </h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            {{ $action['description'] }}
                        </p>

                        {{-- Arrow indicator --}}
                        <div class="mt-3 flex items-center gap-1 text-xs font-medium text-slate-600 group-hover:text-{{ $action['color'] }}-400 transition-all">
                            <span>Buka</span>
                            <svg class="w-3 h-3 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════
        MONITORING SECTION (Kades/Admin Only)
    ═══════════════════════════════════════════════════════════ --}}
    @if($roleName === 'Kepala Desa' || $roleName === 'Super Admin')
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-5">
            <div class="p-1.5 rounded-lg" style="background: rgba(16, 185, 129, 0.1);">
                <x-heroicon-o-presentation-chart-line class="w-4 h-4 text-emerald-400" />
            </div>
            <h2 class="text-lg font-bold text-white" style="font-family: 'Outfit', sans-serif;">Monitoring Pemerintahan</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- Mutasi Tahun Ini --}}
            <div class="bg-slate-900/50 border border-white/[0.06] rounded-xl p-6">
                <p class="text-slate-400 text-sm mb-1">Total Mutasi ({{ date('Y') }})</p>
                <h4 class="text-3xl font-bold text-white">{{ $totalMutasi }}</h4>
                <div class="mt-4 flex items-center text-xs text-slate-500">
                    <x-heroicon-m-arrows-up-down class="w-3 h-3 mr-1" />
                    <span>Termasuk lahir, mati, pindah</span>
                </div>
            </div>

            {{-- Surat Selesai Bulan Ini --}}
            <div class="bg-slate-900/50 border border-white/[0.06] rounded-xl p-6">
                <p class="text-slate-400 text-sm mb-1">Pelayanan Selesai (Bulan Ini)</p>
                <h4 class="text-3xl font-bold text-white">{{ $suratSelesaiBulanIni }}</h4>
                <div class="mt-4 flex items-center text-xs text-emerald-400">
                    <x-heroicon-m-check-badge class="w-3 h-3 mr-1" />
                    <span>Meningkatkan efisiensi pelayanan</span>
                </div>
            </div>

            {{-- Activity Overview --}}
            <div class="bg-slate-900/50 border border-white/[0.06] rounded-xl p-6">
                <p class="text-slate-400 text-sm mb-1">Status Keaktifan Akun</p>
                <h4 class="text-3xl font-bold text-white">{{ \App\Domain\User\Models\User::where('is_active', true)->count() }}</h4>
                <div class="mt-4 flex items-center text-xs text-sky-400">
                    <x-heroicon-m-user-group class="w-3 h-3 mr-1" />
                    <span>Pengguna aktif dalam sistem</span>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ═══════════════════════════════════════════════════════════
        COMPLETION STATS ROW
    ═══════════════════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
        {{-- Surat Completion --}}
        <div class="rounded-xl border border-white/[0.06] p-5"
             style="background: rgba(15, 23, 42, 0.5); backdrop-filter: blur(12px);">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-2">
                    <x-heroicon-o-document-check class="w-4 h-4 text-emerald-400" />
                    <span class="text-sm font-semibold text-slate-300">Surat Selesai</span>
                </div>
                <span class="text-2xl font-extrabold text-emerald-400" style="font-family: 'Outfit', sans-serif;">{{ $suratSelesai }}</span>
            </div>
            @php
                $suratTotal = $suratDiproses + $suratSelesai;
                $suratPercent = $suratTotal > 0 ? round(($suratSelesai / $suratTotal) * 100) : 0;
            @endphp
            <div class="w-full rounded-full h-2 overflow-hidden" style="background: rgba(255,255,255,0.05);">
                <div class="h-full rounded-full transition-all duration-700 ease-out"
                     style="width: {{ $suratPercent }}%; background: linear-gradient(90deg, #10b981, #06b6d4);"></div>
            </div>
            <p class="text-xs text-slate-500 mt-2">{{ $suratPercent }}% dari total {{ $suratTotal }} surat</p>
        </div>

        {{-- Pengaduan Completion --}}
        <div class="rounded-xl border border-white/[0.06] p-5"
             style="background: rgba(15, 23, 42, 0.5); backdrop-filter: blur(12px);">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-2">
                    <x-heroicon-o-check-circle class="w-4 h-4 text-sky-400" />
                    <span class="text-sm font-semibold text-slate-300">Pengaduan Selesai</span>
                </div>
                <span class="text-2xl font-extrabold text-sky-400" style="font-family: 'Outfit', sans-serif;">{{ $pengaduanSelesai }}</span>
            </div>
            @php
                $pengaduanTotal = $pengaduanBaru + $pengaduanSelesai;
                $pengaduanPercent = $pengaduanTotal > 0 ? round(($pengaduanSelesai / $pengaduanTotal) * 100) : 0;
            @endphp
            <div class="w-full rounded-full h-2 overflow-hidden" style="background: rgba(255,255,255,0.05);">
                <div class="h-full rounded-full transition-all duration-700 ease-out"
                     style="width: {{ $pengaduanPercent }}%; background: linear-gradient(90deg, #38bdf8, #818cf8);"></div>
            </div>
            <p class="text-xs text-slate-500 mt-2">{{ $pengaduanPercent }}% dari total {{ $pengaduanTotal }} pengaduan</p>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════
        CHART WIDGETS (rendered by Filament footer widgets)
    ═══════════════════════════════════════════════════════════ --}}
    <div class="mb-4">
        <div class="flex items-center gap-3 mb-1">
            <div class="p-1.5 rounded-lg" style="background: rgba(56, 189, 248, 0.1);">
                <x-heroicon-o-chart-bar class="w-4 h-4 text-sky-400" />
            </div>
            <h2 class="text-lg font-bold text-white" style="font-family: 'Outfit', sans-serif;">Statistik Kependudukan</h2>
        </div>
    </div>
</x-filament-panels::page>
