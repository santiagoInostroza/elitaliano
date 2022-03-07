<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\PurchaseItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleItem extends Model{

    use HasFactory;
    protected $guarded = ['id'];

    public function sale(){
        return $this->belongsTo(Sale::class);
    }
    
    public function product(){
        return $this->belongsTo(Product::class);
    }
    
    public function purchaseItem(){
        return $this->belongsTo(PurchaseItem::class);
    }
}
