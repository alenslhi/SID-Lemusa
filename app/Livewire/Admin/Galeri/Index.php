<?php

namespace App\Livewire\Admin\Galeri;

use Livewire\Component;
use Livewire\WithPagination;
use App\Domain\Galeri\Models\Galeri;

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
        Galeri::findOrFail($id)->delete();
        session()->flash('success', 'Galeri berhasil dihapus.');
    }

    public function render()
    {
        $galeri = Galeri::where('judul', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(12);

        return view('livewire.admin.galeri.index', compact('galeri'))
            ->layout('layouts.admin');
    }
}
