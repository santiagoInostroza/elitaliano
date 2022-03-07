<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller{
  
    public function index(){
        
        return view('admin.suppliers');
        
    }





}

