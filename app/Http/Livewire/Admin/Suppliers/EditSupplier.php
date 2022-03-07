<?php

namespace App\Http\Livewire\Admin\Suppliers;

use Livewire\Component;

class EditSupplier extends Component{

    public $supplier;
    protected $rules=[
        'supplier.name' => 'required',
        'supplier.address' => 'sometimes|nullable|string',
        'supplier.rut' => 'sometimes|nullable|string',
        'supplier.rs' => 'sometimes|nullable|string',
        'supplier.comment' => 'sometimes|nullable|string',
    ];

    public function render(){
        return view('livewire.admin.suppliers.edit-supplier');
    }

    public function saveSupplier(){
        $this->validate();
        $this->supplier->save();
        $this->emitUp('render');
        $this->emitUp('closeEditSupplier');
        $this->dispatchBrowserEvent('toast', ['title' => 'Proveedor editado', 'icon' => 'success',]);
        return true;
    }
}
