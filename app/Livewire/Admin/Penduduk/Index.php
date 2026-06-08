<?php

namespace App\Livewire\Admin\Penduduk;

use Livewire\Component;
use Livewire\WithPagination;
use App\Domain\Penduduk\Models\Penduduk;

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
        Penduduk::findOrFail($id)->delete();
        session()->flash('success', 'Data penduduk berhasil dihapus.');
    }

    public function render()
    {
        $penduduk = Penduduk::with(['keluarga', 'dusun'])
            ->where('nama_lengkap', 'like', '%' . $this->search . '%')
            ->orWhere('nik', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.penduduk.index', compact('penduduk'))
            ->layout('layouts.admin');
    }
}
