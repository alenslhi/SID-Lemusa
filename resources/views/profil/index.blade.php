@extends('layouts.public')

@section('title', 'Profil Desa')

@section('content')
<!-- Hero Section for Profil Index -->
<div class="bg-emerald-700 py-16 sm:py-24 relative overflow-hidden">
    <!-- Abstract pattern background for Profile -->
    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] mix-blend-overlay"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h1 class="text-3xl font-extrabold text-white sm:text-4xl lg:text-5xl tracking-tight">Profil Desa Lemusa</h1>
        <p class="mt-4 max-w-2xl mx-auto text-xl text-emerald-100">
            Mengenal lebih dekat sejarah, visi misi, serta struktur pemerintahan Desa Lemusa.
        </p>
    </div>
</div>

<div class="bg-slate-50 py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($profil)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                
                <!-- Main Profil Content -->
                <div class="lg:col-span-2 space-y-12">
                    
                    <!-- Sejarah Desa -->
                    <div id="sejarah" class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 sm:p-10 scroll-mt-28">
                        <div class="flex items-center gap-4 mb-6 text-emerald-600">
                            <div class="p-3 bg-emerald-50 rounded-xl">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <h2 class="text-2xl font-bold tracking-tight text-slate-900">Sejarah Desa</h2>
                        </div>
                        <div class="prose prose-emerald max-w-none text-slate-600">
                            {!! $profil->sejarah ?: '<em>Belum ada data riwayat sejarah desa.</em>' !!}
                        </div>
                    </div>

                    <!-- Visi & Misi -->
                    <div id="visi-misi" class="grid grid-cols-1 sm:grid-cols-2 gap-8 scroll-mt-28">
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
                            <div class="flex items-center gap-4 mb-6 text-emerald-600">
                                <div class="p-3 bg-emerald-50 rounded-xl">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </div>
                                <h2 class="text-xl font-bold tracking-tight text-slate-900">Visi</h2>
                            </div>
                            <div class="prose prose-emerald text-slate-600">
                                {!! $profil->visi ?: '<em>Belum ada data visi desa.</em>' !!}
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
                            <div class="flex items-center gap-4 mb-6 text-emerald-600">
                                <div class="p-3 bg-emerald-50 rounded-xl">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                </div>
                                <h2 class="text-xl font-bold tracking-tight text-slate-900">Misi</h2>
                            </div>
                            <div class="prose prose-emerald text-slate-600">
                                {!! $profil->misi ?: '<em>Belum ada data misi desa.</em>' !!}
                            </div>
                        </div>
                    </div>

                    <!-- Struktur Organisasi Block Placeholder -->
                    <div id="struktur" class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 sm:p-10 scroll-mt-28">
                        <div class="flex items-center gap-4 mb-6 text-emerald-600">
                            <div class="p-3 bg-emerald-50 rounded-xl">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <h2 class="text-2xl font-bold tracking-tight text-slate-900">Struktur Organisasi</h2>
                        </div>
                        <div class="prose prose-emerald max-w-none text-slate-600 bg-slate-50 border border-dashed border-slate-200 rounded-xl p-8 text-center flex flex-col justify-center items-center">
                            <svg class="h-12 w-12 text-slate-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H14"></path></svg>
                            <p class="mb-0">Bagan Struktur Organisasi Pemerintah Desa Lemusa sedang dalam tahap pembaruan.</p>
                        </div>
                    </div>

                </div>

                <!-- Sidebar / Kontak -->
                <div class="lg:col-span-1 space-y-8">
                    
                    <!-- Sambutan Kepala Desa -->
                    @if($profil->sambutan_kepala_desa)
                    <div class="bg-emerald-600 rounded-2xl shadow-sm p-8 text-white relative overflow-hidden">
                        <svg class="absolute top-0 right-0 transform translate-x-1/3 -translate-y-1/3 h-48 w-48 text-emerald-500 opacity-50" fill="currentColor" viewBox="0 0 32 32"><path d="M9.362 9.178A7.785 7.785 0 0116.711 3.5c4.321 0 7.828 3.508 7.828 7.828A7.785 7.785 0 0116.711 19.1h-1.63v-3.23h1.63a4.55 4.55 0 004.55-4.55c0-2.52-2.03-4.55-4.55-4.55-2.52 0-4.55 2.03-4.55 4.55H6.132A7.756 7.756 0 019.362 9.178z"></path></svg>
                        <h3 class="text-xl font-bold mb-4 relative z-10">Sambutan Kepala Desa</h3>
                        <div class="prose prose-invert prose-em text-emerald-50 relative z-10 italic">
                            {!! $profil->sambutan_kepala_desa !!}
                        </div>
                    </div>
                    @endif

                    <!-- Peta Lokasi -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                        <div class="p-6 border-b border-slate-100">
                            <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                                <svg class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Lokasi Kantor Desa
                            </h3>
                        </div>
                        <div class="w-full h-64 bg-slate-200">
                            @if($profil->maps_embed)
                                {!! str_replace('<iframe ', '<iframe class="w-full h-full border-0" ', $profil->maps_embed) !!}
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-slate-400">
                                    <svg class="h-10 w-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
                                    <span class="text-sm">Peta Desa Lemusa (Google Maps)</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-6 bg-slate-50 text-sm text-slate-600">
                            <p class="mb-2"><strong>Alamat:</strong><br/>{{ $profil->alamat ?: '-' }}</p>
                            <p class="mb-2"><strong>Telepon:</strong><br/>{{ $profil->telepon ?: '-' }}</p>
                            <p><strong>Email:</strong><br/>{{ $profil->email ?: '-' }}</p>
                        </div>
                    </div>
                </div>

            </div>
        @else
            <!-- Data Belum Tersedia -->
            <div class="text-center py-20 bg-white rounded-2xl shadow-sm border border-slate-100">
                <svg class="mx-auto h-16 w-16 text-slate-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H14"></path>
                </svg>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Profil Belum Diatur</h3>
                <p class="text-slate-500 max-w-md mx-auto">
                    Data profil desa belum diisi oleh perangkat daerah. Silahkan periksa kembali nanti untuk mengetahui informasi historis dan pemerintahan Desa Lemusa.
                </p>
            </div>
        @endif
    </div>
</div>
@endsection <div class="text-center py-20 bg-white rounded-2xl shadow-sm border border-slate-100">
                <svg class="mx-auto h-16 w-16 text-slate-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H14"></path>
                </svg>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Profil Belum Diatur</h3>
                <p class="text-slate-500 max-w-md mx-auto">
                    Data profil desa belum diisi oleh perangkat daerah. Silahkan periksa kembali nanti untuk mengetahui informasi historis dan pemerintahan Desa Lemusa.
                </p>
            </div>
        @endif
    </div>
</div>
@endsection