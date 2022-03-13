<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Brand;
use Livewire\Component;
use App\Models\Category;
use App\Http\Controllers\Admin\ProductController;

class NewProduct extends Component{
    public $name;
    public $description;
    public $stock_min;
    public $status;
    public $category_id;
    public $brand_id;

    protected $listeners=[
        'render',
    ];

    protected $rules = [
        'name' => 'required|string',
        'description' => 'string',
        'stock_min' => 'numeric',
        'status' => 'boolean',
        // 'category_id' => 'required',
        // 'brand_id' => 'required',
    ];
    protected $messages = [
        'name.required' => 'Ingresa nombre',
        // 'category_id.required' => 'Selecciona categoria',
        // 'brand_id.required' => 'Selecciona Marca',
    ];
    
    public function mount(){
        $this->description="";
        $this->stock_min='';
        $this->status=true;
        $this->category_id=null;
        $this->brand_id=null;

    }
    
    public function render(){
        $categories = Category::all();
        $brands = Brand::all();
        return view('livewire.admin.products.new-product',compact('categories','brands'));
    }

    public function createProduct($name, $description, $stock_min, $status, $category_id, $brand_id){
        
        if($stock_min==""){
            $stock_min=0;
        }
        $this->validate();
        $productController = new ProductController();

        $response =   $productController->create([
             'name' => $name,
             'description' => $description,
             'stock_min' => $stock_min,
             'status' => $status,
             'category_id' => $category_id,
             'brand_id' => $brand_id,
        ]);
        $this->emit('render');
        $this->emit('updateProducts', $name);
        return $response;

       

    }

    
}
