<?php

namespace App\Livewire\Admin\Pengumuman;

use Livewire\Component;
use App\Domain\Pengumuman\Models\Pengumuman;

class Form extends Component
{
    public ?Pengumuman $pengumuman = null;
    public $isEdit = false;

    public $judul;
    public $isi;
    public $status = 'draft';

    public function mount($id = null)
    {
        if ($id) {
            $this->isEdit = true;
            $this->pengumuman = Pengumuman::findOrFail($id);
            $this->judul = $this->pengumuman->judul;
            $this->isi = $this->pengumuman->isi;
            $this->status = $this->pengumuman->status;
        }
    }

    protected function rules()
    {
        return [
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:draft,publish',
        ];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'judul' => $this->judul,
            'isi' => $this->isi,
            'status' => $this->status,
        ];

        if ($this->isEdit) {
            $this->pengumuman->update($data);
            session()->flash('success', 'Pengumuman berhasil diperbarui.');
        } else {
            $data['penulis_id'] = auth()->id();
            Pengumuman::create($data);
            session()->flash('success', 'Pengumuman berhasil ditambahkan.');
        }

        return redirect()->route('desa.pengumuman.index');
    }

    public function render()
    {
        return view('livewire.admin.pengumuman.form')->layout('layouts.admin');
    }
}
