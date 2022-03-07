<?php

namespace App\Http\Livewire\Admin\Sales;

use Carbon\Carbon;
use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use App\Http\Controllers\Admin\SaleController;
use App\Models\PurchaseItem;

class Create extends Component{
   

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
        $this->items = (session()->exists('sale.items'))? session('sale.items'):[]; 
        $this->items2 = (session()->exists('sale.items2'))? session('sale.items2'):[]; 

        $this->quantity = (session()->exists('sale.quantity'))? session('sale.quantity'):[]  ;
        $this->quantityBox = (session()->exists('sale.quantityBox'))? session('sale.quantityBox'):[]  ;
        $this->totalQuantity = (session()->exists('sale.totalQuantity'))? session('sale.totalQuantity'):[]  ;
        $this->price = (session()->exists('sale.price'))? session('sale.price'):[]  ;
        $this->priceBox = (session()->exists('sale.priceBox'))? session('sale.priceBox'):[]  ;
        $this->totalPrice = (session()->exists('sale.totalPrice'))? session('sale.totalPrice') :[] ;

        $this->totalSale =(session()->exists('sale.totalSale'))? session('sale.totalSale') :0 ;
        $this->customer_id =(session()->exists('sale.customer_id'))? session('sale.customer_id') :'' ;
        $this->payment_amount =(session()->exists('sale.payment_amount'))? session('sale.payment_amount') :'' ;
        $this->payment_status =(session()->exists('sale.payment_status'))? session('sale.payment_status') :'' ;
        $this->comment =(session()->exists('sale.comment'))? session('sale.comment') :'' ;
        $this->isOpenCustomerData =(session()->exists('sale.isOpenCustomerData'))? session('sale.isOpenCustomerData') :false ;

    }

    public function render(){

        return view('livewire.admin.sales.create',[
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

    public function saveSession(){
        session(['sale.items' => $this->items]);
        session(['sale.items2' => $this->items2]);
        session(['sale.quantity' => $this->quantity]);
        session(['sale.quantityBox' => $this->quantityBox]);
        session(['sale.totalQuantity' => $this->totalQuantity]);
        session(['sale.price' => $this->price]);
        session(['sale.priceBox' => $this->priceBox]);
        session(['sale.totalPrice' => $this->totalPrice]);

        session(['sale.totalSale' => $this->totalSale]);
        session(['sale.customer_id' => $this->customer_id]);
        session(['sale.payment_amount' => $this->payment_amount]);
        session(['sale.payment_status' => $this->payment_status]);
        session(['sale.comment' => $this->comment]);
        session(['sale.isOpenCustomerData' => $this->isOpenCustomerData]);


    }

   
   

    public function updatedPaymentStatus(){
        session(['sale.payment_status' => $this->payment_status]);
    }

    public function updatedPaymentAmount(){
        session(['sale.payment_amount' => $this->payment_amount]);
    }

    public function updatedComment(){
        session(['sale.comment' => $this->comment]);
    }

    public function updatedIsOpenCustomerData(){
       
        session(['sale.isOpenCustomerData' => $this->isOpenCustomerData]);
    }


    public function saveCustomerId($customer_id){
        $this->customer_id = $customer_id;
        session(['sale.customer_id' => $this->customer_id]);
    }

    public function createSale(){
        $validator= $this->validateItems();
        $temp= $this->isOpenCustomerData;
        $this->isOpenCustomerData = true;
        $this->validate();
        $this->isOpenCustomerData = $temp;
        if(!$validator){
          return false;
        }

        $sale=[
            'date'=>$this->date,
            'total'=>$this->totalSale,
            'payment_amount'=>$this->payment_amount,
            'payment_status'=>$this->payment_status,
            'comment'=>$this->comment,
            'customer_id'=>$this->customer_id,
        ];       
           
        $items=[];
        foreach ($this->items as $key => $item) {
            $items[] = [
                'quantity' => $this->quantity[$key],
                'quantity_box' => $this->quantityBox[$key],
                'total_quantity' => $this->totalQuantity[$key],

                'price' => $this->price[$key],
                'price_box' => $this->priceBox[$key],
                'total_price' => $this->totalPrice[$key],

                'purchase_item_id' => $item['id'],
            ];
            
        }   
        $saleController= new SaleController();  
        $newSale = $saleController->store($sale,$items);   
        
     
        session()->forget('sale');

        session()->flash('message','Venta '. $newSale->id . ' creada correctamente!!');
        return redirect()->route('admin.sales');

             
    }

    public function validateItems(){
        
        if (!$this->items) {
            // $this->dispatchBrowserEvent('toast', ['title' => 'No hay productos agregados', 'icon' => 'warning',]);
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
                if ($this->totalQuantity[$key] > $purchaseItem->stock ) {
                    // $this->dispatchBrowserEvent('toast', ['title' => 'No hay suficiente stock de '. $purchaseItem->product->name . ' del ' . $purchaseItem->purchase->date . '. Disponible ' . $purchaseItem->stock . 'k.' , 'icon' => 'warning','timer'=>3500]);
                    return false;
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
