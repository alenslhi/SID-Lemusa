<?php

namespace App\Livewire\Admin\Surat;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Domain\Surat\Models\PengajuanSurat;
use App\Domain\Master\Models\StatusSurat;

class Form extends Component
{
    use WithFileUploads;

    public PengajuanSurat $surat;
    public $status_surat_id;
    public $file_dokumen; // Untuk upload dokumen yang sudah di-TTD

    public function mount($id)
    {
        $this->surat = PengajuanSurat::with(['penduduk', 'jenisSurat'])->findOrFail($id);
        $this->status_surat_id = $this->surat->status_surat_id;
    }

    protected function rules()
    {
        return [
            'status_surat_id' => 'required|exists:status_surat,id',
            'file_dokumen' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'status_surat_id' => $this->status_surat_id,
        ];

        if ($this->file_dokumen) {
            $path = $this->file_dokumen->store('surat_selesai', 'public');
            $data['file_dokumen'] = $path;
        }

        $this->surat->update($data);

        session()->flash('success', 'Status pengajuan surat berhasil diperbarui.');
        return redirect()->route('desa.surat.index');
    }

    public function render()
    {
        return view('livewire.admin.surat.form', [
            'statusList' => StatusSurat::all(),
        ])->layout('layouts.admin');
    }
}
