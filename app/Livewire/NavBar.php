<?php

namespace App\Livewire;

use Livewire\Component;
use illuminate\Http\Request;
use App\Models\User;
use illuminate\Support\Facades\Auth;

class NavBar extends Component
{
    public function render()
    {
        return view('livewire.nav-bar');
    }

    public function logout(Request $request){
        Auth::logout();
        //$request->session()->invalidate();
        //$request->session()->regenerateToken();
        return $this->redirect('/login',navigate:true);


    }
}
