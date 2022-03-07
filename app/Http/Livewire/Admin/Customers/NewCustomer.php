<?php

namespace App\Http\Livewire\Admin\Customers;

use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Str;

class NewCustomer extends Component{

    public $name;

    protected $rules = [
        'name' => 'required',
    ];
    protected $messages = [
        'name.required' => 'Ingresa nombre del cliente',
    ];


    public function render(){
        return view('livewire.admin.customers.new-customer');
    }

    public function saveCustomer($name, $address, $cel, $comment){
        $this->validate();
        
        $customer =  Customer::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'address' => $address,
            'cel' => $cel,
            'comment' => $comment,
        ]);
      
       $this->emitUp('render');
       $this->emitUp('saveCustomerId', $customer->id);
       return true;
    }
}
