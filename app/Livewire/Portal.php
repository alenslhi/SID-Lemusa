<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Portal extends Component
{
    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    }

    public function render()
    {
        $user = Auth::user();
        $roles = $user->getRoleNames();

        // Portal Stats for nicer UX
        $stats = [
            'berita' => \App\Domain\Berita\Models\Berita::count(),
            'agenda' => \App\Domain\Agenda\Models\Agenda::where('tanggal_mulai', '>=', now())->count(),
            'pengumuman' => \App\Domain\Pengumuman\Models\Pengumuman::where('selesai_tampil', '>=', now())->count(),
        ];

        // For Warga, show their personal status
        $personal = null;
        if ($user->hasRole('Warga') && $user->penduduk) {
            $personal = [
                'surat_pending' => \App\Domain\Surat\Models\PengajuanSurat::where('penduduk_id', $user->penduduk->id)
                    ->whereHas('statusSurat', fn($q) => $q->whereNotIn('nama', ['Selesai', 'Ditolak']))
                    ->count(),
                'pengaduan_total' => \App\Domain\Pengaduan\Models\Pengaduan::where('penduduk_id', $user->penduduk->id)->count(),
            ];
        }
        
        return view('livewire.portal', [
            'user' => $user,
            'roles' => $roles,
            'stats' => $stats,
            'personal' => $personal,
        ])->layout('layouts.app');
    }
}
