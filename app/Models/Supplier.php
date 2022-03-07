<?php

namespace App\Models;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model{
    use HasFactory;

    // protected $fillable=['name','slug','address','rut','rs','comment'];
    protected $guarded=['id'];

    public function purchases(){
        return $this->hasMany(Purchase::class); 
    }
}
