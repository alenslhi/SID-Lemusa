<?php

namespace App\Livewire\Admin\Profil;

use Livewire\Component;
use App\Domain\ProfilDesa\Models\ProfilDesa;

class Index extends Component
{
    public $profil;

    public $nama_desa;
    public $sejarah;
    public $visi;
    public $misi;
    public $alamat;
    public $email;
    public $telepon;
    public $maps_embed;
    public $sambutan_kepala_desa;

    public function mount()
    {
        $this->profil = ProfilDesa::first();
        if ($this->profil) {
            $this->nama_desa = $this->profil->nama_desa;
            $this->sejarah = $this->profil->sejarah;
            $this->visi = $this->profil->visi;
            $this->misi = $this->profil->misi;
            $this->alamat = $this->profil->alamat;
            $this->email = $this->profil->email;
            $this->telepon = $this->profil->telepon;
            $this->maps_embed = $this->profil->maps_embed;
            $this->sambutan_kepala_desa = $this->profil->sambutan_kepala_desa;
        }
    }

    protected function rules()
    {
        return [
            'nama_desa' => 'required|string|max:255',
            'sejarah' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'alamat' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:50',
            'maps_embed' => 'nullable|string',
            'sambutan_kepala_desa' => 'nullable|string',
        ];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'nama_desa' => $this->nama_desa,
            'sejarah' => $this->sejarah,
            'visi' => $this->visi,
            'misi' => $this->misi,
            'alamat' => $this->alamat,
            'email' => $this->email,
            'telepon' => $this->telepon,
            'maps_embed' => $this->maps_embed,
            'sambutan_kepala_desa' => $this->sambutan_kepala_desa,
        ];

        if ($this->profil) {
            $this->profil->update($data);
        } else {
            $this->profil = ProfilDesa::create($data);
        }

        session()->flash('success', 'Profil Desa berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.admin.profil.index')->layout('layouts.admin');
    }
}
