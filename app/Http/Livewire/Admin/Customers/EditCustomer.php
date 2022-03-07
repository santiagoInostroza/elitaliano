<?php

namespace App\Http\Livewire\Admin\Customers;

use Livewire\Component;

class EditCustomer extends Component{

    public $customer;
    protected $rules=[
        'customer.name' => 'required',
        'customer.address' => 'sometimes|nullable|string',
        'customer.cel' => 'sometimes|nullable|string',
        'customer.comment' => 'sometimes|nullable|string',
    ];

    public function render(){
        return view('livewire.admin.customers.edit-customer');
    }
    public function saveCustomer(){
        $this->validate();
        $this->customer->save();
        $this->emitUp('render');
        $this->emitUp('closeEditCustomer');
        $this->dispatchBrowserEvent('toast', ['title' => 'Cliente editado', 'icon' => 'success',]);
        return true;
    }
}
