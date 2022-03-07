<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
       
        $name = 'Chilenas';
        $category1 = Category::create([
            'name' => $name,
            'slug' => Str::slug($name),
        ]);
        $name = 'Peruanas';
        $category2 = Category::create([
            'name' => $name,
            'slug' => Str::slug($name),
        ]);
        $name = 'Cuesco grande';
        $category3 = Category::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'category_id' => 1,
        ]);
        $name = 'Cuesco chico';
        $category4 = Category::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'category_id' => 1,
        ]);
        $name = 'Cuesco grande';
        $category5 = Category::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'category_id' => 2,
        ]);
        $name = 'Cuesco mediano';
        $category6 = Category::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'category_id' => 2,
        ]);
    }
}
