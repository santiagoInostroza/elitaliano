<?php

namespace App\Models;

use App\Models\User;
use App\Models\Supplier;
use App\Models\PurchaseItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model{

    
    use HasFactory;
    
    protected $guarded=['id'];

    public function supplier(){
       return $this->belongsTo(Supplier::class);    
    }

    public function purchaseItems(){
        return $this->hasMany(PurchaseItem::class); 
    }

    public function createdBy(){
        return User::find($this->created_by);
    }
}
