<?php

namespace App\Http\Livewire\Admin\Sales;

use Carbon\Carbon;
use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use App\Http\Controllers\Admin\SaleController;
use App\Models\PurchaseItem;
use App\Models\SaleItem;

class Edit extends Component{

    public $sale;

    public $products;

    public $date;
    public $items;
    public $items2;
    public $items3;

    public $quantity;
    public $quantityBox;
    public $totalQuantity;
    public $price;
    public $priceBox;
    public $totalPrice;

    public $totalSale;
    public $customer_id;
    public $payment_status; 
    public $payment_amount; 
    public $comment; 
    public $isOpenCustomerData;  

    protected function rules(){
        $valid = [
            'customer_id' => 'required',
            'payment_status' => 'required',
            'date' => 'required',
        ];
        if($this->payment_status == 2){
            $valid ['payment_amount']= 'required' ;
        }
        
        return $valid;
        
    }

    protected $messages = [
        'customer_id.required' => 'Selecciona cliente',
        'payment_status.required' => 'Selecciona estado de pago',
        'date.required' => 'Selecciona fecha de venta',
        'payment_amount.required' => 'Ingresa monto del abono',
    ];

    protected $listeners=[
        'render',
        'updateProducts',
        'saveCustomerId',
    ];



    public function mount(){ 
        $this->products = $this->getProducts();
        $this->date= Carbon::now()->format('Y-m-d');  
        
       
        foreach ($this->sale->saleItems as $key => $item) {

            $this->items []= purchaseItem::find($item->purchase_item_id)->with(['product','purchase'])->first(); 
            $this->items2 []= $item->purchase_item_id; 
            $this->items3 []= saleItem::find($item->id)->first(); 
    
            $this->quantity []= $item->quantity;  
            $this->quantityBox []=$item->quantity_box;  
            $this->totalQuantity []= $item->total_quantity;  
            $this->price []= $item->price; 
            $this->priceBox []= $item->price_box;  
            $this->totalPrice []= $item->total_price; 
           
        }
       

        $this->totalSale = $this->sale->total;
        $this->customer_id = $this->sale->customer_id ;
        $this->payment_amount = $this->sale->payment_amount ;
        $this->payment_status = $this->sale->payment_status ;
        $this->comment = $this->sale->comment ;

        $this->isOpenCustomerData =(session()->exists('sale.isOpenCustomerData'))? session('sale.isOpenCustomerData') :false ;

    }

    public function render(){
        return view('livewire.admin.sales.edit',[
            'customers' => Customer::all()
        ]);
    }

    public function updateProducts($name = ''){
       
        $this->dispatchBrowserEvent('updateProducts', [
            'products' => $this->getProducts(),
            'product_name' => $name,
        ]);
        
    }


    public function getProducts(){
        $products = Product::with(['purchaseItems','purchaseItems.purchase','purchaseItems.product'])->where('stock','>', 0)->get();
        return  $products->merge(Product::with(['purchaseItems','purchaseItems.purchase','purchaseItems.product'])->where('stock','=', 0)->orWhere('stock','=',null)->orWhere('stock','=','')->get());
        
    }   
   


    public function updatedIsOpenCustomerData(){
       
        session(['sale.isOpenCustomerData' => $this->isOpenCustomerData]);
    }


    public function saveCustomerId($customer_id){
        $this->customer_id = $customer_id;
    }

    public function editSale(){
        $validator= $this->validateItems();
        $temp= $this->isOpenCustomerData;
        $this->isOpenCustomerData = true;
        $this->validate();
        $this->isOpenCustomerData = $temp;
        if(!$validator){
          return false;
        }

        $modifiedSale=[
            'date'=>$this->date,
            'total'=>$this->totalSale,
            'payment_amount'=>$this->payment_amount,
            'payment_status'=>$this->payment_status,
            'comment'=>$this->comment,
            'customer_id'=>$this->customer_id,
        ];       
           
        $modifiedItems=[];
        foreach ($this->items as $key => $item) {
            $purchase_item_id = $item['id'];
            $modifiedItems[$purchase_item_id] = [
                // 'sale_item_id' => $this->quantity[$key],
                'quantity' => $this->quantity[$key],
                'quantity_box' => $this->quantityBox[$key],
                'total_quantity' => $this->totalQuantity[$key],

                'price' => $this->price[$key],
                'price_box' => $this->priceBox[$key],
                'total_price' => $this->totalPrice[$key],

                'purchase_item_id' => $purchase_item_id,
                
            ];
            
        }   
        $saleController= new SaleController();  
        $saleController->update($this->sale, $modifiedSale, $modifiedItems);  
        
       
        session()->flash('message', 'Venta '. $this->sale->id .' modificada correctamente !!');
        return redirect()->route('admin.sales.index');

             
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
            if (isset($this->totalQuantity[$key]) ) {
                $purchaseItem = PurchaseItem::find($value['id']);
                if(isset($this->items3[$key])){
                    if ($this->totalQuantity[$key] > $purchaseItem->stock + $this->items3[$key]['total_quantity']  ) {
                         return false;
                   }
                }else{
                    if ($this->totalQuantity[$key] > $purchaseItem->stock ) {
                         return false;
                   }
                }               
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
