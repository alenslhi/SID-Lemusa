@section('header', 'Pengajuan Surat')

<div>
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Layanan Persuratan</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Kelola permohonan surat keterangan dari warga.</p>
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
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari Kode atau Pemohon..." class="block w-full pl-10 pr-3 py-2 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white placeholder-slate-400">
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-800 text-slate-500 dark:text-slate-400 font-semibold">
                        <th class="px-6 py-4">Kode / Tanggal</th>
                        <th class="px-6 py-4">Jenis Surat</th>
                        <th class="px-6 py-4">Pemohon</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                    @forelse($surat as $s)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-mono font-bold text-slate-900 dark:text-emerald-400 uppercase">{{ $s->kode_pengajuan }}</div>
                                <div class="text-xs text-slate-500 mt-1">{{ $s->created_at->translatedFormat('d M Y H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-900 dark:text-white">
                                {{ $s->jenisSurat?->nama }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-900 dark:text-white">{{ $s->penduduk?->nama_lengkap }}</div>
                                <div class="text-xs text-slate-500 font-mono">{{ $s->penduduk?->nik }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex px-2 py-1 text-[10px] font-bold uppercase rounded-md 
                                    {{ $s->status_surat_id == 1 ? 'bg-amber-100 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400' : '' }}
                                    {{ $s->statusSurat?->nama === 'Selesai' ? 'bg-emerald-100 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400' : '' }}
                                    {{ $s->statusSurat?->nama === 'Ditolak' ? 'bg-rose-100 text-rose-600 dark:bg-rose-500/10 dark:text-rose-400' : '' }}
                                    {{ !in_array($s->status_surat_id, [1]) && !in_array($s->statusSurat?->nama, ['Selesai', 'Ditolak']) ? 'bg-sky-100 text-sky-600 dark:bg-sky-500/10 dark:text-sky-400' : '' }}">
                                    {{ $s->statusSurat?->nama }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('desa.surat.edit', $s->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-emerald-500 hover:bg-emerald-50 dark:hover:bg-emerald-500/10 transition-colors" title="Proses Surat">
                                    <x-heroicon-o-check-circle class="w-5 h-5" />
                                </a>
                                <a href="#" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-sky-500 hover:bg-sky-50 dark:hover:bg-sky-500/10 transition-colors" title="Lihat Detail">
                                    <x-heroicon-o-eye class="w-5 h-5" />
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                <div class="flex flex-col items-center justify-center">
                                    <x-heroicon-o-document-text class="w-10 h-10 text-slate-300 dark:text-slate-700 mb-3" />
                                    <p>Belum ada pengajuan surat.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="p-4 border-t border-slate-200 dark:border-slate-800">
            {{ $surat->links() }}
        </div>
    </div>
</div>
