<?php

namespace App\Models;

use App\Models\SaleItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model{
    use HasFactory;
    protected $guarded = ['id'];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function saleItems(){
        return $this->hasMany(SaleItem::class); 
    }

    public function createdBy(){
        return User::find($this->created_by);
    }
}
