<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $tipo=1;

        if($tipo == 1){  //desarrollo

            $this->call(BrandSeeder::class);
            $this->call(SupplierSeeder::class);
            $this->call(CategorySeeder::class);
            $this->call(ProductSeeder::class);
            $this->call(RoleSeeder::class);
            $this->call(UserSeeder::class);
            $this->call(CustomerSeeder::class);
            $this->call(PurchaseSeeder::class);
        
        }
        if($tipo == 2){  //produccion

            $this->call(BrandSeeder::class);
            $this->call(CategorySeeder::class);
            $this->call(RoleSeeder::class);
        
        }
        
    }
}
