@section('header', 'Overview Dashboard')

<div>
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <!-- Penduduk Stat -->
        <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 shadow-sm relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 bg-blue-500/10 w-24 h-24 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-sm font-semibold text-slate-500 dark:text-slate-400 mb-1">Total Penduduk</p>
                    <h3 class="text-3xl font-black text-slate-800 dark:text-slate-100">{{ number_format($stats['total_penduduk']) }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-500">
                    <x-heroicon-o-users class="w-6 h-6" />
                </div>
            </div>
        </div>

        <!-- Surat Stat -->
        <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 shadow-sm relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 bg-emerald-500/10 w-24 h-24 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-sm font-semibold text-slate-500 dark:text-slate-400 mb-1">Surat Menunggu</p>
                    <h3 class="text-3xl font-black text-slate-800 dark:text-slate-100">{{ number_format($stats['surat_pending']) }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-500/10 flex items-center justify-center text-emerald-500">
                    <x-heroicon-o-document-text class="w-6 h-6" />
                </div>
            </div>
        </div>

        <!-- Pengaduan Stat -->
        <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 shadow-sm relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 bg-amber-500/10 w-24 h-24 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-sm font-semibold text-slate-500 dark:text-slate-400 mb-1">Aduan Baru</p>
                    <h3 class="text-3xl font-black text-slate-800 dark:text-slate-100">{{ number_format($stats['pengaduan_baru']) }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-500/10 flex items-center justify-center text-amber-500">
                    <x-heroicon-o-chat-bubble-bottom-center-text class="w-6 h-6" />
                </div>
            </div>
        </div>

    </div>

    <!-- Recent Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Latest Surat -->
        <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Pengajuan Surat Terbaru</h3>
                <a href="{{ route('desa.surat.index') }}" class="text-sm font-semibold text-emerald-500 hover:text-emerald-600">Lihat Semua &rarr;</a>
            </div>
            
            <div class="space-y-4">
                @forelse($latestSurat as $surat)
                    <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-900 transition-colors">
                        <div class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 flex-shrink-0">
                            <x-heroicon-o-document class="w-5 h-5" />
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-slate-800 dark:text-slate-200 truncate">{{ $surat->jenisSurat->nama }}</p>
                            <p class="text-xs text-slate-500 truncate">{{ $surat->penduduk->nama_lengkap }}</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-2 py-1 text-[10px] font-bold uppercase rounded-md 
                                {{ $surat->status_surat_id == 1 ? 'bg-amber-100 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400' : 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400' }}">
                                {{ $surat->statusSurat->nama }}
                            </span>
                            <p class="text-[10px] text-slate-400 mt-1">{{ $surat->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6 text-slate-500 text-sm">Belum ada pengajuan surat.</div>
                @endforelse
            </div>
        </div>

        <!-- Latest Pengaduan -->
        <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Aduan Warga Terbaru</h3>
                <a href="{{ route('desa.pengaduan.index') }}" class="text-sm font-semibold text-emerald-500 hover:text-emerald-600">Lihat Semua &rarr;</a>
            </div>
            
            <div class="space-y-4">
                @forelse($latestPengaduan as $aduan)
                    <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-900 transition-colors">
                        <div class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 flex-shrink-0">
                            <x-heroicon-o-megaphone class="w-5 h-5" />
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-slate-800 dark:text-slate-200 truncate">{{ $aduan->judul }}</p>
                            <p class="text-xs text-slate-500 truncate">{{ $aduan->penduduk->nama_lengkap }}</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-2 py-1 text-[10px] font-bold uppercase rounded-md 
                                {{ $aduan->status == 'baru' ? 'bg-amber-100 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400' : 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400' }}">
                                {{ $aduan->status }}
                            </span>
                            <p class="text-[10px] text-slate-400 mt-1">{{ $aduan->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6 text-slate-500 text-sm">Belum ada aduan warga.</div>
                @endforelse
            </div>
        </div>

    </div>
</div>
