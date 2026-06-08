<?php

namespace App\Livewire\Admin\Agenda;

use Livewire\Component;
use App\Domain\Agenda\Models\Agenda;

class Form extends Component
{
    public ?Agenda $agenda = null;
    public $isEdit = false;

    public $judul;
    public $deskripsi;
    public $tanggal;
    public $jam;
    public $lokasi;

    public function mount($id = null)
    {
        if ($id) {
            $this->isEdit = true;
            $this->agenda = Agenda::findOrFail($id);
            $this->judul = $this->agenda->judul;
            $this->deskripsi = $this->agenda->deskripsi;
            $this->tanggal = $this->agenda->tanggal_mulai?->format('Y-m-d');
            $this->jam = $this->agenda->tanggal_mulai?->format('H:i');
            $this->lokasi = $this->agenda->lokasi;
        }
    }

    protected function rules()
    {
        return [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'lokasi' => 'required|string|max:255',
        ];
    }

    public function save()
    {
        $this->validate();

        $dateTime = \Carbon\Carbon::parse($this->tanggal . ' ' . $this->jam);

        $data = [
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'tanggal_mulai' => $dateTime,
            'tanggal_selesai' => $dateTime->copy()->addHours(2),
            'lokasi' => $this->lokasi,
        ];

        if ($this->isEdit) {
            $this->agenda->update($data);
            session()->flash('success', 'Agenda berhasil diperbarui.');
        } else {
            Agenda::create($data);
            session()->flash('success', 'Agenda berhasil ditambahkan.');
        }

        return redirect()->route('desa.agenda.index');
    }

    public function render()
    {
        return view('livewire.admin.agenda.form')->layout('layouts.admin');
    }
}
