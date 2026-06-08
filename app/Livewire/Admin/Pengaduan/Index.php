<?php

namespace App\Livewire\Admin\Pengaduan;

use Livewire\Component;
use Livewire\WithPagination;
use App\Domain\Pengaduan\Models\Pengaduan;

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
        $pengaduan = Pengaduan::with(['penduduk', 'kategoriPengaduan'])
            ->where('judul', 'like', '%' . $this->search . '%')
            ->orWhereHas('penduduk', function ($q) {
                $q->where('nama_lengkap', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.pengaduan.index', compact('pengaduan'))
            ->layout('layouts.admin');
    }
}
