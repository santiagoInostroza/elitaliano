<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $name = "Don Roberto Kiyosaki";
        Supplier::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'slug' => Str::slug($name),
        ]);
        $name = "Don Alejandro Sanz";
        Supplier::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'slug' => Str::slug($name),
        ]);
        $name = "Don Romeo Santos";
        Supplier::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'slug' => Str::slug($name),
        ]);
    }
}
