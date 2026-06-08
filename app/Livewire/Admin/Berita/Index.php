<?php

namespace App\Livewire\Admin\Berita;

use Livewire\Component;
use Livewire\WithPagination;
use App\Domain\Berita\Models\Berita;

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
        Berita::findOrFail($id)->delete();
        session()->flash('success', 'Berita berhasil dihapus.');
    }

    public function render()
    {
        $berita = Berita::where('judul', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.berita.index', compact('berita'))
            ->layout('layouts.admin');
    }
}
