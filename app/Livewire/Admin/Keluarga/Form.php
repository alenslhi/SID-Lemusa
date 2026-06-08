<?php

namespace App\Livewire\Admin\Keluarga;

use Livewire\Component;
use App\Domain\Keluarga\Models\Keluarga;
use App\Domain\Penduduk\Models\Penduduk;
use App\Domain\Dusun\Models\Dusun;

class Form extends Component
{
    public ?Keluarga $keluarga = null;
    public $isEdit = false;

    // Form Fields
    public $nomor_kk;
    public $kepala_keluarga_id;
    public $alamat;
    public $rt;
    public $rw;
    public $kode_pos;
    public $dusun_id;

    public function mount($id = null)
    {
        if ($id) {
            $this->isEdit = true;
            $this->keluarga = Keluarga::findOrFail($id);
            $this->fill($this->keluarga->toArray());
        }
    }

    protected function rules()
    {
        $id = $this->keluarga ? $this->keluarga->id : '';
        return [
            'nomor_kk' => 'required|numeric|digits:16|unique:keluarga,nomor_kk,' . $id,
            'kepala_keluarga_id' => 'required|exists:penduduk,id',
            'alamat' => 'required|string|max:255',
            'rt' => 'required|string|max:5',
            'rw' => 'required|string|max:5',
            'kode_pos' => 'nullable|string|max:10',
            'dusun_id' => 'required|exists:dusun,id',
        ];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'nomor_kk' => $this->nomor_kk,
            'kepala_keluarga_id' => $this->kepala_keluarga_id,
            'alamat' => $this->alamat,
            'rt' => $this->rt,
            'rw' => $this->rw,
            'kode_pos' => $this->kode_pos,
            'dusun_id' => $this->dusun_id,
        ];

        if ($this->isEdit) {
            $this->keluarga->update($data);
            session()->flash('success', 'Data keluarga berhasil diperbarui.');
        } else {
            Keluarga::create($data);
            session()->flash('success', 'Data keluarga berhasil ditambahkan.');
        }

        return redirect()->route('desa.keluarga.index');
    }

    public function render()
    {
        return view('livewire.admin.keluarga.form', [
            'pendudukList' => Penduduk::all(),
            'dusunList' => Dusun::all(),
        ])->layout('layouts.admin');
    }
}
