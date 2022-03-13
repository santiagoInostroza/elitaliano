<?php

namespace App\Http\Livewire\Admin\Purchases;

use Carbon\Carbon;
use App\Models\Product;
use Livewire\Component;
use App\Models\Supplier;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\PurchaseItemController;

class CreatePurchase extends Component
{
    public $products;

    public $date;
    public $items;
    public $items2;

    public $quantity;
    public $quantityBox;
    public $totalQuantity;
    public $price;
    public $priceBox;
    public $totalPrice;

    public $totalSale;
    public $supplier_id;
    public $payment_status; 
    public $payment_amount; 
    public $comment;  

    public $isOpenPurchaseData;

    protected function rules(){
        $valid = [
            'supplier_id' => 'required',
            'payment_status' => 'required',
            'date' => 'required',
        ];
        if($this->payment_status == 2){
            $valid ['payment_amount']= 'required' ;
        }
        return $valid;
        
    }

    protected $messages = [
        'supplier_id.required' => 'Selecciona proveedor',
        'payment_status.required' => 'Selecciona estado de pago',
        'date.required' => 'Selecciona fecha de compra',
        'payment_amount.required' => 'Ingresa monto del abono',
    ];

    protected $listeners=[
        'render',
        'updateProducts',
        'saveSupplierId',
    ];



    public function mount(){ 
        $this->products = Product::all();
        $this->date= Carbon::now()->format('Y-m-d');  
        $this->items = (session()->exists('purchase'))? session('purchase.items'):[]; 
        $this->items2 = (session()->exists('purchase'))? session('purchase.items2'):[]; 

        $this->quantity = (session()->exists('purchase'))? session('purchase.quantity'):[]  ;
        $this->quantityBox = (session()->exists('purchase'))? session('purchase.quantityBox'):[]  ;
        $this->totalQuantity = (session()->exists('purchase'))? session('purchase.totalQuantity'):[]  ;
        $this->price = (session()->exists('purchase'))? session('purchase.price'):[]  ;
        $this->priceBox = (session()->exists('purchase'))? session('purchase.priceBox'):[]  ;
        $this->totalPrice = (session()->exists('purchase'))? session('purchase.totalPrice') :[] ;

        $this->totalSale =(session()->exists('purchase'))? session('purchase.totalSale') :0 ;
        $this->supplier_id =(session()->exists('purchase.supplier_id'))? session('purchase.supplier_id') :'' ;
        $this->payment_amount =(session()->exists('purchase.payment_amount'))? session('purchase.payment_amount') :'' ;
        $this->payment_status =(session()->exists('purchase.payment_status'))? session('purchase.payment_status') :'' ;
        $this->comment =(session()->exists('purchase.comment'))? session('purchase.comment') :'' ;
        $this->isOpenPurchaseData =(session()->exists('sale.isOpenPurchaseData'))? session('sale.isOpenPurchaseData') :false ;

    }

    public function render(){
        return view('livewire.admin.purchases.create-purchase',[
            'suppliers' => Supplier::all()
        ]);
    }

    public function updateProducts($name = ''){
       
        $this->dispatchBrowserEvent('updateProducts', [
            'products' => Product::all(),
            'product_name' => $name,
        ]);
        
    }

    public function saveSession(){
        session(['purchase.items' => $this->items]);
        session(['purchase.items2' => $this->items2]);
        session(['purchase.quantity' => $this->quantity]);
        session(['purchase.quantityBox' => $this->quantityBox]);
        session(['purchase.totalQuantity' => $this->totalQuantity]);
        session(['purchase.price' => $this->price]);
        session(['purchase.priceBox' => $this->priceBox]);
        session(['purchase.totalPrice' => $this->totalPrice]);

        session(['purchase.totalSale' => $this->totalSale]);
        session(['purchase.supplier_id' => $this->supplier_id]);
        session(['purchase.payment_amount' => $this->payment_amount]);
        session(['purchase.payment_status' => $this->payment_status]);
        session(['purchase.comment' => $this->comment]);
        // $this->isOpenCustomerData =(session()->exists('sale.isOpenCustomerData'))? session('sale.isOpenCustomerData') :false ;
        
        // session(['sale.isOpenPurchaseData' => $this->isOpenPurchaseData]);
    }

   
   

    public function updatedPaymentStatus(){
      
        session(['purchase.payment_status' => $this->payment_status]);
    }

    public function updatedPaymentAmount(){
        
        session(['purchase.payment_amount' => $this->payment_amount]);
    }
    public function updatedComment(){
       
        session(['purchase.comment' => $this->comment]);
    }

    public function updatedIsOpenPurchaseData(){
       
        session(['sale.isOpenPurchaseData' => $this->isOpenPurchaseData]);
    }


    public function saveSupplierId($supplier_id){
        $this->supplier_id = $supplier_id;
        session(['purchase.supplier_id' => $this->supplier_id]);
    }

    public function createPurchase(){
        $validator= $this->validateItems();

        $temp= $this->isOpenPurchaseData;
        $this->isOpenPurchaseData = true;
        $this->validate();
        $this->isOpenPurchaseData = $temp;

        if(!$validator){
          return false;
        }

        $purchase=[
            'date'=>$this->date,
            'total'=>$this->totalSale,
            'payment_amount'=>$this->payment_amount,
            'payment_status'=>$this->payment_status,
            // 'pending_amount'=>$this->pending_amount,
            // 'payment_date'=>$this->payment_date,
            'comment'=>$this->comment,
            'supplier_id'=>$this->supplier_id,
        ];

        $purchaseController= new PurchaseController();
        $newPurchase = $purchaseController->store($purchase);

        if($newPurchase){
            $purchaseItemController = new PurchaseItemController();

            foreach ($this->items as $key => $item) {
                $it = [
                    'quantity' => $this->quantity[$key],
                    'quantity_box' => $this->quantityBox[$key],
                    'total_quantity' => $this->totalQuantity[$key],
                    'price' => $this->price[$key],
                    'price_box' => $this->priceBox[$key],
                    'total_price' => $this->totalPrice[$key],
                    'stock' => $this->totalQuantity[$key],
                    'purchase_id' => $newPurchase->id,
                    'product_id' => $item['id'],
                ];
                $purchaseItemController->create($it);
            }          
        }
       
       
        session()->forget('purchase');

        session()->flash('message','Compra '. $newPurchase->id . ' creada correctamente!!');
        return redirect()->route('admin.purchases.index');  
    }

    public function validateItems(){
       
        if (!$this->items) {
            return false;
        }
        foreach ($this->items as $key => $value) {
            if (isset($this->quantity[$key]) && $this->quantity[$key]=="") {
                return false;
            }
            if (isset($this->quantityBox[$key]) && $this->quantityBox[$key]=="") {
                return false;
            }
            if (isset($this->totalQuantity[$key]) && $this->totalQuantity[$key]=="") {
                return false;
            }
            if (isset($this->price[$key]) && $this->price[$key]=="") {
                return false;
            }
            if (isset($this->priceBox[$key]) && $this->priceBox[$key]=="") {
                return false;
            }
            if (isset($this->totalPrice[$key]) && $this->totalPrice[$key]==""){
                return false;
            }
        }
       
        return true;
    }

}
