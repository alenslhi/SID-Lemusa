<?php

namespace App\Livewire\Admin\Galeri;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Domain\Galeri\Models\Galeri;

class Form extends Component
{
    use WithFileUploads;

    public ?Galeri $galeri = null;
    public $isEdit = false;

    public $judul;
    public $deskripsi;
    public $file_path;
    public $fileLama;
    public $status = 'draft';

    public function mount($id = null)
    {
        if ($id) {
            $this->isEdit = true;
            $this->galeri = Galeri::findOrFail($id);
            $this->judul = $this->galeri->judul;
            $this->deskripsi = $this->galeri->deskripsi;
            $this->status = $this->galeri->status;
            $this->fileLama = $this->galeri->file_path;
        }
    }

    protected function rules()
    {
        return [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:draft,publish',
            'file_path' => $this->isEdit ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'status' => $this->status,
        ];

        if ($this->file_path) {
            $path = $this->file_path->store('galeri', 'public');
            $data['file_path'] = $path;
        }

        if ($this->isEdit) {
            $this->galeri->update($data);
            session()->flash('success', 'Foto galeri berhasil diperbarui.');
        } else {
            $data['pengunggah_id'] = auth()->id();
            Galeri::create($data);
            session()->flash('success', 'Foto berhasil diunggah ke galeri.');
        }

        return redirect()->route('desa.galeri.index');
    }

    public function render()
    {
        return view('livewire.admin.galeri.form')->layout('layouts.admin');
    }
}
