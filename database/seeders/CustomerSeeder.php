<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        
        $cantidad = 10;

        for ($i=0; $i < $cantidad ; $i++) { 
            $name = 'Cliente '. $i;
            Customer::create([
                'name'=> $name,
                'slug'=> Str::slug($name),
                'cel'=> '9732318'. ($i +10),
                'address'=> 'pelluco 08'. ($i +10),
                'comment'=> 'Comentario de prueba número '. ($i +10),
            ]);


        }
       
    }
}
