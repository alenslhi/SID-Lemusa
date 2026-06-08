@section('header', $isEdit ? 'Edit Foto Galeri' : 'Upload Foto Baru')

<div>
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('desa.galeri.index') }}" class="p-2 rounded-xl bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-white transition-colors">
            <x-heroicon-o-arrow-left class="w-5 h-5" />
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">{{ $isEdit ? 'Edit Dokumentasi Foto' : 'Upload Dokumentasi Foto' }}</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Tambahkan dokumentasi foto kegiatan atau potensi desa.</p>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden p-6 sm:p-8 max-w-3xl">
        <form wire:submit.prevent="save" class="space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Preview Gambar -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Pilih Foto (Max 2MB) <span class="text-rose-500">*</span></label>
                    
                    @if($file_path)
                        <div class="mb-4 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 max-w-md aspect-video">
                            <img src="{{ $file_path->temporaryUrl() }}" class="w-full h-full object-cover">
                        </div>
                    @elseif($isEdit && $fileLama)
                        <div class="mb-4 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 max-w-md aspect-video">
                            <img src="{{ Storage::url($fileLama) }}" class="w-full h-full object-cover">
                        </div>
                    @endif

                    <input type="file" wire:model="file_path" class="block w-full text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 dark:file:bg-emerald-500/10 dark:file:text-emerald-400 cursor-pointer">
                    @error('file_path') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Judul Foto <span class="text-rose-500">*</span></label>
                    <input type="text" wire:model="judul" placeholder="Contoh: Kerja Bakti Warga RT 02" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white">
                    @error('judul') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Keterangan / Deskripsi</label>
                    <textarea wire:model="deskripsi" rows="3" placeholder="Tambahkan sedikit cerita tentang foto ini..." class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white resize-none"></textarea>
                    @error('deskripsi') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-1">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Status Publikasi <span class="text-rose-500">*</span></label>
                    <select wire:model="status" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white">
                        <option value="publish">Publish (Tampil di Website)</option>
                        <option value="draft">Draft (Sembunyikan sementara)</option>
                    </select>
                    @error('status') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end gap-4 pt-6 border-t border-slate-200 dark:border-slate-800">
                <a href="{{ route('desa.galeri.index') }}" class="px-6 py-3 rounded-xl font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold shadow-lg shadow-emerald-600/20 transition-all active:scale-[0.98] flex items-center gap-2">
                    <x-heroicon-s-arrow-up-tray class="w-5 h-5" />
                    {{ $isEdit ? 'Simpan Perubahan' : 'Upload Foto' }}
                </button>
            </div>
        </form>
    </div>
</div>
