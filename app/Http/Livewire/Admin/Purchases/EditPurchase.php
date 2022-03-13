<?php

namespace App\Http\Livewire\Admin\Purchases;

use Carbon\Carbon;
use App\Models\Product;
use Livewire\Component;
use App\Models\Supplier;
use Illuminate\Support\Str;
use App\Http\Controllers\Admin\PurchaseController;

class EditPurchase extends Component{

    public $purchase;

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

    public $total_sale;
    public $supplier_id;
    public $payment_status; 
    public $payment_amount; 
    public $comment; 

    public $isOpenPurchaseData;

    
    protected $messages = [
        'supplier_id.required' => 'Selecciona proveedor',
        'payment_status.required' => 'Selecciona estado de pago',
        'date.required' => 'Selecciona fecha de compra',
        'payment_amount.required' => 'Ingresa monto del abono',
    ];

    protected $listeners=[
        'render',
        'updateProducts',
    ];

    public function mount(){ 
        $this->products = Product::all();
        $this->date= Carbon::now()->format('Y-m-d');  
        foreach ($this->purchase->purchaseItems as $key => $value) {
            $this->items[]=$value->product;
            $this->items2[]=$value->product->id;
            $this->quantity[$key]=$value['quantity'];
            $this->quantityBox[$key]=$value['quantity_box'];
            $this->totalQuantity[$key]=$value['total_quantity'];
            $this->price[$key]=$value['price'];
            $this->priceBox[$key]=$value['price_box'];
            $this->totalPrice[$key]=$value['total_price'];
        } 
        

        $this->total_sale = $this->purchase->total ;
        $this->supplier_id = $this->purchase->supplier_id ;
        $this->payment_amount = $this->purchase->payment_amount ;
        $this->payment_status = $this->purchase->payment_status  ;
        $this->comment = $this->purchase->comment ;

        $this->isOpenPurchaseData =(session()->exists('sale.isOpenPurchaseData'))? session('sale.isOpenPurchaseData') :false ;


    }

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

    public function render(){
        return view('livewire.admin.purchases.edit-purchase',[
            'suppliers' => Supplier::all()
        ]);
    }

    
    public function updateProducts($name = ''){
       
        $this->dispatchBrowserEvent('updateProducts', [
            'products' => Product::all(),
            'product_name' => $name,
        ]);
        
    }

    public function saveSupplier($name, $address, $rut, $rs, $comment){
        $supplier =  Supplier::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'address' => $address,
            'rut' => $rut,
            'rs' => $rs,
            'comment' => $comment,
        ]);
       $this->saveSupplierId($supplier->id);
    }

    public function updatedIsOpenPurchaseData(){
        session(['sale.isOpenPurchaseData' => $this->isOpenPurchaseData]);
    }

    


    public function saveSupplierId($supplier_id){
        $this->supplier_id = $supplier_id;
      
    }

    public function editPurchase(){
        $validator= $this->validateItems();
        
        $temp= $this->isOpenPurchaseData;
        $this->isOpenPurchaseData = true;
        $this->validate();
        $this->isOpenPurchaseData = $temp;
       
        if(!$validator){
            return false;
        }

        $items=[];
        foreach ($this->items as $key => $item) {
            $items [$item['id']]= [
                'quantity' => $this->quantity[$key],
                'quantity_box' => $this->quantityBox[$key],
                'total_quantity' => $this->totalQuantity[$key],
                'price' => $this->price[$key],
                'price_box' => $this->priceBox[$key],
                'total_price' => $this->totalPrice[$key],
                'stock' => $this->totalQuantity[$key],
                'purchase_id' => $this->purchase->id,
                'product_id' => $item['id'],
            ];
        }          
        $data=[
            'supplier_id'=> $this->supplier_id,
            'date'=>$this->date ,
            'payment_status'=> $this->payment_status,
            'payment_amount'=>  $this->payment_amount,
            'comment'=>$this->comment ,
            'items'=>$items ,
        ];

        $purchaseController = new PurchaseController();
        $purchaseController->update($this->purchase,$data);
     
        session()->flash('message','Compra '. $this->purchase->id . ' Modificada correctamente!!');
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
