<div>
    @php
        $navItems = [
            [
                'title' => 'Dashboard',
                'route' => 'desa.dashboard',
                'icon' => 'heroicon-o-home',
                'roles' => ['Super Admin', 'Kepala Desa', 'Operator Desa'],
            ],
            [
                'title' => 'Kependudukan',
                'route' => 'desa.penduduk.index',
                'icon' => 'heroicon-o-users',
                'roles' => ['Super Admin', 'Operator Desa'],
            ],
            [
                'title' => 'Keluarga',
                'route' => 'desa.keluarga.index',
                'icon' => 'heroicon-o-user-group',
                'roles' => ['Super Admin', 'Operator Desa'],
            ],
            [
                'title' => 'Pengajuan Surat',
                'route' => 'desa.surat.index',
                'icon' => 'heroicon-o-document-text',
                'roles' => ['Super Admin', 'Kepala Desa', 'Operator Desa'],
            ],
            [
                'title' => 'Pengaduan',
                'route' => 'desa.pengaduan.index',
                'icon' => 'heroicon-o-chat-bubble-bottom-center-text',
                'roles' => ['Super Admin', 'Kepala Desa', 'Operator Desa'],
            ],
            [
                'title' => 'Berita Desa',
                'route' => 'desa.berita.index',
                'icon' => 'heroicon-o-newspaper',
                'roles' => ['Super Admin', 'Operator Desa'],
            ],
            [
                'title' => 'Agenda Desa',
                'route' => 'desa.agenda.index',
                'icon' => 'heroicon-o-calendar',
                'roles' => ['Super Admin', 'Operator Desa'],
            ],
            [
                'title' => 'Pengumuman',
                'route' => 'desa.pengumuman.index',
                'icon' => 'heroicon-o-megaphone',
                'roles' => ['Super Admin', 'Kepala Desa', 'Operator Desa'],
            ],
            [
                'title' => 'Galeri Desa',
                'route' => 'desa.galeri.index',
                'icon' => 'heroicon-o-photo',
                'roles' => ['Super Admin', 'Operator Desa'],
            ],
            [
                'title' => 'Master Data',
                'route' => 'desa.master.index',
                'icon' => 'heroicon-o-circle-stack',
                'roles' => ['Super Admin'],
            ],
            [
                'title' => 'User Management',
                'route' => 'desa.user.index',
                'icon' => 'heroicon-o-users',
                'roles' => ['Super Admin'],
            ],
            [
                'title' => 'Profil Desa',
                'route' => 'desa.profil.index',
                'icon' => 'heroicon-o-building-office-2',
                'roles' => ['Super Admin', 'Kepala Desa'],
            ],
        ];

        $user = auth()->user();
    @endphp

    <nav class="space-y-1">
        @foreach($navItems as $item)
            @if($user && $user->hasAnyRole($item['roles']))
                @php
                    $isActive = request()->routeIs($item['route']);
                @endphp
                <a href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group
                          {{ $isActive ? 'bg-emerald-500 text-white shadow-md shadow-emerald-500/20' : 'text-slate-600 dark:text-slate-400 hover:bg-emerald-50 hover:text-emerald-600 dark:hover:bg-emerald-500/10 dark:hover:text-emerald-400' }}">
                    
                    @if($item['icon'] === 'heroicon-o-home')
                        <x-heroicon-o-home class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-slate-400 group-hover:text-emerald-500' }}" />
                    @elseif($item['icon'] === 'heroicon-o-users')
                        <x-heroicon-o-users class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-slate-400 group-hover:text-emerald-500' }}" />
                    @elseif($item['icon'] === 'heroicon-o-user-group')
                        <x-heroicon-o-user-group class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-slate-400 group-hover:text-emerald-500' }}" />
                    @elseif($item['icon'] === 'heroicon-o-document-text')
                        <x-heroicon-o-document-text class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-slate-400 group-hover:text-emerald-500' }}" />
                    @elseif($item['icon'] === 'heroicon-o-chat-bubble-bottom-center-text')
                        <x-heroicon-o-chat-bubble-bottom-center-text class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-slate-400 group-hover:text-emerald-500' }}" />
                    @elseif($item['icon'] === 'heroicon-o-newspaper')
                        <x-heroicon-o-newspaper class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-slate-400 group-hover:text-emerald-500' }}" />
                    @elseif($item['icon'] === 'heroicon-o-calendar')
                        <x-heroicon-o-calendar class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-slate-400 group-hover:text-emerald-500' }}" />
                    @elseif($item['icon'] === 'heroicon-o-megaphone')
                        <x-heroicon-o-megaphone class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-slate-400 group-hover:text-emerald-500' }}" />
                    @elseif($item['icon'] === 'heroicon-o-photo')
                        <x-heroicon-o-photo class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-slate-400 group-hover:text-emerald-500' }}" />
                    @elseif($item['icon'] === 'heroicon-o-circle-stack')
                        <x-heroicon-o-circle-stack class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-slate-400 group-hover:text-emerald-500' }}" />
                    @elseif($item['icon'] === 'heroicon-o-building-office-2')
                        <x-heroicon-o-building-office-2 class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-slate-400 group-hover:text-emerald-500' }}" />
                    @else
                        <x-heroicon-o-squares-2x2 class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-slate-400 group-hover:text-emerald-500' }}" />
                    @endif

                    <span class="font-semibold text-sm">{{ $item['title'] }}</span>
                </a>
            @endif
        @endforeach
    </nav>
</div>
