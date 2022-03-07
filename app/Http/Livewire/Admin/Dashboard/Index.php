<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Customer;
use App\Models\Product;
use Livewire\Component;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Supplier;

class Index extends Component{

    public function render(){
        
        return view('livewire.admin.dashboard.index',[
            'purchases'=>Purchase::all(),
            'supplier'=>Supplier::all(),
            'products'=>Product::all(),
            'customers'=>Customer::all(),
            'sales'=>Sale::all(),
        ]);
    }
}
