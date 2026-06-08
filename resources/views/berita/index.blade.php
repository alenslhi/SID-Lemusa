@extends('layouts.public')

@section('title', 'Kabar Desa')

@section('content')
<!-- Hero Section for Berita Index -->
<div class="bg-emerald-700 py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-3xl font-extrabold text-white sm:text-4xl lg:text-5xl tracking-tight">Kabar Desa Lemusa</h1>
        <p class="mt-4 max-w-2xl mx-auto text-xl text-emerald-100">
            Kumpulan informasi, berita terkini, dan pengumuman resmi dari Pemerintah Desa Lemusa.
        </p>
    </div>
</div>

<!-- Berita List Section -->
<section class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($semuaBerita as $berita)
            <div class="flex flex-col rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all group bg-white">
                <div class="flex-shrink-0 h-52 bg-slate-200 relative overflow-hidden">
                    @if($berita->thumbnail)
                        <img class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ Storage::url($berita->thumbnail) }}" alt="{{ $berita->judul }}">
                    @else
                        <!-- Fallback Image -->
                        <div class="h-full w-full bg-emerald-50 flex items-center justify-center group-hover:scale-105 transition-transform duration-500">
                            <svg class="h-12 w-12 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H14"></path>
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="flex-1 p-6 flex flex-col justify-between">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-emerald-600 mb-2">
                            {{ $berita->created_at->translatedFormat('l, d F Y') }}
                        </p>
                        <a href="{{ route('berita.show', $berita->slug) }}" class="block mt-2">
                            <p class="text-xl font-bold text-slate-900 group-hover:text-emerald-700 transition-colors">{{ $berita->judul }}</p>
                            <p class="mt-3 text-base text-slate-500 line-clamp-3">
                                {{ strip_tags($berita->isi) }}
                            </p>
                        </a>
                    </div>
                    <div class="mt-6 flex items-center">
                        <a href="{{ route('berita.show', $berita->slug) }}" class="inline-flex items-center text-sm font-semibold text-emerald-600 hover:text-emerald-700">
                            Baca selengkapnya
                            <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-16 bg-white rounded-2xl shadow-sm border border-slate-100">
                <svg class="mx-auto h-16 w-16 text-slate-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H14"></path>
                </svg>
                <h3 class="text-lg font-medium text-slate-900">Belum ada berita</h3>
                <p class="mt-1 text-slate-500">Kabar desa belum dipublikasikan oleh administrator.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12 overflow-x-auto pb-4">
            {{ $semuaBerita->links() }}
        </div>
    </div>
</section>
@endsection