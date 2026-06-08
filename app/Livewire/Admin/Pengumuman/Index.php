<?php

namespace App\Livewire\Admin\Pengumuman;

use Livewire\Component;
use Livewire\WithPagination;
use App\Domain\Pengumuman\Models\Pengumuman;

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
        Pengumuman::findOrFail($id)->delete();
        session()->flash('success', 'Pengumuman berhasil dihapus.');
    }

    public function render()
    {
        $pengumuman = Pengumuman::where('judul', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.pengumuman.index', compact('pengumuman'))
            ->layout('layouts.admin');
    }
}
