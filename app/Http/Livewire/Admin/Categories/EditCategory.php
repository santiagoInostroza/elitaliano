<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;

class EditCategory extends Component{
    public $category;

    protected $rules = [
        'category.name' => "required",
        'category.category_id' => "sometimes",
    ];
    public function render(){
        return view('livewire.admin.categories.edit-category',[
            'categories' => Category::all(),
        ]);
    }

    public function editCategory(){
        $this->validate();
        $this->category->save();

        session()->flash('message','Categoria '. $this->category->id . ' Modificada correctamente!!');
        return redirect()->route('admin.categories.index');      

    }
}
