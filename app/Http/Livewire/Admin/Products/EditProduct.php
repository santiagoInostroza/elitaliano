<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;

class EditProduct extends Component{
    public $product;

    protected $listeners=[
        'render',
    ];

    protected $rules = [
        'product.name' => 'required|string',
        'product.description' => 'nullable|string',
        'product.stock_min' => 'sometimes|nullable|numeric',
        'product.status' => 'boolean',
        'product.category_id' => 'required',
        'product.brand_id' => 'required',
    ];
    protected $messages = [
        'product.name.required' => 'Debes ingresar un nombre',
        'category_id.required' => 'Selecciona categoria',
        'brand_id.required' => 'Selecciona Marca',
    ];

    public function render(){

        $categories = Category::all();
        $brands = Brand::all();
       
        return view('livewire.admin.products.edit-product',compact('categories','brands'));
    }

    public function save(){
        if($this->product->stock_min==""){
            $this->product->stock_min=0;
        }
        $this->validate();
        $this->product->save();
        $this->emitUp('closeEditProduct');
        $this->dispatchBrowserEvent('toast', ['title' => "Producto editado correctamente!!"]);
    }
}
