<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $name = 'Sin marca';
        $brand = Brand::create([
            'name' => $name,
            'slug' => Str::slug($name),
        ]);
        $name = 'Artesanal';
        $brand2 = Brand::create([
            'name' => $name,
            'slug' => Str::slug($name),
        ]);
        
    }
}
