@section('header', 'Agenda Kegiatan Desa')

<div>
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Jadwal Agenda</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Kelola jadwal kegiatan dan acara penting di desa.</p>
        </div>
        <a href="{{ route('desa.agenda.create') }}" class="px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-sm shadow-md shadow-emerald-600/20 transition-all flex items-center gap-2">
            <x-heroicon-o-plus class="w-5 h-5" />
            Tambah Agenda
        </a>
    </div>

    <!-- Data Table Card -->
    <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
        
        <!-- Toolbar -->
        <div class="p-4 border-b border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row justify-between gap-4">
            <div class="relative max-w-sm w-full">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <x-heroicon-o-magnifying-glass class="w-5 h-5 text-slate-400" />
                </div>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari Nama Agenda..." class="block w-full pl-10 pr-3 py-2 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white placeholder-slate-400">
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-800 text-slate-500 dark:text-slate-400 font-semibold">
                        <th class="px-6 py-4">Acara / Agenda</th>
                        <th class="px-6 py-4">Waktu</th>
                        <th class="px-6 py-4">Lokasi</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                    @forelse($agenda as $a)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/50 transition-colors">
                            <td class="px-6 py-4 whitespace-normal">
                                <div class="font-bold text-slate-900 dark:text-white mb-1">{{ $a->judul }}</div>
                                <div class="text-xs text-slate-500 line-clamp-1">{{ $a->deskripsi }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-slate-900 dark:text-white font-semibold">{{ $a->tanggal_mulai?->translatedFormat('d M Y') ?? '-' }}</div>
                                <div class="text-xs text-slate-500 mt-1 flex items-center gap-1">
                                    <x-heroicon-o-clock class="w-3.5 h-3.5" />
                                    {{ $a->tanggal_mulai?->format('H:i') ?? '-' }} WIB
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 rounded-lg text-xs font-semibold">
                                    {{ $a->lokasi }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $isPast = $a->tanggal_mulai?->isPast();
                                @endphp
                                <span class="inline-flex px-2 py-1 text-[10px] font-bold uppercase rounded-md 
                                    {{ $isPast ? 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400' : 'bg-emerald-100 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400' }}">
                                    {{ $isPast ? 'Selesai' : 'Mendatang' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('desa.agenda.edit', $a->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-sky-500 hover:bg-sky-50 dark:hover:bg-sky-500/10 transition-colors" title="Edit">
                                    <x-heroicon-o-pencil-square class="w-5 h-5" />
                                </a>
                                <button @click="$dispatch('confirm-dialog', { 
                                    title: 'Hapus Agenda', 
                                    message: 'Apakah Anda yakin ingin menghapus agenda ini? Hapus data agenda bersifat permanen.', 
                                    confirmCallback: () => @this.delete({{ $a->id }}) 
                                })" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition-colors" title="Hapus">
                                    <x-heroicon-o-trash class="w-5 h-5" />
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                <div class="flex flex-col items-center justify-center">
                                    <x-heroicon-o-calendar class="w-10 h-10 text-slate-300 dark:text-slate-700 mb-3" />
                                    <p>Belum ada jadwal agenda desa.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="p-4 border-t border-slate-200 dark:border-slate-800">
            {{ $agenda->links() }}
        </div>
    </div>
</div>
