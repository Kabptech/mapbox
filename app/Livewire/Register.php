<?php

namespace App\Livewire;

use Livewire\Component;
use illuminate\Support\Facades\Auth;
use App\Models\User;

class Register extends Component
{
    public $name;
    public $email;
    public $password;

    public function render()
    {
        return view('livewire.register');
    }

    public function storeUser(){
        $validate=$this->validate([
            'name'=>'required|max:225',
            'email'=>'required|email|unique:users|max:225',
            'password'=>'required|min:8|unique:users|max:225'
        ]);
        $user=User::create([
            'name'=>$this->name,
            'email'=>$this->email,
            'password'=>bcrypt($this->password),
        ]);
        Auth::login($user);
      
        session()->flash('success','registration successful');
        return $this->redirect('/login',navigate:true);

    }
}
