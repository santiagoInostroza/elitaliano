<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;

class Index extends Component{
    public $editProduct;
    public $editProductSelected;
   

    protected $listeners=[
        'render',
        'editProduct',
        'closeEditProduct',
    ];

    public function mount(){
        $this->editProduct=false;
        $this->editProductSelected=null;

        
    }

    public function render(){

        $products = Product::all();


        return view('livewire.admin.products.index',compact('products'));
    }

    public function editProduct(Product $product = null){
        if ($product) {
            $this->editProduct= true;
            $this->editProductSelected= $product; 
        }
    }

    public function closeEditProduct(){
        $this->editProduct= false;
        $this->editProductSelected= null; 
    }
   
}
