<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Domain\Penduduk\Models\Penduduk;
use App\Domain\Surat\Models\PengajuanSurat;
use App\Domain\Pengaduan\Models\Pengaduan;

class Dashboard extends Component
{
    public function render()
    {
        $stats = [
            'total_penduduk' => Penduduk::count(),
            'surat_pending' => PengajuanSurat::where('status_surat_id', 1)->count(), // 1: Menunggu Verifikasi
            'pengaduan_baru' => Pengaduan::where('status', 'baru')->count(),
        ];

        $latestSurat = PengajuanSurat::with(['penduduk', 'jenisSurat', 'statusSurat'])->latest()->take(5)->get();
        $latestPengaduan = Pengaduan::with(['penduduk', 'kategoriPengaduan'])->latest()->take(5)->get();

        return view('livewire.admin.dashboard', compact('stats', 'latestSurat', 'latestPengaduan'))
            ->layout('layouts.admin');
    }
}
