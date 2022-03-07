<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        
        User::create([
            'name' =>'Santiago Inostroza',
            'email' => 'santiagoinostroza2@gmail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Admin');

        User::create([
            'name' =>'Wolsom',
            'email' => 'wolsom@gmail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Vendedor');
    }
}
