<?php

namespace App\Http\Livewire\Admin\Categories;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class CreateCategory extends Component{
    public $name;
    public $category_id;

    public function render(){
    
        return view('livewire.admin.categories.create-category',[
            'categories'=>Category::all(),
        ]);
    }

    public function saveCategory(){
        Category::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'category_id' => $this->category_id,
        ]);
      
    }


}

