<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer;

class EditCustomer extends Component
{
    public $customer;
    public $name;
    public $email;
    public $phone;

    public function mount(Customer $customer){
        $this->customer=$customer;
        $this->name=$customer->name;
        $this->email=$customer->email;
        $this->phone=$customer->phone;
    }

    public function render()
    {
        return view('livewire.edit-customer');
    }

    public function UpdateCustomer(){
        $validate=$this->validate([
            'name'=>'required|max:225',
            'email'=>'required|email|max:225',
            'phone'=>'required|max:225'
        ]);
        
        $this->customer->update($validate);
        session()->flash('success','Customer Updated successfully');
        return $this->redirect('/customers',navigate:true);
    }
}
