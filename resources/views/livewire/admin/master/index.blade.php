@section('header', 'Master Data')

<div>
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Master Data & Referensi</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Kelola data referensi yang digunakan di seluruh sistem SID.</p>
        </div>
        <button wire:click="openModal" class="px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-sm shadow-md shadow-emerald-600/20 transition-all flex items-center gap-2">
            <x-heroicon-o-plus class="w-5 h-5" />
            Tambah Data
        </button>
    </div>

    <!-- Tabs -->
    <div class="mb-6 overflow-x-auto custom-scrollbar">
        <div class="flex space-x-2 border-b border-slate-200 dark:border-slate-800 pb-2">
            @php
                $tabs = [
                    'dusun' => ['label' => 'Data Dusun', 'icon' => 'heroicon-o-map'],
                    'agama' => ['label' => 'Agama', 'icon' => 'heroicon-o-book-open'],
                    'pekerjaan' => ['label' => 'Pekerjaan', 'icon' => 'heroicon-o-briefcase'],
                    'pendidikan' => ['label' => 'Pendidikan', 'icon' => 'heroicon-o-academic-cap'],
                    'status_perkawinan' => ['label' => 'Status Kawin', 'icon' => 'heroicon-o-heart'],
                ];
            @endphp
            
            @foreach($tabs as $key => $tab)
                <button wire:click="setTab('{{ $key }}')" 
                    class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold transition-all whitespace-nowrap
                    {{ $activeTab === $key ? 'bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400' : 'text-slate-500 hover:text-slate-800 dark:hover:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }}">
                    
                    @if($tab['icon'] === 'heroicon-o-map') <x-heroicon-o-map class="w-4 h-4" /> @endif
                    @if($tab['icon'] === 'heroicon-o-book-open') <x-heroicon-o-book-open class="w-4 h-4" /> @endif
                    @if($tab['icon'] === 'heroicon-o-briefcase') <x-heroicon-o-briefcase class="w-4 h-4" /> @endif
                    @if($tab['icon'] === 'heroicon-o-academic-cap') <x-heroicon-o-academic-cap class="w-4 h-4" /> @endif
                    @if($tab['icon'] === 'heroicon-o-heart') <x-heroicon-o-heart class="w-4 h-4" /> @endif
                    
                    {{ $tab['label'] }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
        
        <!-- Toolbar -->
        <div class="p-4 border-b border-slate-200 dark:border-slate-800">
            <div class="relative max-w-sm w-full">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <x-heroicon-o-magnifying-glass class="w-5 h-5 text-slate-400" />
                </div>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari data referensi..." class="block w-full pl-10 pr-3 py-2 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white placeholder-slate-400">
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-800 text-slate-500 dark:text-slate-400 font-semibold">
                        <th class="px-6 py-4 w-16">ID</th>
                        <th class="px-6 py-4">Nama Referensi</th>
                        @if($activeTab === 'dusun')
                            <th class="px-6 py-4">Kepala Dusun</th>
                        @endif
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                    @forelse($data as $d)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/50 transition-colors">
                            <td class="px-6 py-4 text-slate-500">{{ $d->id }}</td>
                            <td class="px-6 py-4 font-bold text-slate-900 dark:text-white">{{ $d->nama }}</td>
                            @if($activeTab === 'dusun')
                                <td class="px-6 py-4 text-slate-500">{{ $d->kepala_dusun ?? '-' }}</td>
                            @endif
                            <td class="px-6 py-4 text-right space-x-2">
                                <button wire:click="editModal({{ $d->id }})" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-sky-500 hover:bg-sky-50 dark:hover:bg-sky-500/10 transition-colors" title="Edit">
                                    <x-heroicon-o-pencil-square class="w-5 h-5" />
                                </button>
                                <button @click="$dispatch('confirm-dialog', { 
                                    title: 'Hapus Referensi', 
                                    message: 'Apakah Anda yakin ingin menghapus data referensi ini?', 
                                    confirmCallback: () => @this.delete({{ $d->id }}) 
                                })" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition-colors" title="Hapus">
                                    <x-heroicon-o-trash class="w-5 h-5" />
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $activeTab === 'dusun' ? 4 : 3 }}" class="px-6 py-8 text-center text-slate-500">
                                <div class="flex flex-col items-center justify-center">
                                    <x-heroicon-o-circle-stack class="w-10 h-10 text-slate-300 dark:text-slate-700 mb-3" />
                                    <p>Data referensi belum tersedia.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Form -->
    @if($isModalOpen)
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Overlay -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true" wire:click="closeModal">
                <div class="absolute inset-0 bg-slate-900/75 backdrop-blur-sm"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal Panel -->
            <div class="inline-block align-bottom bg-white dark:bg-slate-950 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-slate-200 dark:border-slate-800">
                <div class="px-6 py-5 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-white">
                        {{ $editId ? 'Edit Data' : 'Tambah Data' }}
                    </h3>
                    <button wire:click="closeModal" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
                        <x-heroicon-o-x-mark class="w-6 h-6" />
                    </button>
                </div>
                
                <form wire:submit.prevent="save">
                    <div class="px-6 py-5 space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Nama <span class="text-rose-500">*</span></label>
                            <input type="text" wire:model="nama" placeholder="Masukkan nama..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white">
                            @error('nama') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
                        </div>

                        @if($activeTab === 'dusun')
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Kepala Dusun</label>
                                <input type="text" wire:model="kepala_dusun" placeholder="Nama Kepala Dusun..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white">
                                @error('kepala_dusun') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
                            </div>
                        @endif
                    </div>
                    <div class="px-6 py-4 bg-slate-50 dark:bg-slate-900/50 border-t border-slate-200 dark:border-slate-800 flex justify-end gap-3">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 rounded-xl font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-800 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold shadow-md shadow-emerald-600/20 transition-all active:scale-[0.98]">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
