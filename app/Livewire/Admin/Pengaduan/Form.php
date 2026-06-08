<?php

namespace App\Livewire\Admin\Pengaduan;

use Livewire\Component;
use App\Domain\Pengaduan\Models\Pengaduan;

class Form extends Component
{
    public Pengaduan $pengaduan;
    
    // Form Fields
    public $status;
    public $tanggapan;

    public function mount($id)
    {
        $this->pengaduan = Pengaduan::with(['penduduk', 'kategoriPengaduan'])->findOrFail($id);
        $this->status = $this->pengaduan->status;
        $this->tanggapan = $this->pengaduan->tanggapan;
    }

    protected $rules = [
        'status' => 'required|in:baru,proses,selesai',
        'tanggapan' => 'nullable|string',
    ];

    public function save()
    {
        $this->validate();

        $this->pengaduan->update([
            'status' => $this->status,
            'tanggapan' => $this->tanggapan,
        ]);

        session()->flash('success', 'Tanggapan pengaduan berhasil disimpan.');
        return redirect()->route('desa.pengaduan.index');
    }

    public function render()
    {
        return view('livewire.admin.pengaduan.form')->layout('layouts.admin');
    }
}
