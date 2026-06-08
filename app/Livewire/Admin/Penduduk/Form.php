<?php

namespace App\Livewire\Admin\Penduduk;

use Livewire\Component;
use App\Domain\Penduduk\Models\Penduduk;
use App\Domain\Keluarga\Models\Keluarga;
use App\Domain\Penduduk\Models\Agama;
use App\Domain\Penduduk\Models\Pendidikan;
use App\Domain\Penduduk\Models\Pekerjaan;
use App\Domain\Penduduk\Models\StatusPerkawinan;
use App\Domain\Dusun\Models\Dusun;
use App\Domain\Penduduk\Enums\JenisKelamin;

class Form extends Component
{
    public ?Penduduk $penduduk = null;
    public $isEdit = false;

    // Form Fields
    public $nik;
    public $nama_lengkap;
    public $keluarga_id;
    public $dusun_id;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $jenis_kelamin;
    public $agama_id;
    public $pendidikan_id;
    public $pekerjaan_id;
    public $golongan_darah;
    public $status_perkawinan_id;
    public $status_hubungan_dalam_keluarga;
    public $kewarganegaraan = 'WNI';
    public $no_paspor;
    public $no_kitap;
    public $nama_ayah;
    public $nama_ibu;
    public $no_hp;
    public $email;
    public $status_penduduk = 'aktif';

    public function mount($id = null)
    {
        if ($id) {
            $this->isEdit = true;
            $this->penduduk = Penduduk::findOrFail($id);
            $this->fill($this->penduduk->toArray());
            $this->jenis_kelamin = $this->penduduk->jenis_kelamin->value ?? $this->penduduk->jenis_kelamin;
        }
    }

    protected function rules()
    {
        $id = $this->penduduk ? $this->penduduk->id : '';
        return [
            'nik' => 'required|numeric|digits:16|unique:penduduk,nik,' . $id,
            'nama_lengkap' => 'required|string|max:255',
            'keluarga_id' => 'nullable|exists:keluarga,id',
            'dusun_id' => 'nullable|exists:dusun,id',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama_id' => 'required|exists:agama,id',
            'pendidikan_id' => 'required|exists:pendidikan,id',
            'pekerjaan_id' => 'required|exists:pekerjaan,id',
            'golongan_darah' => 'nullable|string|max:5',
            'status_perkawinan_id' => 'required|exists:status_perkawinan,id',
            'status_hubungan_dalam_keluarga' => 'required|string|max:50',
            'kewarganegaraan' => 'required|in:WNI,WNA',
            'no_paspor' => 'nullable|string|max:50',
            'no_kitap' => 'nullable|string|max:50',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'status_penduduk' => 'required|in:aktif,pindah,meninggal,hilang',
        ];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'nik' => $this->nik,
            'nama_lengkap' => $this->nama_lengkap,
            'keluarga_id' => $this->keluarga_id ?: null,
            'dusun_id' => $this->dusun_id ?: null,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'agama_id' => $this->agama_id,
            'pendidikan_id' => $this->pendidikan_id,
            'pekerjaan_id' => $this->pekerjaan_id,
            'golongan_darah' => $this->golongan_darah,
            'status_perkawinan_id' => $this->status_perkawinan_id,
            'status_hubungan_dalam_keluarga' => $this->status_hubungan_dalam_keluarga,
            'kewarganegaraan' => $this->kewarganegaraan,
            'no_paspor' => $this->no_paspor,
            'no_kitap' => $this->no_kitap,
            'nama_ayah' => $this->nama_ayah,
            'nama_ibu' => $this->nama_ibu,
            'no_hp' => $this->no_hp,
            'email' => $this->email,
            'status_penduduk' => $this->status_penduduk,
        ];

        if ($this->isEdit) {
            $this->penduduk->update($data);
            session()->flash('success', 'Data penduduk berhasil diperbarui.');
        } else {
            Penduduk::create($data);
            session()->flash('success', 'Data penduduk berhasil ditambahkan.');
        }

        return redirect()->route('desa.penduduk.index');
    }

    public function render()
    {
        return view('livewire.admin.penduduk.form', [
            'keluargaList' => Keluarga::with('kepalaKeluarga')->get(),
            'dusunList' => Dusun::all(),
            'agamaList' => Agama::all(),
            'pendidikanList' => Pendidikan::all(),
            'pekerjaanList' => Pekerjaan::all(),
            'statusPerkawinanList' => StatusPerkawinan::all(),
        ])->layout('layouts.admin');
    }
}
