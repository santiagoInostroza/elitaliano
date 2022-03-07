<?php

namespace Database\Seeders;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
       
        $purchase = Purchase::create([
            'total'=>180000,
            'payment_amount'=>180000,
            'payment_status'=>3,
            'pending_amount'=>0,
            'payment_date'=>'2022-02-27 03:28:40',
            'comment'=>180000,
            'created_by'=>1,
            'date'=>'2022-02-27',
            'supplier_id'=>1,
            'comment'=>180000,
        ]);

        $purchaseItem = PurchaseItem::create([
             'quantity' =>10,
             'quantity_box' =>12,
             'total_quantity' =>120,
             'price' =>1500,
             'price_box' =>18000,
             'total_price' =>180000,
             'stock' =>120,
             'purchase_id' =>$purchase->id,
             'product_id' =>1,
             ]
        );

        $purchaseItem->product->stock += $purchaseItem->stock;
        $purchaseItem->product->save();


        $purchase = Purchase::create([
            'total'=>168000,
            'payment_amount'=>168000,
            'payment_status'=>3,
            'pending_amount'=>0,
            'payment_date'=>'2022-02-28 03:59:42',
            'comment'=>'',
            'created_by'=>1,
            'date'=>'2022-02-28',
            'supplier_id'=>1,
            'comment'=>180000,
        ]);

        $purchaseItem = PurchaseItem::create([
             'quantity' =>10,
             'quantity_box' =>12,
             'total_quantity' =>120,
             'price' =>1500,
             'price_box' =>18000,
             'total_price' =>180000,
             'stock' =>120,
             'purchase_id' =>$purchase->id,
             'product_id' =>1,
             ]
        );

        $purchaseItem->product->stock += $purchaseItem->stock;
        $purchaseItem->product->save();

        
    }
}
