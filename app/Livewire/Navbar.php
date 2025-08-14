<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Navbar extends Component
{
    public $showModal = false;

    public function render()
    {
        return view('livewire.navbar');
    }

    public function logout(Request $request)
    {
        Auth::logout();


        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
     public $isOpen = false;

    public function toggleDropdown()
    {
        $this->isOpen = !$this->isOpen;
    }
}
