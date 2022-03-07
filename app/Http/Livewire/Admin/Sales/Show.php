<?php

namespace App\Http\Livewire\Admin\Sales;

use Livewire\Component;

class Show extends Component{

    public $sale;


    public function render(){
        return view('livewire.admin.sales.show');
    }
}
