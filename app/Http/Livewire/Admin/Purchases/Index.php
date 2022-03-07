<?php

namespace App\Http\Livewire\Admin\Purchases;

use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Support\Str;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PurchaseController;

class Index extends Component{

    public $openNewPurchase;
    public $openShowPurchase;
    public $openEditPurchase;
    public $openDeletePurchase;

    public $purchaseSelected;
   
    protected $listeners=[
        'render',
        'setPurchase',
        'closeNewPurchase',
        'closeEditPurchase',
        'closeShowPurchase',
        'closeDeletePurchase',
    ];

    public function mount(){
        $this->openNewPurchase = false;
        $this->openShowPurchase = false;
        $this->openEditPurchase = false;
        $this->openDeletePurchase = false;
    }

    public function render(){
       
        return view('livewire.admin.purchases.index',[
            'purchases'=>Purchase::with('purchaseItems')->orderBy('id','desc')->get(),
            'products'=>Product::all()
        ]);
    }

    public function setPurchase(Purchase $purchase){
        $this->purchaseSelected = $purchase;
    }

    public function deletePurchase(){

        $purchaseController = new PurchaseController();
        $purchaseController->destroy($this->purchaseSelected);      
        $this->closeDeletePurchase();
        $this->dispatchBrowserEvent('toast', ['title' => 'Compra eliminada', 'icon' => 'success',]);
    }

    public function closeNewPurchase(){
       $this->openNewPurchase = false;
    }
    public function closeEditPurchase(){
       $this->openEditPurchase = false;
    }
    public function closeShowPurchase(){
       $this->openShowPurchase = false;
    }
    public function closeDeletePurchase(){
       $this->openDeletePurchase = false;
    }

 

    
}
