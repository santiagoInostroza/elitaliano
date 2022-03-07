<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PurchaseItem;
use Illuminate\Support\Facades\Log;

class SaleItemController extends Controller{

    public function create($item, $sale_id){

        $purchaseItem = PurchaseItem::find($item['purchase_item_id']);
        $total_quantity =  $item['total_quantity'];
        
        $product_id =$purchaseItem->product_id;
        $price =$item['price'];
        $cost = $purchaseItem->price ;
        $total_cost = $cost * $total_quantity ;
        $difference = $price - $cost;
        $total_difference = $difference * $total_quantity;
       



        $newSaleItem =  SaleItem::create([
            'quantity' => $item['quantity'],
            'quantity_box' => $item['quantity_box'],
            'total_quantity' => $total_quantity,

            'price' => $price,
            'price_box' => $item['price_box'],
            'total_price' => $item['total_price'],

            'cost' => $cost,
            'total_cost' => $total_cost,

            'difference' => $difference,
            'total_difference' => $total_difference,

            'purchase_item_id' => $purchaseItem->id ,
            'sale_id' => $sale_id,
            'product_id' => $product_id,
        ]);

        if ($newSaleItem) {
            $newSaleItem->product->stock -= $newSaleItem->total_quantity;
            $newSaleItem->product->save();

            $purchaseItem->stock -= $newSaleItem->total_quantity;
            $purchaseItem->save();

           return $newSaleItem->id;
        }else{
            return false;
        }
    }
  

    public function syncSaleItems(Sale $sale, $modifiedItems){
        foreach ($sale->saleItems as $key => $item) {
            if (isset($modifiedItems[$item->purchaseItem->id])) {
                $this->update($item,$modifiedItems[$item->purchaseItem->id]);
            }else{
                $this->destroy($item);
            }
         }
         foreach ($modifiedItems as $product_id => $modifiedItem) {
             $isCreated=false;
             foreach ($sale->saleItems as $key => $item) {
                if ($product_id==$item->product_id) $isCreated=true;
                continue;
             }
             if (!$isCreated) $this->create($modifiedItem, $sale->id);
         }

    }

    public function update(SaleItem $saleItem, $modifiedItem){

      
        $total_quantity =  $modifiedItem['total_quantity'];
        $price =$modifiedItem['price'];
        $cost = $saleItem->purchaseItem->price ;
        $total_cost = $cost * $total_quantity ;
        $difference = $price - $cost;
        $total_difference = $difference * $total_quantity;
     

        $saleItem->product->stock += $saleItem->total_quantity;
        $saleItem->product->stock -= $modifiedItem['total_quantity'];
        $saleItem->product->save();

        $saleItem->purchaseItem->stock+= $saleItem->total_quantity;
        $saleItem->purchaseItem->stock-= $modifiedItem['total_quantity'];
        $saleItem->purchaseItem->save();



        $saleItem->quantity=$modifiedItem['quantity'];
        $saleItem->quantity_box=$modifiedItem['quantity_box'];
        $saleItem->total_quantity=$total_quantity;
        $saleItem->price= $price;
        $saleItem->price_box=$modifiedItem['price_box'];
        $saleItem->total_price=$modifiedItem['total_price'];


        $saleItem->cost=$cost;
        $saleItem->total_cost=$total_cost;
        $saleItem->difference=$difference;
        $saleItem->total_difference=$total_difference;       

        $saleItem->save();
    }


    public function destroy(SaleItem $item){
        $item->purchaseItem->stock+=$item->total_quantity;
        $item->purchaseItem->save();

        $item->product->stock+=$item->total_quantity;
        $item->product->save();
        $item->delete();
    }
}
