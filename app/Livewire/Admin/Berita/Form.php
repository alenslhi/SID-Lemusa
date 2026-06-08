<?php

namespace App\Livewire\Admin\Berita;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Domain\Berita\Models\Berita;
use Illuminate\Support\Str;

class Form extends Component
{
    use WithFileUploads;

    public ?Berita $berita = null;
    public $isEdit = false;

    public $judul;
    public $isi;
    public $gambar;
    public $gambarLama;

    public function mount($id = null)
    {
        if ($id) {
            $this->isEdit = true;
            $this->berita = Berita::findOrFail($id);
            $this->judul = $this->berita->judul;
            $this->isi = $this->berita->isi;
            $this->gambarLama = $this->berita->thumbnail;
        }
    }

    protected function rules()
    {
        return [
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => $this->isEdit ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'judul' => $this->judul,
            'slug' => Str::slug($this->judul),
            'isi' => $this->isi,
            'published_by' => auth()->id(),
            'published_at' => now(),
        ];

        if ($this->gambar) {
            $path = $this->gambar->store('berita', 'public');
            $data['thumbnail'] = $path;
        }

        if ($this->isEdit) {
            $this->berita->update($data);
            session()->flash('success', 'Berita berhasil diperbarui.');
        } else {
            Berita::create($data);
            session()->flash('success', 'Berita berhasil diterbitkan.');
        }

        return redirect()->route('desa.berita.index');
    }

    public function render()
    {
        return view('livewire.admin.berita.form')
            ->layout('layouts.admin');
    }
}
