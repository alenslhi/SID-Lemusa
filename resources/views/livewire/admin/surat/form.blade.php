@section('header', 'Proses Surat')

<div>
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('desa.surat.index') }}" class="p-2 rounded-xl bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-white transition-colors">
            <x-heroicon-o-arrow-left class="w-5 h-5" />
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Proses Permohonan Surat</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Tinjau permohonan surat dan perbarui status.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Detail Surat Card -->
        <div class="lg:col-span-2 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden p-6 sm:p-8">
            <div class="flex items-center gap-3 mb-6">
                <span class="px-3 py-1 rounded-full bg-sky-100 dark:bg-sky-900/30 text-sky-600 dark:text-sky-400 text-xs font-bold uppercase tracking-wider border border-sky-200 dark:border-sky-800">
                    {{ $surat->jenisSurat?->nama }}
                </span>
                <span class="text-sm text-slate-500 font-mono font-bold">{{ $surat->kode_pengajuan }}</span>
            </div>

            <h2 class="text-xl font-bold text-slate-800 dark:text-white mb-6 border-b border-slate-200 dark:border-slate-800 pb-2">Informasi Pemohon</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                <div>
                    <span class="text-xs text-slate-500 uppercase font-bold tracking-wider block mb-1">Nama Lengkap</span>
                    <p class="font-semibold text-slate-900 dark:text-white">{{ $surat->penduduk?->nama_lengkap }}</p>
                </div>
                <div>
                    <span class="text-xs text-slate-500 uppercase font-bold tracking-wider block mb-1">NIK</span>
                    <p class="font-mono text-slate-900 dark:text-white">{{ $surat->penduduk?->nik }}</p>
                </div>
                <div>
                    <span class="text-xs text-slate-500 uppercase font-bold tracking-wider block mb-1">Tanggal Pengajuan</span>
                    <p class="text-slate-900 dark:text-white">{{ $surat->created_at->translatedFormat('d F Y H:i') }}</p>
                </div>
            </div>

            <h2 class="text-xl font-bold text-slate-800 dark:text-white mb-4 border-b border-slate-200 dark:border-slate-800 pb-2">Keterangan / Keperluan</h2>
            <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-800 mb-8">
                <p class="text-slate-700 dark:text-slate-300 leading-relaxed whitespace-pre-wrap">{{ $surat->keterangan ?? 'Tidak ada keterangan tambahan dari pemohon.' }}</p>
            </div>

            @if($surat->dokumen_persyaratan)
            <h2 class="text-xl font-bold text-slate-800 dark:text-white mb-4 border-b border-slate-200 dark:border-slate-800 pb-2">Dokumen Persyaratan</h2>
            <!-- To be implemented if json/array format is known -->
            @endif
        </div>

        <!-- Proses & Status Form -->
        <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden p-6 sm:p-8 self-start">
            <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-6 border-b border-slate-200 dark:border-slate-800 pb-3">Update Status Surat</h3>
            
            <form wire:submit.prevent="save" class="space-y-6">
                
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Status Saat Ini <span class="text-rose-500">*</span></label>
                    <select wire:model="status_surat_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white">
                        @foreach($statusList as $st)
                            <option value="{{ $st->id }}">{{ $st->nama }}</option>
                        @endforeach
                    </select>
                    @error('status_surat_id') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Upload Surat Selesai (TTD)</label>
                    <input type="file" wire:model="file_dokumen" class="block w-full text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 dark:file:bg-emerald-500/10 dark:file:text-emerald-400 cursor-pointer">
                    <p class="text-[10px] text-slate-500 mt-1">Opsional: Format PDF/JPG/PNG max 2MB. Jika surat sudah jadi dan bisa diunduh warga.</p>
                    @error('file_dokumen') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="w-full px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold shadow-lg shadow-emerald-600/20 transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                    <x-heroicon-s-check-circle class="w-5 h-5" />
                    Simpan Status
                </button>
            </form>
            
            <div class="mt-6 pt-6 border-t border-slate-200 dark:border-slate-800">
                <a href="#" class="w-full px-6 py-3 rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-bold shadow-lg shadow-sky-600/20 transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                    <x-heroicon-o-printer class="w-5 h-5" />
                    Cetak Surat (PDF)
                </a>
                <p class="text-[10px] text-center text-slate-500 mt-2">Cetak form pengajuan atau draft surat.</p>
            </div>
        </div>

    </div>
</div>
