<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;
    
    public function render()
    {
        return view('livewire.login');
    }

    public function loginUser(Request $request)
    {

        $validate=$this->validate([
            'email'=>'required|email|max:225',
            'password'=>'required|max:225'
        ]);

        if(Auth::attempt($validate)){
            $request->session()->regenerate();

            return $this->redirect('/customers',navigate:true);
        }

        $this->addError('email','the password provided does not match the email');
    }

    
}
