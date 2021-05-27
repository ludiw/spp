<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Verify extends Component
{
    public function resend()
    {
        if (Auth::user()->hasVerifiedEmail()) {
            redirect(route('dashboard'));
        }

        Auth::user()->sendEmailVerificationNotification();

        $this->emit('resent');
    }

    public function render()
    {
        return view('livewire.auth.verify')->extends('layouts.auth', ['title' => 'Halaman Verifikasi Password']);
    }
}
