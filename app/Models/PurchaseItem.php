<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseItem extends Model{
    use HasFactory;

    
    protected $guarded=['id'];

    public function purchase(){
       return $this->belongsTo(Purchase::class);    
    }
    
    public function product(){
        return $this->belongsTo(Product::class);
        
    }
}
