@section('header', 'Data Kependudukan')

<div>
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Data Penduduk</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Kelola data induk kependudukan warga desa.</p>
        </div>
        <a href="{{ route('desa.penduduk.create') }}" class="px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-sm shadow-md shadow-emerald-600/20 transition-all flex items-center gap-2">
            <x-heroicon-o-plus class="w-5 h-5" />
            Tambah Penduduk
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
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari NIK atau Nama Lengkap..." class="block w-full pl-10 pr-3 py-2 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white placeholder-slate-400">
            </div>
            <div class="flex gap-2">
                <!-- Additional filters can go here -->
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-800 text-slate-500 dark:text-slate-400 font-semibold">
                        <th class="px-6 py-4">NIK & Nama</th>
                        <th class="px-6 py-4">Jenis Kelamin</th>
                        <th class="px-6 py-4">Dusun / Alamat</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                    @forelse($penduduk as $p)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 font-bold shrink-0">
                                        {{ strtoupper(substr($p->nama_lengkap, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-900 dark:text-white">{{ $p->nama_lengkap }}</div>
                                        <div class="text-xs text-slate-500 font-mono">{{ $p->nik }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                {{ $p->jenis_kelamin?->getLabel() ?? ($p->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-slate-900 dark:text-white">{{ $p->dusun?->nama ?? '-' }}</div>
                                <div class="text-xs text-slate-500 truncate max-w-[150px]">{{ $p->keluarga?->alamat ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex px-2 py-1 text-[10px] font-bold uppercase rounded-md 
                                    {{ $p->status_penduduk === 'aktif' ? 'bg-emerald-100 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400' : 'bg-rose-100 text-rose-600 dark:bg-rose-500/10 dark:text-rose-400' }}">
                                    {{ $p->status_penduduk }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('desa.penduduk.edit', $p->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-sky-500 hover:bg-sky-50 dark:hover:bg-sky-500/10 transition-colors" title="Edit">
                                    <x-heroicon-o-pencil-square class="w-5 h-5" />
                                </a>
                                <button @click="$dispatch('confirm-dialog', { 
                                    title: 'Hapus Data Penduduk', 
                                    message: 'Apakah Anda yakin ingin menghapus data penduduk ini? Hapus data penduduk bersifat permanen.', 
                                    confirmCallback: () => @this.delete({{ $p->id }}) 
                                })" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition-colors" title="Hapus">
                                    <x-heroicon-o-trash class="w-5 h-5" />
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                <div class="flex flex-col items-center justify-center">
                                    <x-heroicon-o-users class="w-10 h-10 text-slate-300 dark:text-slate-700 mb-3" />
                                    <p>Data penduduk tidak ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="p-4 border-t border-slate-200 dark:border-slate-800">
            {{ $penduduk->links() }}
        </div>
    </div>
</div>
