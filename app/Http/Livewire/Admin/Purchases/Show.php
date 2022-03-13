<?php

namespace App\Http\Livewire\Admin\Purchases;

use Livewire\Component;
use App\Models\Purchase;

class Show extends Component{
    public $purchase;
    
    public function render(){
        return view('livewire.admin.purchases.show');
    }

  
}
