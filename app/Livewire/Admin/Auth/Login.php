<?php

namespace App\Livewire\Admin\Auth;

use Livewire\Component;

class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;
    public bool $submitted = false;
    public string $error = '';

    public function login(): void
{
    $this->submitted = true;
    $this->resetErrorBag();

    $validated = $this->validate([
        'email'    => 'required|email',
        'password' => 'required|min:6',
    ]);

    if (!auth('admin')->attempt([
        'email'     => $validated['email'],
        'password'  => $validated['password'],
        'is_active' => true,
    ], $this->remember)) {
        $this->error = 'Invalid credentials or account is inactive.';
        return;
    }

    $this->redirect(route('admin.dashboard'), navigate: true);
}

    public function render()
    {
        return view('livewire.admin.auth.login');
    }
}