@section('header', $isEdit ? 'Edit Berita' : 'Tulis Berita Baru')

<div>
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('desa.berita.index') }}" class="p-2 rounded-xl bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-white transition-colors">
            <x-heroicon-o-arrow-left class="w-5 h-5" />
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">{{ $isEdit ? 'Edit Artikel Berita' : 'Tulis Berita Baru' }}</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Buat publikasi baru untuk diunggah ke portal warga.</p>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden p-6 sm:p-8">
        <form wire:submit.prevent="save" class="space-y-6">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Kolom Kiri: Judul & Isi -->
                <div class="lg:col-span-2 space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Judul Artikel <span class="text-rose-500">*</span></label>
                        <input type="text" wire:model="judul" placeholder="Contoh: Pembagian Bantuan Langsung Tunai Tahap 3" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white">
                        @error('judul') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Isi Artikel <span class="text-rose-500">*</span></label>
                        <textarea wire:model="isi" rows="15" placeholder="Tulis konten berita di sini..." class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white resize-none"></textarea>
                        @error('isi') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Kolom Kanan: Meta, Kategori, Status -->
                <div class="space-y-6">

                    <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800">
                        <h3 class="text-sm font-bold text-slate-800 dark:text-white mb-4 border-b border-slate-200 dark:border-slate-800 pb-2">Gambar Sampul</h3>
                        
                        @if($gambar)
                            <div class="mb-3 rounded-lg overflow-hidden border border-slate-200 dark:border-slate-700">
                                <img src="{{ $gambar->temporaryUrl() }}" class="w-full h-32 object-cover">
                            </div>
                        @elseif($isEdit && $gambarLama)
                            <div class="mb-3 rounded-lg overflow-hidden border border-slate-200 dark:border-slate-700">
                                <img src="{{ Storage::url($gambarLama) }}" class="w-full h-32 object-cover">
                            </div>
                        @endif

                        <input type="file" wire:model="gambar" class="block w-full text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 dark:file:bg-emerald-500/10 dark:file:text-emerald-400 cursor-pointer">
                        @error('gambar') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end gap-4 pt-6 border-t border-slate-200 dark:border-slate-800">
                <a href="{{ route('desa.berita.index') }}" class="px-6 py-3 rounded-xl font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold shadow-lg shadow-emerald-600/20 transition-all active:scale-[0.98] flex items-center gap-2">
                    <x-heroicon-s-paper-airplane class="w-5 h-5" />
                    {{ $isEdit ? 'Simpan Perubahan' : 'Terbitkan Berita' }}
                </button>
            </div>
        </form>
    </div>
</div>
