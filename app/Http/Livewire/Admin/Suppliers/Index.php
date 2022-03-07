<?php

namespace App\Http\Livewire\Admin\Suppliers;

use App\Http\Controllers\Admin\SupplierController;
use Livewire\Component;
use App\Models\Supplier;

class Index extends Component{

    public $isOpenEditSupplier;
    public $isOpenDeleteSupplier;
    public $supplierSelected;

   

    protected $listeners=[
        'render',
        'editSupplier',
        'closeEditSupplier',
    ];

    public function mount(){
        $this->isOpenEditSupplier=false;
        $this->isOpenDeleteSupplier=false;
        $this->editSupplierSelected=null;

        
    }
    
    public function render(){

        return view('livewire.admin.suppliers.index',[
            'suppliers' => Supplier::all(),
        ]);
    }

    public function openEditSupplier(Supplier $supplier){
        $this->isOpenEditSupplier=true;
        $this->supplierSelected=$supplier;
    }
    public function openDeleteSupplier(Supplier $supplier){
        $this->isOpenDeleteSupplier=true;
        $this->supplierSelected=$supplier;
    }

    public function closeEditSupplier(){
        $this->isOpenEditSupplier=false;
    }

    public function deleteSupplier(){
        $this->supplierSelected->delete();
        $this->isOpenDeleteSupplier=false;
        $this->dispatchBrowserEvent('toast',['title'=>'Proveedor eliminado']);
    }
   



  
}
