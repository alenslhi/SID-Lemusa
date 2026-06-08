<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();
            
            // Redirect based on role
            $user = Auth::user();
            if ($user->hasRole('Warga')) {
                return redirect()->route('citizen.dashboard');
            } else {
                return redirect()->route('desa.dashboard');
            }
        }

        $this->addError('email', 'Kredensial yang diberikan tidak cocok dengan catatan kami.');
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.guest');
    }
}
