@extends('layouts.public')

@section('title', $berita->judul)

@section('content')
<div class="bg-slate-50 py-10 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-12 lg:gap-12">
            
            <!-- Main Content Area -->
            <div class="lg:col-span-8">
                <!-- Breadcrumbs -->
                <nav class="flex text-sm text-slate-500 mb-8" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2">
                        <li>
                            <a href="{{ route('home') }}" class="hover:text-emerald-600 transition-colors">Beranda</a>
                        </li>
                        <li>
                            <svg class="h-4 w-4 text-slate-300" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 5.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                        </li>
                        <li>
                            <a href="{{ route('berita.index') }}" class="hover:text-emerald-600 transition-colors">Kabar Desa</a>
                        </li>
                    </ol>
                </nav>

                <!-- Article Header -->
                <article class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <header class="pt-8 px-6 sm:px-10 pb-6 border-b border-slate-100">
                        <div class="flex items-center text-sm text-slate-500 mb-4 gap-4">
                            <span class="inline-flex items-center gap-1.5 text-emerald-600 font-medium">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $berita->created_at->translatedFormat('l, d F Y') }}
                            </span>
                            <span class="inline-flex items-center gap-1.5 border-l border-slate-200 pl-4">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Ditulis oleh {{ $berita->publisher ? $berita->publisher->name : 'Administrator' }}
                            </span>
                        </div>
                        <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 leading-tight mb-2">
                            {{ $berita->judul }}
                        </h1>
                    </header>

                    <!-- Article Image -->
                    @if($berita->thumbnail)
                        <div class="w-full h-64 sm:h-96 relative overflow-hidden bg-slate-100">
                            <img src="{{ Storage::url($berita->thumbnail) }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover">
                        </div>
                    @endif

                    <!-- Article Content -->
                    <div class="p-6 sm:p-10">
                        <div class="prose prose-emerald prose-lg max-w-none text-slate-700">
                            {!! $berita->isi !!}
                        </div>
                    </div>
                    
                    <!-- Share & Footer -->
                    <div class="px-6 sm:px-10 py-6 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-sm font-medium text-slate-500">Bagikan artikel ini:</span>
                        <div class="flex items-center gap-3">
                            <a href="https://api.whatsapp.com/send?text={{ rawurlencode($berita->judul . ' - ' . url()->current()) }}" target="_blank" class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center hover:bg-green-600 transition-colors shadow-sm" title="Bagikan ke WhatsApp">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.015c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ rawurlencode(url()->current()) }}" target="_blank" class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition-colors shadow-sm" title="Bagikan ke Facebook">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V7.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-4 mt-12 lg:mt-0">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8 sticky top-28">
                    <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <svg class="h-6 w-6 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H14"></path></svg>
                        Kabar Terkini
                    </h3>
                    
                    <div class="space-y-6">
                        @forelse($beritaTerkait as $item)
                        <div class="group flex gap-4 items-start">
                            <div class="flex-shrink-0 w-20 h-20 bg-slate-200 rounded-lg overflow-hidden">
                                @if($item->thumbnail)
                                    <img src="{{ Storage::url($item->thumbnail) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full bg-emerald-50 flex items-center justify-center">
                                        <svg class="h-6 w-6 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <a href="{{ route('berita.show', $item->slug) }}" class="text-sm font-bold text-slate-800 group-hover:text-emerald-600 transition-colors line-clamp-2 leading-snug">
                                    {{ $item->judul }}
                                </a>
                                <p class="text-xs text-slate-500 mt-1">
                                    {{ $item->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        @empty
                        <p class="text-sm text-slate-500">Belum ada berita lainnya.</p>
                        @endforelse
                    </div>

                    <a href="{{ route('berita.index') }}" class="mt-8 w-full block text-center px-4 py-2 border border-emerald-200 text-sm font-medium rounded-lg text-emerald-700 bg-emerald-50 hover:bg-emerald-100 transition-colors">
                        Lihat Indeks Berita
                    </a>
                </div>
            </aside>
            
        </div>
    </div>
</div>
@endsection