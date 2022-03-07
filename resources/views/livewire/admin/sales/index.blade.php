<div  id="saleMain" x-data="saleMain()" x-on:keyup.alt.n.window="isOpenNewSale = true"> 




   <x-table.table>
      <x-slot name="thead">
         <tr>
            <x-table.th>Id</x-table.th>
            <x-table.th>Nombre Cliente</x-table.th>
            <x-table.th>Fecha venta</x-table.th>
            <x-table.th>Estado pago</x-table.th>
            <x-table.th>Total</x-table.th>
            {{-- <x-table.th>Monto pagado</x-table.th>
            <x-table.th>Monto pendiente</x-table.th> --}}
            <x-table.th>Fecha pago</x-table.th>
            <x-table.th>Comentario</x-table.th>
            <x-table.th>Venta por</x-table.th>
            <x-table.th width="10"> </x-table.th>
         </tr>
      </x-slot>
      <x-slot name="tbody">
         @foreach ($sales as $sale)
            <tr>
               <x-table.td> {{$sale->id}}</x-table.td>
               <x-table.td> {{$sale->customer->name}}</x-table.td>
               
               <x-table.td> 
                  {{ Str::limit(Helper::date($sale->date)->dayName, 3, '') }}
                  {{  Helper::date($sale->date)->format('d-m-Y')}}
               </x-table.td>
               <x-table.td> 
                  <div>
                     @if ($sale->payment_status==3)
                        Pagado <i class="fas fa-check text-green-500"></i>
                     @elseif($sale->payment_status==2)
                       <div>
                           Abonado
                           ${{number_format($sale->payment_amount,0,',','.')}}
                       </div>
                       <div>
                           Pendiente
                           ${{number_format($sale->pending_amount,0,',','.')}}
                       </div>
                        
                     @elseif($sale->payment_status==1)
                        Pendiente  <i class="fas fa-exclamation text-red-500"></i>
                     @endif
                  </div>
               </x-table.td>
               <x-table.td> ${{number_format($sale->total,0,',','.')}}</x-table.td>
               {{-- <x-table.td> ${{number_format($sale->payment_amount,0,',','.')}}</x-table.td>
               <x-table.td> ${{number_format($sale->pending_amount,0,',','.')}}</x-table.td> --}}
               
               <x-table.td> {{($sale->payment_date)? Helper::date($sale->payment_date,true)->format('d-m-Y') :''}}</x-table.td>
               <x-table.td>
                  <div title="{{$sale->comment}}"> {{ Str::limit($sale->comment, 10 ,'...')}}</div>
               </x-table.td>
               <x-table.td> {{$sale->createdBy()->name}}</x-table.td>
               
               <x-table.td> 
                  <div>
                     <x-jet-secondary-button x-on:click="isOpenShowSale=true;$wire.setSale({{ $sale }})"><i class="fas fa-eye"></i></x-jet-secondary-button>

                     <a href="{{ route('admin.sales.edit', $sale->id) }}">
                        <x-jet-secondary-button><i class="fas fa-pen"></i></x-jet-secondary-button>
                        </a>

                     <x-jet-danger-button x-on:click="isOpenDeleteSale=true;$wire.setSale({{ $sale }})"><i class="fas fa-trash"></i></x-jet-secondary-button>
                  </div>
               </x-table.td>
            </tr>
         @endforeach
      </x-slot>
   </x-table.table>
    <div>
       @if ($isOpenShowSale)
          @livewire('admin.sales.show', ['sale' => $saleSelected], key('show'.$saleSelected->id))
       @endif
 
 
    
       @if ($isOpenDeleteSale)
          <div x-cloak x-show="isOpenDeleteSale">
             <x-modal.alert2>
                <x-slot name="header">
                   <div class="flex justify-between items-center">
                      <h2>Eliminar venta {{$saleSelected->id}} de {{$saleSelected->customer->name}}</h2>
                      <div class="p-2 cursor-pointer" x-on:click="isOpenDeleteSale = false"><i class="fas fa-times"></i></div>
                   </div>
                </x-slot>
                <x-slot name="body"><p class="text-lg">Seguro deseas eliminar esta venta?</p></x-slot>
                <x-slot name="footer">
                   <div class="flex justify-between items-center">
                      <x-jet-danger-button wire:click="deleteSale()">Si, eliminar</x-jet-danger-button>
                      <x-jet-button x-on:click="isOpenDeleteSale = false">No porfavorsito</x-jet-button>
                   </div>
                </x-slot>
             
             </x-modal-alert2>
          </div>
       @endif
    </div>
  
    <script>
       function saleMain(){
          return{
             isOpenNewSale: @entangle('isOpenNewSale'),
             isOpenShowSale: @entangle('isOpenShowSale'),
             isOpenEditSale: @entangle('isOpenEditSale'),
             isOpenDeleteSale: @entangle('isOpenDeleteSale'),            
          }
       }
 
       function editSale(items,items2,quantity,quantityBox,totalQuantity, price,priceBox, totalPrice, products,total_sale,supplier_id,payment_status, payment_amount, comment){
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
 
             
             startEditSale:function(){
 
                   window.addEventListener('updateProducts', event => {
                      this.products =  event.detail.products;
                      this.editProducts=true;
                      this.search = event.detail.product_name;
                   });
                   
             },
 
             editSale: function(){ 
                   this.loading=true;
                    this.showErrors = true;
                   this.$wire.editSale().then( (response)=>{
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
