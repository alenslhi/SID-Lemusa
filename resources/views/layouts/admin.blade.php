<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50 dark:bg-slate-900">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SID Lemusa') }} - Admin</title>

    <!-- Custom Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @livewireStyles
</head>
<body class="h-full antialiased font-['Plus_Jakarta_Sans',sans-serif] text-slate-800 dark:text-slate-200 bg-slate-50 dark:bg-slate-900 overflow-hidden" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside class="absolute z-20 flex-col w-64 h-full overflow-hidden transition-transform transform bg-white dark:bg-slate-950 border-r border-slate-200 dark:border-slate-800 md:static md:translate-x-0"
            :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">
            
            <!-- Logo -->
            <div class="flex items-center justify-center h-20 border-b border-slate-200 dark:border-slate-800">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-emerald-500/10 rounded-xl">
                        <x-heroicon-o-building-office class="w-8 h-8 text-emerald-500" />
                    </div>
                    <div>
                        <h1 class="text-xl font-bold tracking-tight text-slate-900 dark:text-white leading-none">SID LEMUSA</h1>
                        <span class="text-[10px] font-bold text-emerald-500 uppercase tracking-widest">Admin Panel</span>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <div class="flex-1 overflow-y-auto overflow-x-hidden p-4 space-y-1">
                @livewire('admin.partials.sidebar')
            </div>
            
            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-slate-200 dark:border-slate-800">
                <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-100 dark:bg-slate-900">
                    <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center text-white font-bold">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <p class="text-sm font-bold text-slate-900 dark:text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-500 truncate">{{ auth()->user()->roles->first()?->name ?? 'User' }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex flex-col flex-1 w-full overflow-hidden">
            
            <!-- Top Navigation -->
            <header class="flex items-center justify-between px-6 py-4 bg-white dark:bg-slate-950/80 backdrop-blur-xl border-b border-slate-200 dark:border-slate-800 z-10">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-lg text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 md:hidden focus:outline-none">
                        <x-heroicon-o-bars-3 class="w-6 h-6" />
                    </button>
                    
                    <h2 class="text-xl font-bold text-slate-800 dark:text-slate-100 hidden sm:block">
                        @yield('header', 'Dashboard')
                    </h2>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Notifications -->
                    <button class="p-2 relative rounded-full text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors">
                        <x-heroicon-o-bell class="w-6 h-6" />
                        <span class="absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-rose-500 rounded-full border-2 border-white dark:border-slate-950"></span>
                    </button>

                    <!-- Logout -->
                    <form method="POST" action="/admin/logout">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 px-4 py-2 text-sm font-bold text-rose-500 bg-rose-50 dark:bg-rose-500/10 hover:bg-rose-100 dark:hover:bg-rose-500/20 rounded-xl transition-colors">
                            <x-heroicon-o-arrow-right-start-on-rectangle class="w-5 h-5" />
                            <span class="hidden sm:inline">Keluar</span>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 dark:bg-[#020617]">
                <div class="container px-4 py-8 mx-auto sm:px-6 lg:px-8 max-w-7xl">
                    {{ $slot }}
                </div>
            </main>

        </div>
    </div>

    <!-- Beautiful Custom Confirmation Modal -->
    <div x-data="{ 
        open: false, 
        title: 'Konfirmasi Hapus',
        message: 'Apakah Anda yakin ingin menghapus data ini?', 
        confirmCallback: null,
        trigger(event) {
            this.title = event.detail.title || 'Konfirmasi Hapus';
            this.message = event.detail.message || 'Apakah Anda yakin ingin menghapus data ini?';
            this.confirmCallback = event.detail.confirmCallback;
            this.open = true;
        },
        confirm() {
            if (this.confirmCallback) {
                this.confirmCallback();
            }
            this.open = false;
        }
    }"
    @confirm-dialog.window="trigger($event)"
    x-show="open" 
    class="fixed inset-0 z-[100] overflow-y-auto" 
    style="display: none;">
        <!-- Backdrop with smooth transition -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm"></div>
        
        <!-- Modal wrapper -->
        <div class="flex min-h-full items-center justify-center p-4 text-center">
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 @click.outside="open = false"
                 class="relative transform overflow-hidden rounded-[2rem] bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg p-6 space-y-6">
                 
                 <!-- Header with Warning Icon -->
                 <div class="flex items-start gap-4">
                     <div class="p-3.5 rounded-2xl bg-rose-500/10 text-rose-600 dark:text-rose-400 border border-rose-500/20 shrink-0">
                         <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                         </svg>
                     </div>
                     <div>
                         <h3 class="text-xl font-bold text-slate-900 dark:text-white" x-text="title"></h3>
                         <p class="text-sm text-slate-500 dark:text-slate-400 mt-2 leading-relaxed" x-text="message"></p>
                     </div>
                 </div>
                 
                 <!-- Buttons -->
                 <div class="flex justify-end gap-3 pt-4 border-t border-slate-100 dark:border-slate-800">
                     <button @click="open = false" type="button" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                         Batal
                     </button>
                     <button @click="confirm()" type="button" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-rose-600 hover:bg-rose-500 shadow-lg shadow-rose-600/20 transition-all active:scale-[0.98]">
                         Hapus Data
                     </button>
                 </div>
            </div>
        </div>
    </div>

    @livewireScripts
</body>
</html>
