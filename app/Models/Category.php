<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model{
    use HasFactory;
    protected $guarded = ['id'];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function category(){
        return Category::find($this->category_id); 
    }
    public function subCategories(){
        return Category::where('category_id', $this->id)->get(); 
    }
    
    public function getRouteKeyName(){
        return 'slug';
    }
}
