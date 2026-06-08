<header 
    x-data="{ mobileMenuOpen: false, isScrolled: false }"
    @scroll.window="isScrolled = (window.pageYOffset > 20)"
    :class="{ 'bg-white shadow-md': isScrolled, 'bg-white/90 backdrop-blur-md': !isScrolled }"
    class="sticky top-0 z-40 w-full transition-all duration-300 border-b border-gray-100"
>
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" aria-label="Global">
        <div class="flex justify-between h-20 items-center">
            <!-- Logo area -->
            <div class="flex-shrink-0 flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group focus:outline-none focus:ring-2 focus:ring-emerald-500 rounded-lg p-1">
                    <img src="{{ asset('assets/images/logos/logo-parimo.png') }}" alt="Logo Parimo" class="h-10 w-auto object-contain">
                    <div>
                        <span class="block font-bold text-xl text-gray-900 leading-none">Desa Lemusa</span>
                    </div>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex md:items-center md:space-x-2 lg:space-x-6">
                <a href="{{ route('home') }}" class="px-3 py-2 rounded-md text-base font-medium transition-colors hover:text-emerald-600 {{ request()->routeIs('home') ? 'text-emerald-600' : 'text-gray-700' }}">Beranda</a>
                
                <!-- Profil Dropdown -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <a href="{{ route('profil.index') }}" 
                        class="flex items-center gap-1 px-3 py-2 rounded-md text-base font-medium transition-colors hover:text-emerald-600 {{ request()->routeIs('profil.*') ? 'text-emerald-600' : 'text-gray-700' }}"
                        @click="open = !open"
                    >
                        Profil
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </a>
                    <!-- Dropdown panel -->
                    <div x-show="open" 
                        x-transition:enter="transition ease-out duration-100" 
                        x-transition:enter-start="transform opacity-0 scale-95" 
                        x-transition:enter-end="transform opacity-100 scale-100" 
                        x-transition:leave="transition ease-in duration-75" 
                        x-transition:leave-start="transform opacity-100 scale-100" 
                        x-transition:leave-end="transform opacity-0 scale-95" 
                        class="absolute left-0 mt-0 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" style="display: none;">
                        <div class="py-1">
                            <a href="{{ route('profil.index') }}#sejarah" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition-colors">Sejarah Desa</a>
                            <a href="{{ route('profil.index') }}#visi-misi" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition-colors">Visi & Misi</a>
                            <a href="{{ route('profil.index') }}#struktur" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition-colors">Struktur Organisasi</a>
                        </div>
                    </div>
                </div>

                <!-- Layanan Dropdown -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <a href="{{ route('layanan.index') }}" 
                        class="flex items-center gap-1 px-3 py-2 rounded-md text-base font-medium transition-colors hover:text-emerald-600 {{ request()->routeIs('layanan.*') ? 'text-emerald-600' : 'text-gray-700' }}"
                        @click="open = !open"
                    >
                        Layanan
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </a>
                    <!-- Dropdown panel -->
                    <div x-show="open" 
                        x-transition:enter="transition ease-out duration-100" 
                        x-transition:enter-start="transform opacity-0 scale-95" 
                        x-transition:enter-end="transform opacity-100 scale-100" 
                        x-transition:leave="transition ease-in duration-75" 
                        x-transition:leave-start="transform opacity-100 scale-100" 
                        x-transition:leave-end="transform opacity-0 scale-95" 
                        class="absolute left-0 mt-0 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" style="display: none;">
                        <div class="py-1">
                            <a href="{{ route('layanan.index') }}#surat" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition-colors">Pengajuan Surat</a>
                            <a href="{{ route('layanan.index') }}#pengaduan" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition-colors">Pelaporan / Pengaduan</a>

                        </div>
                    </div>
                </div>

                <a href="{{ route('berita.index') }}" class="px-3 py-2 rounded-md text-base font-medium transition-colors hover:text-emerald-600 {{ request()->routeIs('berita.*') ? 'text-emerald-600' : 'text-gray-700' }}">Kabar Desa</a>
            </div>

            <!-- CTA / Login Button -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="/admin/login" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent text-sm font-semibold rounded-lg text-white bg-emerald-600 hover:bg-emerald-700 shadow-sm transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                    Masuk Portal
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="-mr-2 flex items-center md:hidden">
                <button 
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    type="button" 
                    class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-emerald-500" 
                    aria-expanded="false"
                >
                    <span class="sr-only">Buka menu utama</span>
                    <!-- Icon when menu is closed -->
                    <svg x-show="!mobileMenuOpen" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!-- Icon when menu is open -->
                    <svg x-show="mobileMenuOpen" style="display: none;" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div 
        x-show="mobileMenuOpen" 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="absolute top-20 left-0 w-full bg-white shadow-lg border-t border-gray-100 md:hidden"
        style="display: none;"
    >
        <div class="px-2 pt-2 pb-5 space-y-1 sm:px-3">
            <a href="{{ route('home') }}" class="block px-3 py-3 rounded-md text-base font-medium {{ request()->routeIs('home') ? 'text-emerald-700 bg-emerald-50' : 'text-gray-700 hover:text-emerald-700 hover:bg-emerald-50' }}">Beranda</a>
            
            <!-- Mobile Profil Accordion -->
            <div x-data="{ openProfilMobile: false }">
                <button @click="openProfilMobile = !openProfilMobile" class="w-full flex justify-between items-center px-3 py-3 rounded-md text-base font-medium text-gray-700 hover:text-emerald-700 hover:bg-emerald-50 focus:outline-none">
                    Profil Desa
                    <svg class="w-4 h-4 transition-transform" :class="{'rotate-180': openProfilMobile}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </button>
                <div x-show="openProfilMobile" class="pl-6 pr-3 py-2 space-y-2" style="display: none;">
                    <a href="{{ route('profil.index') }}#sejarah" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-600 hover:text-emerald-700 hover:bg-emerald-50">Sejarah</a>
                    <a href="{{ route('profil.index') }}#visi-misi" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-600 hover:text-emerald-700 hover:bg-emerald-50">Visi & Misi</a>
                    <a href="{{ route('profil.index') }}#struktur" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-600 hover:text-emerald-700 hover:bg-emerald-50">Struktur Organisasi</a>
                </div>
            </div>

            <!-- Mobile Layanan Accordion -->
            <div x-data="{ openLayananMobile: false }">
                <button @click="openLayananMobile = !openLayananMobile" class="w-full flex justify-between items-center px-3 py-3 rounded-md text-base font-medium text-gray-700 hover:text-emerald-700 hover:bg-emerald-50 focus:outline-none">
                    Layanan
                    <svg class="w-4 h-4 transition-transform" :class="{'rotate-180': openLayananMobile}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </button>
                <div x-show="openLayananMobile" class="pl-6 pr-3 py-2 space-y-2" style="display: none;">
                    <a href="{{ route('layanan.index') }}#surat" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-600 hover:text-emerald-700 hover:bg-emerald-50">Pengajuan Surat</a>
                    <a href="{{ route('layanan.index') }}#pengaduan" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-600 hover:text-emerald-700 hover:bg-emerald-50">Pelaporan / Pengaduan</a>
                </div>
            </div>

            <a href="{{ route('berita.index') }}" class="block px-3 py-3 rounded-md text-base font-medium {{ request()->routeIs('berita.*') ? 'text-emerald-700 bg-emerald-50' : 'text-gray-700 hover:text-emerald-700 hover:bg-emerald-50' }}">Kabar Desa</a>
            
            <div class="mt-4 pt-4 border-t border-gray-100 px-3">
                <a href="/admin/login" class="block w-full text-center px-4 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-emerald-600 hover:bg-emerald-700">
                    Masuk Portal
                </a>
            </div>
        </div>
    </div>
</header>
