<?php

namespace App\Http\Livewire\Admin\PurchaseItem;

use App\Models\PurchaseItem;
use Livewire\Component;

class Index extends Component{

    public $item;
    public $purchaseItems;
    public $quantity;
    public $quantityBox;
    public $totalQuantity;
    public $price;
    public $priceBox;
    public $totalPrice;
    public $stock;


    public function mount(){
        $this->purchaseItems = new PurchaseItem();        
    }


    protected $rules=[
        'quantity' =>'required',
        'quantityBox'=>'required',
        'totalQuantity'=>'required',
        'price'=>'required',
        'priceBox'=>'required', 
        'totalPrice'=>'required',
        'stock'=>'required', 
    ];

    public function render(){
        return view('livewire.admin.purchase-item.index');
    }

    public function valid(){
        $this->validate();
    }
}
