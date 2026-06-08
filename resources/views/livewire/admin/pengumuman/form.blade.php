@section('header', $isEdit ? 'Edit Pengumuman' : 'Buat Pengumuman Baru')

<div>
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('desa.pengumuman.index') }}" class="p-2 rounded-xl bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-white transition-colors">
            <x-heroicon-o-arrow-left class="w-5 h-5" />
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">{{ $isEdit ? 'Edit Pengumuman' : 'Buat Pengumuman Baru' }}</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Sampaikan informasi publik penting untuk warga.</p>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden p-6 sm:p-8 max-w-3xl">
        <form wire:submit.prevent="save" class="space-y-6">
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Judul Pengumuman <span class="text-rose-500">*</span></label>
                <input type="text" wire:model="judul" placeholder="Contoh: Pemadaman Listrik Bergilir" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white">
                @error('judul') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Isi Pengumuman <span class="text-rose-500">*</span></label>
                <textarea wire:model="isi" rows="6" placeholder="Sampaikan detail informasi secara ringkas dan jelas..." class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white resize-none"></textarea>
                @error('isi') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Status Publikasi <span class="text-rose-500">*</span></label>
                <select wire:model="status" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white">
                    <option value="draft">Draft (Simpan sementara)</option>
                    <option value="publish">Publish (Tayang ke publik)</option>
                </select>
                @error('status') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end gap-4 pt-6 border-t border-slate-200 dark:border-slate-800">
                <a href="{{ route('desa.pengumuman.index') }}" class="px-6 py-3 rounded-xl font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold shadow-lg shadow-emerald-600/20 transition-all active:scale-[0.98] flex items-center gap-2">
                    <x-heroicon-s-megaphone class="w-5 h-5" />
                    {{ $isEdit ? 'Simpan Perubahan' : 'Siarkan Pengumuman' }}
                </button>
            </div>
        </form>
    </div>
</div>
