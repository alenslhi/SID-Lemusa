@extends('layouts.public')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
<section class="relative bg-slate-900 overflow-hidden min-h-[90vh] flex items-center justify-center">
    <!-- Fullscreen Hero Background -->
    <img src="{{ asset('assets/images/backgrounds/hero.jpg') }}" alt="Desa Lemusa Background" class="absolute inset-0 w-full h-full object-cover">
    
    <!-- Gradient Overlay to ensure text readability -->
    <div class="absolute inset-0 bg-slate-900/60 mix-blend-multiply"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full pt-16 pb-12">
        <div class="text-center max-w-4xl mx-auto">
            
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 text-emerald-300 text-sm font-medium mb-6 border border-white/20 backdrop-blur-md shadow-sm">
                <span class="flex h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                Portal Resmi Pemerintah Desa
            </div>
            
            <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl lg:text-7xl mb-8 leading-tight drop-shadow-lg">
                Mewujudkan <span class="text-emerald-400">Desa Lemusa</span> <br class="hidden sm:block" /> yang Mandiri & Sejahtera
            </h1>
            
            <p class="mt-4 text-base sm:text-lg lg:text-xl font-normal leading-relaxed text-slate-200 lg:px-12 mb-12 drop-shadow-md">
                Sistem Informasi Desa terpadu. Kini melayani administrasi persuratan, informasi kependudukan, dan berita aspirasi cukup dari satu pintu yang cepat, aman, dan transparan.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="#layanan" class="inline-flex items-center justify-center px-8 py-3.5 border border-transparent text-base font-semibold rounded-lg text-white bg-emerald-600 hover:bg-emerald-500 shadow-lg shadow-emerald-600/40 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 focus:ring-offset-slate-900 w-full sm:w-auto">
                    Cek Layanan Administrasi
                </a>
                <a href="#berita" class="inline-flex items-center justify-center px-8 py-3.5 border border-white/30 text-base font-semibold rounded-lg text-white bg-white/10 hover:bg-white/20 backdrop-blur-md shadow-sm transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 focus:ring-offset-slate-900 w-full sm:w-auto">
                    Baca Kabar Terbaru
                </a>
            </div>

        </div>
    </div>
</section>

<!-- Layanan Section -->
<section id="layanan" class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-base text-emerald-600 font-semibold tracking-wide uppercase">Layanan Publik</h2>
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                Akses Layanan Administrasi Mudah
            </p>
            <p class="mt-4 max-w-2xl text-xl text-slate-500 mx-auto">
                Pembuatan surat pengantar, pelaporan, dan pengecekan status permohonan dapat dilakukan secara terpadu.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            <!-- Layanan 1 -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 hover:shadow-lg hover:border-emerald-100 transition-all group">
                <div class="w-14 h-14 bg-emerald-50 rounded-xl flex items-center justify-center mb-6 group-hover:bg-emerald-600 transition-colors">
                    <svg class="w-7 h-7 text-emerald-600 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Pengajuan Surat</h3>
                <p class="text-slate-500 mb-6 line-clamp-3">Ajukan permohonan surat kelahiran, kematian, keterangan tidak mampu, dll secara mandiri.</p>
                <a href="/admin/login" class="text-emerald-600 font-semibold hover:text-emerald-700 flex items-center gap-2">
                    Mulai Pengajuan
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>

            <!-- Layanan 2 -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 hover:shadow-lg hover:border-emerald-100 transition-all group">
                <div class="w-14 h-14 bg-emerald-50 rounded-xl flex items-center justify-center mb-6 group-hover:bg-emerald-600 transition-colors">
                    <svg class="w-7 h-7 text-emerald-600 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Pengaduan Warga</h3>
                <p class="text-slate-500 mb-6 line-clamp-3">Sampaikan keluhan, kritik, saran, atau laporan terkait infrastruktur dan pelayanan publik.</p>
                <a href="/admin/login" class="text-emerald-600 font-semibold hover:text-emerald-700 flex items-center gap-2">
                    Lapor Sekarang
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>


        </div>
    </div>
