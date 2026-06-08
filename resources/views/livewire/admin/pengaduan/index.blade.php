@section('header', 'Pengaduan Warga')

<div>
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Laporan & Pengaduan</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Tinjau dan proses aspirasi atau pengaduan warga.</p>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
        
        <!-- Toolbar -->
        <div class="p-4 border-b border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row justify-between gap-4">
            <div class="relative max-w-sm w-full">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <x-heroicon-o-magnifying-glass class="w-5 h-5 text-slate-400" />
                </div>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari Judul atau Pelapor..." class="block w-full pl-10 pr-3 py-2 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white placeholder-slate-400">
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-800 text-slate-500 dark:text-slate-400 font-semibold">
                        <th class="px-6 py-4">Laporan / Pelapor</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Tanggal Masuk</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                    @forelse($pengaduan as $p)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-900 dark:text-white truncate max-w-xs">{{ $p->judul }}</div>
                                <div class="text-xs text-slate-500 mt-1 flex items-center gap-1">
                                    <x-heroicon-o-user class="w-3.5 h-3.5" />
                                    {{ $p->penduduk?->nama_lengkap ?? 'Anonim/Dihapus' }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 rounded-lg text-xs font-semibold">
                                    {{ $p->kategoriPengaduan?->nama }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-500 text-xs">
                                {{ $p->created_at->translatedFormat('d F Y') }} <br>
                                {{ $p->created_at->translatedFormat('H:i') }} WIB
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex px-2 py-1 text-[10px] font-bold uppercase rounded-md 
                                    {{ $p->status === 'baru' ? 'bg-amber-100 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400' : '' }}
                                    {{ $p->status === 'selesai' ? 'bg-emerald-100 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400' : '' }}
                                    {{ in_array($p->status, ['diproses', 'proses']) ? 'bg-sky-100 text-sky-600 dark:bg-sky-500/10 dark:text-sky-400' : '' }}">
                                    {{ $p->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('desa.pengaduan.edit', $p->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-emerald-500 hover:bg-emerald-50 dark:hover:bg-emerald-500/10 transition-colors" title="Beri Tanggapan">
                                    <x-heroicon-o-chat-bubble-left-ellipsis class="w-5 h-5" />
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                <div class="flex flex-col items-center justify-center">
                                    <x-heroicon-o-megaphone class="w-10 h-10 text-slate-300 dark:text-slate-700 mb-3" />
                                    <p>Belum ada pengaduan dari warga.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="p-4 border-t border-slate-200 dark:border-slate-800">
            {{ $pengaduan->links() }}
        </div>
    </div>
</div>
