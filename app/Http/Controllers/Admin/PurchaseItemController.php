<?php

namespace App\Http\Controllers\Admin;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchaseItemController extends Controller{


    public function create($item){
        $newItem =  PurchaseItem::create([
            'quantity' => $item['quantity'],
            'quantity_box' => $item['quantity_box'],
            'total_quantity' => $item['total_quantity'],
            'price' => $item['price'],
            'price_box' => $item['price_box'],
            'total_price' => $item['total_price'],
            'stock' => $item['stock'],
            'purchase_id' => $item['purchase_id'],
            'product_id' => $item['product_id'],
        ]);

        if ($newItem) {
            $newItem->product->stock += $newItem->stock;
            $newItem->product->save();
           return $newItem->id;
        }else{
            return false;
        }
    }
  

    public function syncPurchaseItems(Purchase $purchase, $newItems){
        foreach ($purchase->purchaseItems as $key => $item) {
            if (isset($newItems[$item->product->id])) {
                $this->update($item,$newItems[$item->product->id]);
            }else{
                $this->destroy($item);
            }
         }
         foreach ($newItems as $product_id => $newItem) {
             $finded=false;
             foreach ($purchase->purchaseItems as $key => $item) {
                if ($product_id==$item->product_id) $finded=true;
             }
             if (!$finded) $this->create($newItem);
         }

    }

    public function update(PurchaseItem $item, $newItem){
        $diff =$item->total_quantity-$item->stock;
        $newStock=$newItem['total_quantity']-$diff;

        $item->product->stock -= $item->stock;
        $item->product->stock += $newStock;
        $item->product->save();

        $item->quantity=$newItem['quantity'];
        $item->quantity_box=$newItem['quantity_box'];
        $item->total_quantity=$newItem['total_quantity'];
        $item->price=$newItem['price'];
        $item->price_box=$newItem['price_box'];
        $item->total_price=$newItem['total_price'];
        $item->stock= $newStock;
        $item->save();
    }


    public function destroy(PurchaseItem $item){
        $item->product->stock-=$item->stock;
        $item->product->save();
       $item->delete();
    }
}
