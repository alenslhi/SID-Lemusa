@section('header', $isEdit ? 'Edit Agenda' : 'Tambah Agenda Baru')

<div>
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('desa.agenda.index') }}" class="p-2 rounded-xl bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-white transition-colors">
            <x-heroicon-o-arrow-left class="w-5 h-5" />
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">{{ $isEdit ? 'Edit Data Agenda' : 'Tambah Agenda Kegiatan' }}</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Jadwalkan kegiatan atau acara resmi desa.</p>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden p-6 sm:p-8 max-w-3xl">
        <form wire:submit.prevent="save" class="space-y-6">
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Nama Acara / Agenda <span class="text-rose-500">*</span></label>
                <input type="text" wire:model="judul" placeholder="Contoh: Rapat Musyawarah Desa" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white">
                @error('judul') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Tanggal Pelaksanaan <span class="text-rose-500">*</span></label>
                    <input type="date" wire:model="tanggal" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white">
                    @error('tanggal') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Waktu / Jam <span class="text-rose-500">*</span></label>
                    <input type="time" wire:model="jam" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white">
                    @error('jam') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Lokasi Kegiatan <span class="text-rose-500">*</span></label>
                <input type="text" wire:model="lokasi" placeholder="Contoh: Balai Desa Lemusa" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white">
                @error('lokasi') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Keterangan / Deskripsi <span class="text-rose-500">*</span></label>
                <textarea wire:model="deskripsi" rows="4" placeholder="Detail acara, peserta yang diharapkan hadir, atau perlengkapan..." class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white resize-none"></textarea>
                @error('deskripsi') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end gap-4 pt-6 border-t border-slate-200 dark:border-slate-800">
                <a href="{{ route('desa.agenda.index') }}" class="px-6 py-3 rounded-xl font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold shadow-lg shadow-emerald-600/20 transition-all active:scale-[0.98]">
                    {{ $isEdit ? 'Simpan Perubahan' : 'Jadwalkan Agenda' }}
                </button>
            </div>
        </form>
    </div>
</div>
