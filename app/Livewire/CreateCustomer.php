<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer;

class CreateCustomer extends Component
{
    public $name='';
    public $email='';
    public $phone='';

    public function render()
    {
        return view('livewire.create-customer');
    }

    public function save(){
        $validate=$this->validate([
            'name'=>'required|max:225',
            'email'=>'required|email|unique:customers|max:225',
            'phone'=>'required|unique:customers|max:225'
        ]);
        Customer::create($validate);
        //$this->reset();
        session()->flash('success','Customer Created successfully');
        return $this->redirect('/customers',navigate:true);
    }
}
