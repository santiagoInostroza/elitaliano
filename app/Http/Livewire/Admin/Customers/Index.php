<?php

namespace App\Http\Livewire\Admin\Customers;

use Livewire\Component;
use App\Models\Customer;

class Index extends Component{
    public $isOpenEditCustomer;
    public $isOpenDeleteCustomer;
    public $supplierCustomer;

   

    protected $listeners=[
        'render',
        'editCustomer',
        'closeEditCustomer',
    ];

    public function mount(){
        $this->isOpenEditCustomer=false;
        $this->isOpenDeleteCustomer=false;
        $this->editSupplierSelected=null;

        
    }


    public function render(){        
        
        return view('livewire.admin.customers.index',[
            'customers' => Customer::all(),
        ]);
    }

    public function openEditCustomer(Customer $customer){
        $this->isOpenEditCustomer=true;
        $this->customerSelected=$customer;
    }
    public function openDeleteCustomer(Customer $customer){
        $this->isOpenDeleteCustomer=true;
        $this->customerSelected=$customer;
    }

    public function closeEditCustomer(){
        $this->isOpenEditCustomer=false;
    }

    public function deleteCustomer(){
        $this->customerSelected->delete();
        $this->isOpenDeleteCustomer=false;
        $this->dispatchBrowserEvent('toast',['title'=>'Cliente eliminado']);
    }


}
