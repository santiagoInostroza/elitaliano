<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller{

    public function index(){
        return view('admin.products');
        
    }


    public function create($data){
        try {
            $product =  Product::create([
                'name'=>$data['name'],
                'slug'=> Str::slug($data['name']),
                'description'=>$data['description'],
                'stock_min'=>$data['stock_min'],
                'status'=>$data['status'],
                'category_id'=>$data['category_id'],
                'brand_id'=> $data['brand_id'],
            ]);
            return $product->id;
    
        } catch (\Throwable $th) {
           return false;
        }

    }
}
