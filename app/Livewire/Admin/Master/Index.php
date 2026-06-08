<?php

namespace App\Livewire\Admin\Master;

use Livewire\Component;
use App\Domain\Penduduk\Models\Agama;
use App\Domain\Penduduk\Models\Pekerjaan;
use App\Domain\Penduduk\Models\Pendidikan;
use App\Domain\Penduduk\Models\StatusPerkawinan;
use App\Domain\Dusun\Models\Dusun;
use Livewire\Attributes\Url;

class Index extends Component
{
    #[Url]
    public $activeTab = 'dusun';

    public $search = '';

    // Modals
    public $isModalOpen = false;
    public $editId = null;
    
    // Form fields
    public $nama;
    public $kepala_dusun; // Khusus dusun

    public function updatingSearch()
    {
        // Reset pagination later if using WithPagination, for now simple all() due to small data size
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
        $this->search = '';
        $this->closeModal();
    }

    protected function rules()
    {
        $rules = [
            'nama' => 'required|string|max:255',
        ];

        if ($this->activeTab === 'dusun') {
            $rules['kepala_dusun'] = 'nullable|string|max:255';
        }

        return $rules;
    }

    public function openModal()
    {
        $this->resetValidation();
        $this->editId = null;
        $this->nama = '';
        $this->kepala_dusun = '';
        $this->isModalOpen = true;
    }

    public function editModal($id)
    {
        $this->resetValidation();
        $this->editId = $id;

        $model = $this->getModel()::findOrFail($id);
        $this->nama = $model->nama;
        if ($this->activeTab === 'dusun') {
            $this->kepala_dusun = $model->kepala_dusun;
        }

        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->editId = null;
        $this->nama = '';
        $this->kepala_dusun = '';
    }

    private function getModel()
    {
        return match($this->activeTab) {
            'agama' => Agama::class,
            'pekerjaan' => Pekerjaan::class,
            'pendidikan' => Pendidikan::class,
            'status_perkawinan' => StatusPerkawinan::class,
            'dusun' => Dusun::class,
            default => Dusun::class,
        };
    }

    public function save()
    {
        $this->validate();

        $data = ['nama' => $this->nama];
        if ($this->activeTab === 'dusun') {
            $data['kepala_dusun'] = $this->kepala_dusun;
        }

        $modelClass = $this->getModel();

        if ($this->editId) {
            $modelClass::findOrFail($this->editId)->update($data);
            session()->flash('success', 'Data berhasil diperbarui.');
        } else {
            $modelClass::create($data);
            session()->flash('success', 'Data berhasil ditambahkan.');
        }

        $this->closeModal();
    }

    public function delete($id)
    {
        $this->getModel()::findOrFail($id)->delete();
        session()->flash('success', 'Data berhasil dihapus.');
    }

    public function render()
    {
        $modelClass = $this->getModel();
        $query = $modelClass::query();
        
        if ($this->search) {
            $query->where('nama', 'like', '%' . $this->search . '%');
        }

        $data = $query->orderBy('id', 'desc')->get(); // Mengambil semua data karena master data biasanya sedikit

        return view('livewire.admin.master.index', [
            'data' => $data,
        ])->layout('layouts.admin');
    }
}
