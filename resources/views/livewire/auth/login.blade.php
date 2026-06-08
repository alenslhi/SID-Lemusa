<div class="w-full max-w-md p-6">
    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 p-8 border border-slate-100">
        <!-- Logo & Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 mb-4 shadow-inner">
                <x-heroicon-s-building-office-2 class="w-8 h-8" />
            </div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">SID Lemusa</h1>
            <p class="text-slate-500 text-sm mt-1">Sistem Informasi Desa Lemusa</p>
        </div>

        <form wire:submit.prevent="login" class="space-y-5">
            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Alamat Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <x-heroicon-o-envelope class="w-5 h-5 text-slate-400" />
                    </div>
                    <input wire:model="email" id="email" type="email" required autofocus
                        class="block w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-colors"
                        placeholder="Masukkan email Anda">
                </div>
                @error('email') <span class="text-sm text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <x-heroicon-o-lock-closed class="w-5 h-5 text-slate-400" />
                    </div>
                    <input wire:model="password" id="password" type="password" required
                        class="block w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-colors"
                        placeholder="••••••••">
                </div>
                @error('password') <span class="text-sm text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between pt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input wire:model="remember" type="checkbox" class="w-4 h-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                    <span class="text-sm text-slate-600">Ingat Saya</span>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full flex justify-center items-center gap-2 py-3.5 px-4 bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-bold rounded-xl shadow-lg shadow-emerald-600/20 transition-all active:scale-[0.98]">
                <x-heroicon-s-arrow-right-on-rectangle class="w-5 h-5" />
                Masuk ke Sistem
            </button>
        </form>

        <div class="mt-8 text-center">
            <a href="{{ route('home') }}" class="text-sm font-medium text-slate-500 hover:text-emerald-600 transition-colors inline-flex items-center gap-1.5">
                <x-heroicon-m-arrow-left class="w-4 h-4" />
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
