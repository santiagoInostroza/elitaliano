<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Customer;
use App\Models\Product;
use Livewire\Component;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Sale;
use App\Models\Supplier;

class Index extends Component{
    public $stock ;

    public function mount(){
        $this->stock = 0; 
    }

    public function render(){

        $productWithStock = PurchaseItem::where('stock','>',0)->get();
      

        $productWithStock->map(function($item){
            $this->stock+= $item->stock * $item->price;
           
        });
        
        return view('livewire.admin.dashboard.index',[
            'purchases'=>Purchase::all(),
            'purchase_items'=>PurchaseItem::all(),
            'supplier'=>Supplier::all(),
            'products'=>Product::all(),
            'customers'=>Customer::all(),
            'sales'=>Sale::all(),
        ]);
    }
}
