<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;

class IndexCategories extends Component{
    
    public function render(){
        return view('livewire.admin.categories.index-categories',[
            'categories' => Category::all(),
        ]);

    }

    public function deleteCategory($category_id){
        $category = Category::find($category_id);
        $category->delete();
        $this->dispatchBrowserEvent('toast', ['title' => 'Categoria ' .  $category_id . ' eliminada.', 'icon' => 'success',]);

    }
}
