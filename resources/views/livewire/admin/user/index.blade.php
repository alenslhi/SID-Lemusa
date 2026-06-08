@section('header', 'Manajemen Pengguna')

<div>
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Pengguna Sistem</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Kelola akses akun admin, operator, dan kepala desa.</p>
        </div>
        <button wire:click="openModal" class="px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-sm shadow-md shadow-emerald-600/20 transition-all flex items-center gap-2">
            <x-heroicon-o-user-plus class="w-5 h-5" />
            Tambah Pengguna
        </button>
    </div>

    <!-- Table Card -->
    <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
        
        <!-- Toolbar -->
        <div class="p-4 border-b border-slate-200 dark:border-slate-800">
            <div class="relative max-w-sm w-full">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <x-heroicon-o-magnifying-glass class="w-5 h-5 text-slate-400" />
                </div>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama atau email..." class="block w-full pl-10 pr-3 py-2 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white placeholder-slate-400">
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-800 text-slate-500 dark:text-slate-400 font-semibold">
                        <th class="px-6 py-4">Nama Lengkap</th>
                        <th class="px-6 py-4">Email Address</th>
                        <th class="px-6 py-4 text-center">Role / Peran</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                    @forelse($users as $u)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-slate-900 dark:text-white flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-xs uppercase">
                                    {{ substr($u->name, 0, 2) }}
                                </div>
                                {{ $u->name }}
                            </td>
                            <td class="px-6 py-4 text-slate-500">{{ $u->email }}</td>
                            <td class="px-6 py-4 text-center">
                                @foreach($u->roles as $role)
                                    <span class="inline-flex px-2.5 py-1 text-[10px] font-bold uppercase rounded-md bg-sky-100 text-sky-600 dark:bg-sky-500/10 dark:text-sky-400 mr-1">
                                        {{ $role->name }}
                                    </span>
                                @endforeach
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <button wire:click="editModal({{ $u->id }})" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-sky-500 hover:bg-sky-50 dark:hover:bg-sky-500/10 transition-colors" title="Edit">
                                    <x-heroicon-o-pencil-square class="w-5 h-5" />
                                </button>
                                @if($u->id !== auth()->id())
                                <button @click="$dispatch('confirm-dialog', { 
                                    title: 'Hapus Pengguna', 
                                    message: 'Apakah Anda yakin ingin menghapus pengguna ini? Hapus data pengguna bersifat permanen.', 
                                    confirmCallback: () => @this.delete({{ $u->id }}) 
                                })" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition-colors" title="Hapus">
                                    <x-heroicon-o-trash class="w-5 h-5" />
                                </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-slate-500">
                                <p>Data pengguna belum tersedia.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="p-4 border-t border-slate-200 dark:border-slate-800">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Modal Form -->
    @if($isModalOpen)
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true" wire:click="closeModal">
                <div class="absolute inset-0 bg-slate-900/75 backdrop-blur-sm"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white dark:bg-slate-950 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-slate-200 dark:border-slate-800">
                <div class="px-6 py-5 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-white">
                        {{ $editId ? 'Edit Pengguna' : 'Tambah Pengguna' }}
                    </h3>
                    <button wire:click="closeModal" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
                        <x-heroicon-o-x-mark class="w-6 h-6" />
                    </button>
                </div>
                
                <form wire:submit.prevent="save">
                    <div class="px-6 py-5 space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Nama Lengkap <span class="text-rose-500">*</span></label>
                            <input type="text" wire:model="name" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white">
                            @error('name') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Email <span class="text-rose-500">*</span></label>
                            <input type="email" wire:model="email" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white">
                            @error('email') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Password {!! $editId ? '<span class="text-xs font-normal text-slate-400">(Kosongkan jika tidak ingin diubah)</span>' : '<span class="text-rose-500">*</span>' !!}</label>
                            <input type="password" wire:model="password" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white">
                            @error('password') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
                        </div>
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
