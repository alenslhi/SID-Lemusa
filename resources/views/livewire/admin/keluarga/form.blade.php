@section('header', $isEdit ? 'Edit Data Keluarga' : 'Tambah Keluarga Baru')

<div>
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('desa.keluarga.index') }}" class="p-2 rounded-xl bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-white transition-colors">
            <x-heroicon-o-arrow-left class="w-5 h-5" />
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">{{ $isEdit ? 'Edit Data Kartu Keluarga' : 'Tambah Kartu Keluarga Baru' }}</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Lengkapi form di bawah ini dengan data keluarga yang valid.</p>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden p-6 sm:p-8">
        <form wire:submit.prevent="save" class="space-y-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nomer KK -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Nomor Kartu Keluarga (KK) <span class="text-rose-500">*</span></label>
                    <input type="text" wire:model="nomor_kk" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white">
                    @error('nomor_kk') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Kepala Keluarga -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Kepala Keluarga <span class="text-rose-500">*</span></label>
                    <select wire:model="kepala_keluarga_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white">
                        <option value="">-- Pilih Penduduk --</option>
                        @foreach($pendudukList as $pd)
                            <option value="{{ $pd->id }}">{{ $pd->nama_lengkap }} (NIK: {{ $pd->nik }})</option>
                        @endforeach
                    </select>
                    @error('kepala_keluarga_id') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Alamat -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Alamat Lengkap (Jalan / Gang) <span class="text-rose-500">*</span></label>
                    <input type="text" wire:model="alamat" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white">
                    @error('alamat') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- RT -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">RT <span class="text-rose-500">*</span></label>
                    <input type="text" wire:model="rt" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white">
                    @error('rt') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- RW -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">RW <span class="text-rose-500">*</span></label>
                    <input type="text" wire:model="rw" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white">
                    @error('rw') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Dusun -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Dusun <span class="text-rose-500">*</span></label>
                    <select wire:model="dusun_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white">
                        <option value="">-- Pilih Dusun --</option>
                        @foreach($dusunList as $ds)
                            <option value="{{ $ds->id }}">{{ $ds->nama }}</option>
                        @endforeach
                    </select>
                    @error('dusun_id') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Kode Pos -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Kode Pos</label>
                    <input type="text" wire:model="kode_pos" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white">
                    @error('kode_pos') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end gap-4 pt-6 border-t border-slate-200 dark:border-slate-800">
                <a href="{{ route('desa.keluarga.index') }}" class="px-6 py-3 rounded-xl font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold shadow-lg shadow-emerald-600/20 transition-all active:scale-[0.98]">
                    {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Keluarga' }}
                </button>
            </div>
        </form>
    </div>
</div>
