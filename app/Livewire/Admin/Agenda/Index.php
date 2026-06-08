<?php

namespace App\Livewire\Admin\Agenda;

use Livewire\Component;
use Livewire\WithPagination;
use App\Domain\Agenda\Models\Agenda;

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
        Agenda::findOrFail($id)->delete();
        session()->flash('success', 'Agenda berhasil dihapus.');
    }

    public function render()
    {
        $agenda = Agenda::where('judul', 'like', '%' . $this->search . '%')
            ->orderBy('tanggal_mulai', 'desc')
            ->paginate(10);

        return view('livewire.admin.agenda.index', compact('agenda'))
            ->layout('layouts.admin');
    }
}
