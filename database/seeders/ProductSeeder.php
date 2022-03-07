<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $cant=20;
        $name = 'Palta Hass';
        $category = Product::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'category_id' => 1,
            'brand_id' => 1,
            'description' => 'El aguacate Hass o palta Hass es una variedad de la fruta Persea americana, la cual fue originada a partir de una semilla de raza guatemalteca en un huerto de Rudolph Hass en la Habra, California en 1926 y en México en el municipio de Tingambato, patentada en 1935 e introducida globalmente en el mercado en 1960; es la variedad más cultivada a nivel mundial. Los "aguacates Hass" son una de las variedades más comunes de aguacate en el mercado.',
        ]);
       

        for ($i=0; $i <$cant ; $i++) { 
            $name = 'Palta de la cruz'. $i;
            $category = Product::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'category_id' => 1,
                'brand_id' => 1,
                'description' => 'La palta negra de la Cruz es fruto de el Palto, esta fruta de piel negra y lisa es muy rica y nutritiva, es alta en proteinas, grasas saludables y una excelente fuente de vitaminas.',
            ]);
           
        }

       
     
        
   
    }
}
