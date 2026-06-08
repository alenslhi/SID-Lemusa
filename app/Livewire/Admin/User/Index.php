<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Domain\User\Models\User;
use Illuminate\Support\Facades\Hash;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    
    // Form fields
    public $isModalOpen = false;
    public $editId = null;
    public $name;
    public $email;
    public $password;

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->editId,
        ];

        if (!$this->editId) {
            $rules['password'] = 'required|min:8';
        } else {
            $rules['password'] = 'nullable|min:8';
        }

        return $rules;
    }

    public function openModal()
    {
        $this->resetValidation();
        $this->editId = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->isModalOpen = true;
    }

    public function editModal($id)
    {
        $this->resetValidation();
        $this->editId = $id;

        $user = User::findOrFail($id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = ''; // Biarkan kosong

        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->editId = null;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->editId) {
            User::findOrFail($this->editId)->update($data);
            session()->flash('success', 'User berhasil diperbarui.');
        } else {
            User::create($data);
            session()->flash('success', 'User berhasil ditambahkan.');
        }

        $this->closeModal();
    }

    public function delete($id)
    {
        if ($id == auth()->id()) {
            session()->flash('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
            return;
        }
        User::findOrFail($id)->delete();
        session()->flash('success', 'User berhasil dihapus.');
    }

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.user.index', compact('users'))
            ->layout('layouts.admin');
    }
}
