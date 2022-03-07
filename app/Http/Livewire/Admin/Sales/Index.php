<?php

namespace App\Http\Livewire\Admin\Sales;

use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;
use App\Http\Controllers\Admin\SaleController;

class Index extends Component{

    public $isOpenNewSale;
    public $isOpenShowSale;
    public $isOpenEditSale;
    public $isOpenDeleteSale;

    public $saleSelected;
   
    protected $listeners=[
        'render',
        'setPurchase',
        'closeNewSale',
        'closeShowSale',
        'closeDeleteSale',
    ];

    public function mount(){
        $this->isOpenNewSale = false;
        $this->isOpenShowSale = false;
        $this->isOpenDeleteSale = false;

       
        
    }

    public function render(){

        if (session()->has('message')) {
            $this->dispatchBrowserEvent('toast', ['title' => 'Venta editada!', 'icon' => 'success']);
        }    
       
        return view('livewire.admin.sales.index',[
            'sales'=>Sale::orderBy('id','desc')->get(),
            'products'=>Product::all()
        ]);
    }

    public function setSale(Sale $sale){
        $this->saleSelected = $sale;
    }

    public function deleteSale(){

        $saleController = new SaleController();
        $saleController->destroy($this->saleSelected);      
        $this->closeDeleteSale();
        $this->dispatchBrowserEvent('toast', ['title' => 'Venta eliminada', 'icon' => 'success',]);
    }

    public function closeNewSale(){
       $this->isOpenNewSale = false;
    }
    public function closeShowSale(){
       $this->isOpenShowSale = false;
    }
    public function closeDeleteSale(){
       $this->isOpenDeleteSale = false;
    }

}
