@section('header', 'Galeri Desa')

<div>
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Galeri Foto</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Kelola dokumentasi visual kegiatan desa.</p>
        </div>
        <a href="{{ route('desa.galeri.create') }}" class="px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-sm shadow-md shadow-emerald-600/20 transition-all flex items-center gap-2">
            <x-heroicon-o-plus class="w-5 h-5" />
            Upload Foto
        </a>
    </div>

    <!-- Toolbar -->
    <div class="mb-6 flex flex-col sm:flex-row justify-between gap-4">
        <div class="relative max-w-sm w-full">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <x-heroicon-o-magnifying-glass class="w-5 h-5 text-slate-400" />
            </div>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari Judul Foto..." class="block w-full pl-10 pr-3 py-2 border border-slate-200 dark:border-slate-800 rounded-xl bg-white dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white placeholder-slate-400 shadow-sm">
        </div>
    </div>

    <!-- Grid Galeri -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($galeri as $g)
            <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden group">
                <div class="aspect-video w-full bg-slate-100 dark:bg-slate-900 overflow-hidden relative">
                    @if($g->file_path)
                        <img src="{{ Storage::url($g->file_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <x-heroicon-o-photo class="w-10 h-10 text-slate-300 dark:text-slate-700" />
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end justify-end p-3 gap-2">
                        <a href="{{ route('desa.galeri.edit', $g->id) }}" class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white hover:bg-emerald-500 transition-colors" title="Edit">
                            <x-heroicon-s-pencil class="w-4 h-4" />
                        </a>
                        <button @click="$dispatch('confirm-dialog', { 
                            title: 'Hapus Foto', 
                            message: 'Apakah Anda yakin ingin menghapus foto ini?', 
                            confirmCallback: () => @this.delete({{ $g->id }}) 
                        })" class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white hover:bg-rose-500 transition-colors" title="Hapus">
                            <x-heroicon-s-trash class="w-4 h-4" />
                        </button>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-slate-900 dark:text-white mb-1 line-clamp-1">{{ $g->judul }}</h3>
                    <p class="text-xs text-slate-500 mb-3 line-clamp-2">{{ $g->deskripsi }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] text-slate-400 font-medium">{{ $g->created_at->translatedFormat('d M Y') }}</span>
                        <span class="inline-flex px-2 py-1 text-[9px] font-bold uppercase rounded-md 
                            {{ $g->status === 'publish' ? 'bg-emerald-100 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400' : 'bg-slate-100 text-slate-600 dark:bg-slate-500/10 dark:text-slate-400' }}">
                            {{ $g->status }}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-slate-500">
                <div class="flex flex-col items-center justify-center">
                    <x-heroicon-o-photo class="w-12 h-12 text-slate-300 dark:text-slate-700 mb-3" />
                    <p class="text-lg font-medium text-slate-600 dark:text-slate-400">Belum ada foto di galeri.</p>
                </div>
            </div>
        @endforelse
    </div>
    
    <!-- Pagination -->
    <div class="mt-8">
        {{ $galeri->links() }}
    </div>
</div>
