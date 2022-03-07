<?php

namespace App\Models;

use App\Models\SaleItem;
use App\Models\PurchaseItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model{
    use HasFactory;

    protected $fillable=['name', 'slug','description', 'stock_min', 'status', 'category_id', 'brand_id'];

  
    public function category(){
        return $this->belongsTo(Category::class);  
    }
    
    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function purchaseItems(){
        return $this->hasMany(PurchaseItem::class);
    }
    public function saleItems(){
        return $this->hasMany(SaleItem::class);
    }
}
