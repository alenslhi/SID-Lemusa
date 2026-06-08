<?php

namespace App\Livewire\Admin\Keluarga;

use Livewire\Component;
use Livewire\WithPagination;
use App\Domain\Keluarga\Models\Keluarga;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        Keluarga::findOrFail($id)->delete();
        session()->flash('success', 'Data keluarga berhasil dihapus.');
    }

    public function render()
    {
        $keluarga = Keluarga::with(['kepalaKeluarga', 'dusun'])
            ->where('nomor_kk', 'like', '%' . $this->search . '%')
            ->orWhereHas('kepalaKeluarga', function ($q) {
                $q->where('nama_lengkap', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.keluarga.index', compact('keluarga'))
            ->layout('layouts.admin');
    }
}
