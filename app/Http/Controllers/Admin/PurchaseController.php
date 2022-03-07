<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PurchaseItem;

class PurchaseController extends Controller{

    public function index(){
        return view('admin.purchases');
    }

    public function create($purchase){

        if($purchase['payment_status'] == 1){
            $payment_amount =0;
            $pending_amount = $purchase['total'];
            $payment_date = null;
        }else if($purchase['payment_status'] == 2){
            $payment_amount = $purchase['payment_amount'] ;
            $pending_amount =  $purchase['total'] - $purchase['payment_amount'] ;
            $payment_date = Carbon::now();
        }else if($purchase['payment_status'] == 3){
            $payment_amount = $purchase['total'] ;
            $pending_amount = 0;
            $payment_date = Carbon::now();
        }else{
            
        }
        
        
        
       $newPurchase = Purchase::create([
            'date' => $purchase['date'],
            'total' => $purchase['total'],
            'payment_amount' => $payment_amount,
            'payment_status' => $purchase['payment_status'],
            'pending_amount'=> $pending_amount,
            'payment_date'=> $payment_date,
            'comment'=> $purchase['comment'],
            'created_by'=> auth()->user()->id,
            'supplier_id'=> $purchase['supplier_id'],
            ]
        );

        if($newPurchase){
            return $newPurchase->id;
        }else{
            return false;
        }
        
    }

    public function edit(Purchase $purchase,$data){
        $purchase->supplier_id = $data['supplier_id'];
        $purchase->date = $data['date'] ;
        $purchase->payment_status = $data['payment_status'];
        $purchase->payment_amount = $data['payment_amount'];
        $purchase->comment = $data['comment'];
        $purchase->save();

        $purchaseItemController= new PurchaseItemController();
        $purchaseItemController->syncPurchaseItems($purchase,$data['items']);
        
    }

    public function destroy(Purchase $purchase){
       
        $purchaseItemController= new PurchaseItemController();
        foreach ($purchase->purchaseItems as $key => $item) {
           $purchaseItemController->destroy($item);
        }
        $purchase->delete();

    }
}
