<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleController extends Controller{

    public function index(){
        return view('admin.sales.index');    
    }


    
    public function create(){
        return view('admin.sales.create');    
    }

    public function store($sale,$items){
        if($sale['payment_status'] == 1){
            $payment_amount =0;
            $pending_amount = $sale['total'];
            $payment_date = null;
        }else if($sale['payment_status'] == 2){
            $payment_amount = $sale['payment_amount'] ;
            $pending_amount =  $sale['total'] - $sale['payment_amount'] ;
            $payment_date = Carbon::now();
        }else if($sale['payment_status'] == 3){
            $payment_amount = $sale['total'] ;
            $pending_amount = 0;
            $payment_date = Carbon::now();
        }else{
            
        }
        
        
        
       $newSale = Sale::create([
            'date' => $sale['date'],
            'total' => $sale['total'],
            'subtotal' => $sale['total'],
            'payment_amount' => $payment_amount,
            'payment_status' => $sale['payment_status'],
            'pending_amount'=> $pending_amount,
            'payment_date'=> $payment_date,
            'comment'=> $sale['comment'],
            'created_by'=> auth()->user()->id,
            'customer_id'=> $sale['customer_id'],
            ]
        );

      


        $saleItemController = new SaleItemController();

        if($newSale){

            foreach ($items as $item) {
                $saleItemController->create($item,$newSale->id);
            }

            return $newSale;
        }else{
            return false;
        } 
    }

    public function show(Sale $sale){
        return view('admin.sales.show', compact('show'));   
    }
    public function edit(Sale $sale){
        return view('admin.sales.edit', compact('sale'));   
    }

    public function update(Sale $sale, $modifiedSale, $modifiedItems){
        $sale->customer_id = $modifiedSale['customer_id'];
        $sale->date = $modifiedSale['date'] ;
        $sale->payment_status = $modifiedSale['payment_status'];
        $sale->payment_amount = $modifiedSale['payment_amount'];
        $sale->comment = $modifiedSale['comment'];
        $sale->total = $modifiedSale['total'];
        $sale->save();

        $saleItemController= new SaleItemController();
        $saleItemController->syncSaleItems($sale, $modifiedItems);


    }

    public function destroy(Sale $sale){
       
        $saleItemController= new SaleItemController();
        foreach ($sale->saleItems as $key => $item) {
           $saleItemController->destroy($item);
        }
        $sale->delete();

    }


}
