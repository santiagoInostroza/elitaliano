<div  id="purchaseMain" x-data="purchaseMain()" x-on:keyup.alt.n.window="openNewPurchase= true" class="relative">
 
   <div class="absolute right-0 top-0 -mt-10">
      <div class="flex justify-end" x-on:click="openNewPurchase=true">
         <x-jet-button>Nueva compra</x-jet-button>
      </div>
      
      <div x-cloak x-show="openNewPurchase">
         @livewire('admin.purchases.new-purchase')
      </div>
   </div>
   <x-table.table>
     
      <x-slot name="thead">
         <tr>
            <x-table.th>Id</x-table.th>
            <x-table.th>Nombre Proveedor</x-table.th>
            <x-table.th>Total</x-table.th>
            <x-table.th>Monto pagado</x-table.th>
            <x-table.th>Estado pago</x-table.th>
            <x-table.th>Monto pendiente</x-table.th>
            <x-table.th>Fecha de pago</x-table.th>
            <x-table.th>Comentario</x-table.th>
            <x-table.th>Fecha</x-table.th>
            <x-table.th width="10"> </x-table.th>
         </tr>
      </x-slot>
      <x-slot name="tbody">
         @foreach ($purchases as $purchase)
            <tr>
               <x-table.td> {{ $purchase->id }}</x-table.td>
               <x-table.td> {{ $purchase->supplier->name }}</x-table.td>
               <x-table.td> ${{ number_format($purchase->total,0,',','.') }}</x-table.td>
               <x-table.td> ${{ number_format($purchase->payment_amount,0,',','.') }}</x-table.td>
               <x-table.td> 
                  <div>
                     @if ($purchase->payment_status==3)
                         Pagado
                     @elseif($purchase->payment_status==2)
                         Abonado
                     @elseif($purchase->payment_status==1)
                         Pendiente
                     @endif
                  </div>
               </x-table.td>
               <x-table.td> ${{ number_format($purchase->pending_amount,0,',','.') }}</x-table.td>
               <x-table.td> {{ Helper::date($purchase->payment_date,true) }}</x-table.td>
               <x-table.td> {{ $purchase->comment }}</x-table.td>
               <x-table.td> {{ $purchase->date }}</x-table.td>
               <x-table.td> 
                  <div>
                     <x-jet-secondary-button x-on:click="openShowPurchase=true;$wire.setPurchase({{ $purchase }})"><i class="fas fa-eye"></i></x-jet-secondary-button>
                     <x-jet-secondary-button x-on:click="openEditPurchase=true;$wire.setPurchase({{ $purchase }})"><i class="fas fa-pen"></i></x-jet-secondary-button>
                     <x-jet-danger-button x-on:click="openDeletePurchase=true;$wire.setPurchase({{ $purchase }})"><i class="fas fa-trash"></i></x-jet-secondary-button>
                  </div>
               </x-table.td>
            </tr>
         @endforeach
      </x-slot>
   </x-table.table>
   <div>
      @if ($openShowPurchase)
         @livewire('admin.purchases.show', ['purchase' => $purchaseSelected], key('show'.$purchaseSelected->id))
      @endif


      @if ($openEditPurchase)
         @livewire('admin.purchases.edit', ['purchase' => $purchaseSelected], key('edit'.$purchaseSelected->id))
      @endif


   
      @if ($openDeletePurchase)
         <div x-cloak x-show="openDeletePurchase">
            <x-modal.alert2>
               <x-slot name="header">
                  <div class="flex justify-between items-center">
                     <h2>Eliminar compra {{$purchaseSelected->id}} de {{$purchaseSelected->supplier->name}}</h2>
                     <div class="p-2 cursor-pointer" x-on:click="openDeletePurchase = false"><i class="fas fa-times"></i></div>
                  </div>
               </x-slot>
               <x-slot name="body"><p class="text-lg">Seguro deseas eliminar esta compra?</p></x-slot>
               <x-slot name="footer">
                  <div class="flex justify-between items-center">
                     <x-jet-danger-button wire:click="deletePurchase()">Si, eliminar</x-jet-danger-button>
                     <x-jet-button x-on:click="openDeletePurchase = false">No porfavorsito</x-jet-button>
                  </div>
               </x-slot>
            
            </x-modal-alert2>
         </div>
      @endif
   </div>
 
   <script>
      function purchaseMain(){
         return{
            openNewPurchase: @entangle('openNewPurchase'),
            openShowPurchase: @entangle('openShowPurchase'),
            openEditPurchase: @entangle('openEditPurchase'),
            openDeletePurchase: @entangle('openDeletePurchase'),            
         }
      }

      function editPurchase(items,items2,quantity,quantityBox,totalQuantity, price,priceBox, totalPrice, products,total_sale,supplier_id,payment_status, payment_amount, comment){
         return {
            openNewProduct:false,
            search:'',
            loading:false, 
            showProducts:false,
            showErrors:false,

            items:items,
            items2:items2,
            quantity:quantity,
            quantityBox:quantityBox,
            totalQuantity:totalQuantity,
            price:price,
            priceBox:priceBox,
            totalPrice:totalPrice,

            total_sale:total_sale,
           

            products: products,
            
           
            supplier_id: supplier_id ,
            payment_status:payment_status,
            payment_amount: payment_amount ,
            comment:comment ,

            
            startEditPurchase:function(){

                  window.addEventListener('updateProducts', event => {
                     this.products =  event.detail.products;
                     this.editProducts=true;
                     this.search = event.detail.product_name;
                  });
                  
            },

            editPurchase: function(){ 
                  this.loading=true;
                   this.showErrors = true;
                  this.$wire.editPurchase().then( (response)=>{
                     if (response > 0) {
                        // this.openEditPurchase=false;
                        // this.items=[];
                     }
                     this.loading=false;
                  });
            },

            get filteredProducts() {
                  return this.products.filter(
                     i => i.name.toUpperCase().trim().includes(this.search.trim().toUpperCase())
                  )
            },

            open:function(){
                  this.showProducts = true;
            },
            close:function(){
                  this.showProducts = false;
            },
            addItem:function(product){
                  this.quantity[this.items.length]=0;
                  this.quantityBox[this.items.length]=0;
                  this.totalQuantity[this.items.length]=0;
                  this.price[this.items.length]=0;
                  this.priceBox[this.items.length]=0;
                  this.totalPrice[this.items.length]=0;

                  this.items.push(product);
                  this.items2.push(product.id);
                  this.actualizate();

            },
            removeItem:function(index){
                  this.quantity.splice(index ,1);
                  this.quantityBox.splice(index ,1);
                  this.totalQuantity.splice(index ,1);
                  this.price.splice(index ,1);
                  this.priceBox.splice(index ,1);
                  this.totalPrice.splice(index ,1);
                  this.items.splice(index ,1);    
                  this.items2.splice(index ,1);    
                  this.actualizate();
            },
            insertQuantity:function(index){
                  if (this.quantityBox[index] !=undefined) {
                     this.totalQuantity[index] =Math.round(this.quantity[index] * this.quantityBox[index]);
                  }
                  if(this.price[index]!=undefined){
                     this.priceBox[index] =Math.round(this.quantityBox[index] * this.price[index]);
                     this.totalPrice[index] =Math.round(this.totalQuantity[index] * this.price[index]);
                  
                  }                   
                  this.actualizate();
            },
            insertQuantityBox:function(index){
                  if (this.quantity[index] !=undefined) {
                     this.totalQuantity[index] =Math.round(this.quantity[index] * this.quantityBox[index]);
                  }
                  if(this.price[index]!=undefined){
                     this.priceBox[index] =Math.round(this.quantityBox[index] * this.price[index]);
                  } 
                  if(this.totalQuantity[index]!=undefined){
                     this.totalPrice[index] = Math.round(this.totalQuantity[index] * this.price[index]);
                  }    
                  this.actualizate();
            },
            insertTotalQuantity:function(index){
                  if (this.quantityBox[index] !=undefined && this.quantityBox[index]>0) {
                     this.quantity[index] =Math.round(this.totalQuantity[index] / this.quantityBox[index]);
                  }
                  this.insertQuantity(index);
            },
            insertPrice:function(index){
                  if(this.totalQuantity[index]!=undefined){
                     this.totalPrice[index] = Math.round(this.totalQuantity[index] * this.price[index]);
                  }
                  if (this.quantityBox[index]!=undefined) {
                     this.priceBox[index] = Math.round(this.quantityBox[index] * this.price[index]);
                  }
                  this.actualizate();
            },
            insertPriceBox:function(index){
                  if (this.quantityBox[index] != undefined && this.quantityBox[index]>0) {
                     this.price[index] = Math.round(this.priceBox[index] / this.quantityBox[index]  );
                  }
                  if(this.totalQuantity[index]!=undefined){
                     this.totalPrice[index] = Math.round(this.totalQuantity[index] * this.price[index]);
                  }
                  this.actualizate();
               
            },
            insertTotalPrice:function(index){
                  if(this.totalQuantity[index] > 0 ){
                     this.price[index] = Math.round(this.totalPrice[index] / this.totalQuantity[index]);
                     this.priceBox[index] =Math.round(this.quantityBox[index] * this.price[index]);
                  }
      
                  this.actualizate();
            },
            actualizate:function(){
                  this.sumTotal();
            },
            sumTotal:function(){
                  total=0;
                  this.totalPrice.forEach(element => {
                     total += Number(element);
                  });
                  this.total_sale = total;                             
            },
            
         }
      }

      
   </script>
</div>
 
