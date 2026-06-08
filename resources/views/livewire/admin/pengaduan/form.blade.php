@section('header', 'Proses Pengaduan')

<div>
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('desa.pengaduan.index') }}" class="p-2 rounded-xl bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-white transition-colors">
            <x-heroicon-o-arrow-left class="w-5 h-5" />
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Proses Laporan Pengaduan</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Tinjau detail laporan dan berikan tanggapan resmi.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Detail Pengaduan Card -->
        <div class="lg:col-span-2 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden p-6 sm:p-8">
            <div class="flex items-center gap-3 mb-6">
                <span class="px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-xs font-bold uppercase tracking-wider border border-slate-200 dark:border-slate-700">
                    {{ $pengaduan->kategoriPengaduan?->nama }}
                </span>
                <span class="text-sm text-slate-500">{{ $pengaduan->created_at->translatedFormat('d F Y H:i') }} WIB</span>
            </div>

            <h2 class="text-2xl font-black text-slate-900 dark:text-white mb-4">{{ $pengaduan->judul }}</h2>
            
            <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-800 mb-8">
                <p class="text-slate-700 dark:text-slate-300 leading-relaxed whitespace-pre-wrap">{{ $pengaduan->isi_laporan }}</p>
            </div>

            @if($pengaduan->lampiran)
                <!-- Placeholder for attachments if any -->
            @endif

            <div class="border-t border-slate-200 dark:border-slate-800 pt-6">
                <h3 class="text-sm font-bold text-slate-800 dark:text-white mb-4 uppercase tracking-wider">Informasi Pelapor</h3>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-emerald-100 dark:bg-emerald-500/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400 font-bold text-lg">
                        {{ strtoupper(substr($pengaduan->penduduk?->nama_lengkap ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-bold text-slate-900 dark:text-white">{{ $pengaduan->penduduk?->nama_lengkap ?? 'Anonim / Data Dihapus' }}</p>
                        <p class="text-sm text-slate-500">NIK: {{ $pengaduan->penduduk?->nik ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Proses & Tanggapan Form -->
        <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden p-6 sm:p-8 self-start">
            <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-6 border-b border-slate-200 dark:border-slate-800 pb-3">Beri Tanggapan</h3>
            
            <form wire:submit.prevent="save" class="space-y-6">
                
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Status Laporan <span class="text-rose-500">*</span></label>
                    <select wire:model="status" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white">
                        <option value="baru">Menunggu (Baru)</option>
                        <option value="proses">Sedang Diproses</option>
                        <option value="selesai">Selesai Ditangani</option>
                    </select>
                    @error('status') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Tanggapan Resmi</label>
                    <textarea wire:model="tanggapan" rows="5" placeholder="Tuliskan jawaban atau hasil tindak lanjut dari laporan ini..." class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-slate-900 dark:text-white resize-none"></textarea>
                    <p class="text-[10px] text-slate-500 mt-1">Tanggapan ini akan dapat dilihat langsung oleh pelapor di Portal Warga.</p>
                    @error('tanggapan') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="w-full px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold shadow-lg shadow-emerald-600/20 transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                    <x-heroicon-s-paper-airplane class="w-5 h-5" />
                    Simpan & Kirim
                </button>
            </form>
        </div>

    </div>
</div>