</section>

<!-- Statistik Desa Section -->
<section id="profil" class="py-20 bg-emerald-600 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] mix-blend-overlay"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center divide-y md:divide-y-0 md:divide-x divide-emerald-500">
            <div class="py-6 md:py-0">
                <p class="text-5xl font-extrabold tracking-tight mb-2">{{ number_format($statistik['penduduk']) }}</p>
                <p class="text-emerald-100 font-medium uppercase tracking-wider text-sm">Total Penduduk</p>
            </div>
            <div class="py-6 md:py-0">
                <p class="text-5xl font-extrabold tracking-tight mb-2">{{ number_format($statistik['keluarga']) }}</p>
                <p class="text-emerald-100 font-medium uppercase tracking-wider text-sm">Kepala Keluarga</p>
            </div>
            <div class="py-6 md:py-0">
                <p class="text-5xl font-extrabold tracking-tight mb-2">{{ number_format($statistik['dusun']) }}</p>
                <p class="text-emerald-100 font-medium uppercase tracking-wider text-sm">Jumlah Dusun</p>
            </div>
            <div class="py-6 md:py-0">
                <p class="text-5xl font-extrabold tracking-tight mb-2">{{ number_format($statistik['surat']) }}</p>
                <p class="text-emerald-100 font-medium uppercase tracking-wider text-sm">Layanan Surat Aktif</p>
            </div>
        </div>
    </div>
</section>

<!-- Berita Terkini Section -->
<section id="berita" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Kabar Desa Terbaru</h2>
                <p class="mt-2 text-slate-500 max-w-2xl text-lg">Informasi, agenda kegiatan, dan pengumuman resmi Desa Lemusa.</p>
            </div>
            <a href="{{ route('berita.index') }}" class="hidden sm:flex text-emerald-600 font-semibold hover:text-emerald-700 items-center gap-2">
                Lihat Semua Berita
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($beritaTerbaru as $berita)
            <div class="flex flex-col rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-lg transition-all group">
                <div class="flex-shrink-0 h-48 bg-slate-200 relative overflow-hidden">
                    @if($berita->thumbnail)
                        <img class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ Storage::url($berita->thumbnail) }}" alt="{{ $berita->judul }}">
                    @else
                        <!-- Fallback Image -->
                        <div class="h-full w-full bg-emerald-50 flex items-center justify-center group-hover:scale-105 transition-transform duration-500">
                            <svg class="h-12 w-12 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-emerald-600 mb-2">
                            {{ $berita->created_at->translatedFormat('d F Y') }}
                        </p>
                        <a href="{{ route('berita.show', $berita->slug) }}" class="block mt-2">
                            <p class="text-xl font-bold text-slate-900 group-hover:text-emerald-600 transition-colors">{{ $berita->judul }}</p>
                            <p class="mt-3 text-base text-slate-500 line-clamp-3">
                                {{ strip_tags($berita->isi) }}
                            </p>
                        </a>
                    </div>
                    <div class="mt-6 flex items-center">
                        <a href="{{ route('berita.show', $berita->slug) }}" class="text-emerald-600 font-semibold hover:text-emerald-700 flex items-center gap-1 text-sm">
                            Baca selengkapnya
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-12 rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50">
                <svg class="mx-auto h-12 w-12 text-slate-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H14"></path>
                </svg>
                <p class="text-slate-500">Belum ada berita terbaru saat ini.</p>
            </div>
            @endforelse
        </div>
        
        <div class="mt-10 sm:hidden flex justify-center">
            <a href="{{ route('berita.index') }}" class="text-emerald-600 font-semibold hover:text-emerald-700 flex items-center gap-2">
                Lihat Semua Berita
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </div>
</section>

@endsection
