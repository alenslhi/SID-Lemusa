<?php

namespace App\Livewire\Admin\Surat;

use Livewire\Component;
use Livewire\WithPagination;
use App\Domain\Surat\Models\PengajuanSurat;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $surat = PengajuanSurat::with(['penduduk', 'jenisSurat', 'statusSurat'])
            ->where('kode_pengajuan', 'like', '%' . $this->search . '%')
            ->orWhereHas('penduduk', function ($q) {
                $q->where('nama_lengkap', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.surat.index', compact('surat'))
            ->layout('layouts.admin');
    }
}
