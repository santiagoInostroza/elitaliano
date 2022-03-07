<?php

namespace App\Http\Livewire\Admin\Suppliers;

use Livewire\Component;
use App\Models\Supplier;
use Illuminate\Support\Str;

class NewSupplier extends Component{
    public $name;

    protected $rules = [
        'name' => 'required',
    ];
    protected $messages = [
        'name.required' => 'Ingresa nombre del proveedor',
    ];

    
    public function render(){

        return view('livewire.admin.suppliers.new-supplier');
    }

    public function saveSupplier($name, $address, $rut, $rs, $comment){
        $this->validate();
        
        $supplier =  Supplier::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'address' => $address,
            'rut' => $rut,
            'rs' => $rs,
            'comment' => $comment,
        ]);
      
       $this->emitUp('render');
       $this->emitUp('saveSupplierId', $supplier->id);
       return true;
    }
}
