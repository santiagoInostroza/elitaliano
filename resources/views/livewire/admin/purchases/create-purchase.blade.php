<div class="text-gray-500" id="createNewPurchase" x-data="newPurchase()" x-init="startNewPurchase()">
    <div class="grid grid-cols-1 lg:grid-cols-7 gap-x-2">

        <section class="lg:col-span-5 grid gap-y-2" >

            {{-- PRODUCTOS --}}
            <article>
                <div class="relative z-10">
                    <div class="flex gap-4 items-center justify-between">
                        <x-jet-input x-on:click="open()" x-on:keyup.debounce="open()" type="search" class="w-full" x-model="search" placeholder="Buscar producto..."></x-jet-input>
                        <x-jet-button x-on:click="isOpenNewProduct = true" title="Crear Producto Nuevo"><i class="fas fa-plus"></i></x-jet-button>
                        <div x-cloak x-show="isOpenNewProduct">
                            @livewire('admin.products.new-product')
                        </div>
                    </div>
                    
                    <div x-show="showProducts"  x-on:click.away="close()" x-transition:enter.scale.1 >
                        <div class="w-full bg-white border shadow absolute rounded z-10 ">
                            <ul class="max-h-64  bg-white w-full overflow-auto shadow-2xl" >
                                <template x-if="filteredProducts.length == 0">
                                    <li class="hover:bg-red-200 text-red-600 p-2 w-full overflow-auto">
                                        No se encuentran productos relacionados con '<span x-text="search"></span>'
                                    </li>
                                </template>
                                
                                
                                <template x-for="(product, index) in filteredProducts" :key="product.id">
                                    <li wire:ignore>
                                        <div class="hover:bg-gray-100 relative border-b p-2" :class="{'hover:bg-green-200 bg-green-100 text-green-600': items2.includes(product.id) }">
                                            <div class="flex items-center justify-between gap-1 relative"  >
                                                <div class="flex items-center gap-1">
                                                    <div  x-on:click="addItem(product)" class=" absolute  inset-0 cursor-pointer" :class="{'hidden':items2.includes(product.id)}"></div>
                                                    <div class="flex items-center gap-1"> 
                                                        <figure class="w-10">
                                                            <img class="w-10" src="{{asset('images/products/sin_imagen.png')}}" alt="">
                                                        </figure>
                                                        <div class="" x-text="product.name"></div>
                                                    </div>
                                                
                                                    (stock <span x-text="product.stock"></span>)
                                                </div>
                                                <div class="flex items-center gap-1">    
                                                    <template x-if="items2.includes(product.id)">
                                                        <div x-on:click="removeItem(items2.indexOf(product.id))" class="cursor-pointer text-red-600 hover:text-red-700 p-1" ><i class="fas fa-trash"></i></div>
                                                    </template>
                                                </div> 
                                            </div>
                                            
                                        </div>
                                    </li>
                                </template>
                            </ul>
                        </div>
                    </div>                        
                </div>
            </article>

            {{-- ITEMS AGREGADOS --}}
            <article class="shadow bg-white border rounded overflow-auto" style="height: calc(100vh - 215px);">
                <template x-if="!items.length>0">
                    <div>
                        <h3 class=" p-4 pb-2 uppercase">No hay productos agregados</h3> 
                        <template x-if="(showErrors)">
                            <div class="text-red-600 text-sm px-4 rounded absolute ">*Selecciona productos para crear una venta</div> 
                        </template>  
                    </div>
                </template>


                <template x-if="items.length>0">
                    <x-table.table>


                        <x-slot name='thead'>
                            <tr>
                                <x-table.th>  Nombre </x-table.th>
                                <x-table.th>  Cantidad </x-table.th>
                                <x-table.th>  Cxcaja </x-table.th>
                                <x-table.th>  CTotal </x-table.th>
                                <x-table.th>  Precio </x-table.th>
                                <x-table.th>  Pxcaja </x-table.th>
                                <x-table.th>  Ptotal </x-table.th>
                                <x-table.th>  </x-table.th>
                            </tr>
                        </x-slot>


                        <x-slot name='tbody'>
                            <template x-for="(item, index) in items" :key="'items_agregados_'+ index">
                                <tr class="w-full bg-white p-1">
                                    <x-table.td>
                                        <div wire:ignore class="flex flex-col">
                                            <div class="flex items-center gap-2">
                                                <figure class="w-12">
                                                    <img class="w-12" src="{{asset('images/products/sin_imagen.png')}}" alt="">
                                                </figure>
                                                <div class="flex flex-col">
                                                    <div class="flex items-center gap-1">
                                                        <span class="" x-text="item.name"></span>
                                                        {{-- <span title="Fecha de compra" class="" x-text="item.purchase.date"></span> --}}
                                                    </div>
                                                    <div class="flex items-center gap-1">
                                                        Stock
                                                        <span title="Stock" class="" x-text="item.stock"></span>
                                                        <div class="flex items-center ">
                                                            (<span title="Stock despues de ingresar la venta" x-text="number_format(Number(item.stock) + Number(totalQuantity[index]))"></span>)
                                                        </div>
                                                    </div>

                                                    <div class="flex items-center gap-1 hidden">
                                                        Costo
                                                        $<span title="Costo" class="" x-text="number_format(item.price)"></span>
                                                        
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </x-table.td>
                                    
                                    <x-table.td>
                                        <div class="relative">
                                            <x-jet-input x-on:change="insertQuantity(index)" x-on:keyup="insertQuantity(index)" type="number"  x-model="quantity[index]"  min="1" class="p-1 w-20"></x-jet-input>
                                            <template x-if="( (quantity[index]=='' || quantity[index]==0 ) && showErrors)">
                                                <div class="text-red-600 text-sm p-1 rounded absolute ">* Cantidad</div> 
                                            </template> 
                                        </div>
                                    </x-table.td>
                                    <x-table.td>
                                        <div class="relative">
                                            <x-jet-input x-on:change="insertQuantityBox(index)" x-on:keyup="insertQuantityBox(index)" type="number"  x-model="quantityBox[index]"  min="1" class="p-1 w-20"></x-jet-input>
                                            <template x-if="( (quantityBox[index]=='' || quantityBox[index]==0 ) && showErrors)">
                                                <div class="text-red-600 text-sm p-1 rounded absolute ">*Cantidad x caja</div> 
                                            </template>  
                                        </div>
                                    </x-table.td>
                                    <x-table.td>
                                        <div class="relative">
                                            <span x-text="number_format(totalQuantity[index])"></span> k.
                                           
                                        </div> 
                                    </x-table.td>
                                    <x-table.td>
                                        <div class="relative">
                                            <x-jet-input x-on:change="insertPrice(index)" x-on:keyup="insertPrice(index)" type="number" x-model="price[index]"  min="1" class="p-1 w-20" value=""></x-jet-input>
                                            <template x-if="( (price[index]=='' || price[index]==0 ) && showErrors)">
                                                <div class="text-red-600 text-sm p-1 rounded absolute ">* Precio</div> 
                                            </template>   
                                        </div> 
                                    </x-table.td>
                                    <x-table.td>
                                        <div class="relative">
                                            <x-jet-input x-on:change="insertPriceBox(index)" x-on:keyup="insertPriceBox(index)" type="number" x-model="priceBox[index]"  min="1" class="p-1 w-20" value=""></x-jet-input>
                                            <template x-if="( (priceBox[index]=='' || priceBox[index]==0 ) && showErrors)">
                                                <div class="text-red-600 text-sm p-1 rounded absolute ">*Precio x caja</div> 
                                            </template> 
                                        </div>  
                                    </x-table.td>
                                    <x-table.td>
                                        $<span  x-text="number_format(totalPrice[index])" ></span>
                                    </x-table.td>
                                    <x-table.td>
                                        <div x-on:click="removeItem(index)" class="cursor-pointer text-red-600 hover:text-red-700 p-4" ><i class="fas fa-trash"></i></div>
                                    </x-table.td>
                                </tr>
                            </template>
                        </x-slot>
                    </x-table.table>  
                </template>
            </article>

        </section>

        <section class="lg:col-span-2">

            {{-- total --}}
            <article class="shadow bg-white border rounded h-20 mb-2">
                <div class="flex justify-between gap-2 items-center p-1 border h-full">
                    <div class="text-xl uppercase">Total</div>
                    <div class="text-2xl">$<span x-text="number_format(totalSale)"></span></div>
                </div>
            </article> 

            {{-- Datos compra --}}
            <article class="overflow-auto" style="height: calc(100vh - 253px);">
                <div class="bg-white shadow  border rounded">
                    <div x-on:click="isOpenPurchaseData = !isOpenPurchaseData">
                        <div class="flex justify-between gap-1 items-center cursor-pointer p-2 border rounded">
                            <div>Datos de compra</div>
                            <div>
                                <div x-show="!isOpenPurchaseData"><i class="fas fa-angle-down"></i></div>
                                <div x-show="isOpenPurchaseData"><i class="fas fa-angle-up"></i></div>
                            </div>
                        </div>
                    </div>
                    <div x-cloak x-show="isOpenPurchaseData" x-transition>
                        <div class="p-2 pt-4 ">
                            {{-- PROVEEDOR --}}
                            <div class="py-2">
                                <div>Nombre</div>
                                <div class="flex items-center gap-1">
                                    <x-jet-button x-on:click="isOpenNewSupplier = true" title="Crear Proveedor Nuevo"><i class="fas fa-user-plus"></i></x-jet-button>
                                    <select x-model="supplier_id" x-on:change="$wire.saveSupplierId(supplier_id)" class="w-full p-1 rounded border-gray-200 shadow">
                                        <option value="">Selecciona un proveedor</option>
                                        @foreach ($suppliers as $supplier)
                                            <option  value="{{$supplier->id}}" @if($supplier->id == $supplier_id ) selected @endif>{{$supplier->name}}</option>
                                        @endforeach
                                    </select>
                        
                                    <div x-cloak x-show="isOpenNewSupplier">
                                        @livewire('admin.suppliers.new-supplier', key('newSupplier'))
                                    </div>
                                </div>
                                @error('supplier_id')
                                    <div class="text-red-600 text-sm">{{$message}}</div>
                                @enderror
                            </div>

                            {{-- FECHA --}}
                            <div class="py-2">
                                <div class="w-32">Fecha</div>
                                <div><x-jet-input class="w-full p-1 shadow" type="date" wire:model='date' ></x-jet-input></div> 
                                @error('date')
                                    <div class="text-red-600 text-sm">{{$message}}</div>
                                @enderror
                            </div>

                            {{-- ESTADO DE PAGO --}}
                            <div class="py-2">
                                <div class="">Estado de pago</div>
                                <div class="border rounded p-1">
                                    <div class="gap-x-1  inline-flex items-center rounded-md font-semibold text-xs  uppercase tracking-widest   disabled:opacity-25 transition">
                                        <label class="cursor-pointer block hover:bg-gray-200 px-4 py-2 rounded border border-transparent  focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300" :class="{'bg-green-300 text-white hover:bg-green-400' : (payment_status==1)}">
                                            Pendiente
                                            <x-jet-input class="mt-4 px-3 hidden" type="radio" x-model="payment_status" value="1" ></x-jet-input>
                                        </label>
                                        <label class="cursor-pointer block hover:bg-gray-200 px-4 py-2 rounded border border-transparent  focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300" :class="{'bg-green-300 text-white hover:bg-green-400' : (payment_status==2)}">
                                            Abonado
                                            <x-jet-input class="mx-4 px-3 hidden" type="radio" x-model="payment_status" value="2" ></x-jet-input>
                                        </label>
                                        <label  class="cursor-pointer block hover:bg-gray-200 px-4 py-2 rounded border border-transparent  focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300" :class="{'bg-green-300 text-white hover:bg-green-400' : (payment_status==3)}">
                                            Pagado
                                            <x-jet-input class="mx-4 px-3 hidden" type="radio" x-model="payment_status" value="3"  ></x-jet-input>
                                        </label>
                                    </div>
                                    <template x-if="payment_status == 2">
                                        <div class="p-2" >
                                            <x-jet-input  type="number" x-model="payment_amount" class="w-full" placeholder="Ingresa monto de abono"></x-jet-input>
                                            <div>
                                                @error('payment_amount')
                                                    <span class="text-red-600 text-sm p-2">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </template>
                                </div>
                                @error('payment_status')
                                    <span class="text-sm text-red-600">{{$message}}</span>
                                @enderror
                               
                            </div>

                            {{-- COMENTARIO --}}
                            <div class="py-2">
                                <div class="">Comentario</div>
                                <textarea x-model="comment"  class="w-full h-8  rounded border-gray-200"></textarea>
                               
                            </div>

                        </div>
                    </div>
                </div>
            </article>
            
        </section>

    </div> 

    <div class="flex items-center gap-4 p-2">

        <x-jet-button x-on:click="createPurchase()">
            Crear Compra
            <div x-show="loading">
                <i class="animate-spin fas fa-spinner" viewBox="0 0 24 24"></i>
            </div>
        </x-jet-button>
        
    </div>   
    <script>
        function newPurchase(){
            return {
                insert:[],
                insertTemp:false,
                isOpenNewSupplier:false,
                isOpenNewProduct:false,
                isOpenPurchaseData:@entangle('isOpenPurchaseData'),
                search:'',
                loading:false, 
                showProducts:false,
                showErrors:false,

                items:[],
                items2:[],
                quantity:[],
                quantityBox:[],
                totalQuantity:[],
                price:[],
                priceBox:[],
                totalPrice:[],

                totalSale:0,
                totalSaleFormat:0,

                products: @js($products),
                supplier_id:@entangle('supplier_id'),
                payment_status: @entangle('payment_status'),
                payment_amount: @entangle('payment_amount').defer,
                comment: @entangle('comment').defer,

                createPurchase: function(){ 
                    this.loading=true;
                    this.showErrors = true;
                    this.$wire.createPurchase().then( (response)=>{
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
                    this.close();
                    this.quantity[this.items.length]='';
                    this.quantityBox[this.items.length]='';
                    this.totalQuantity[this.items.length]='';
                    this.price[this.items.length]='';
                    this.priceBox[this.items.length]='';
                    this.totalPrice[this.items.length]='';

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
                        console.log('entra');
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
                startNewPurchase:function(){
                    
                    this.items=@js($items);
                    this.items2=@js($items2);
                    this.quantity=@js($quantity);
                    this.quantityBox=@js($quantityBox);
                    this.totalQuantity=@js($totalQuantity);
                    this.price=@js($price);
                    this.priceBox=@js($priceBox);
                    this.totalPrice=@js($totalPrice);
                    this.totalSale=@js($totalSale);

                    window.addEventListener('updateProducts', event => {
                        this.products =  event.detail.products;
                        this.showProducts=true;
                        this.search = event.detail.product_name;
                    });

                    console.log(this.items);
                    
                },
                actualizate:function(){
                    this.sumTotal();
                    @this.totalSale = this.totalSale;
                    @this.items=this.items;  
                    @this.items2=this.items2;  
               
                    @this.quantity = this.quantity;
                    @this.quantityBox = this.quantityBox;
                    @this.totalQuantity = this.totalQuantity;
                    @this.price = this.price;
                    @this.priceBox = this.priceBox;
                    @this.totalPrice = this.totalPrice;
                    @this.saveSession();

                },
                sumTotal:function(){
                    total=0;
                    this.totalPrice.forEach(element => {
                        total += Number(element);
                    });
                    this.totalSale = total;                
                    this.totalSaleFormat = number_format(total);                
                },
                
            }
        }
    </script>
</div>   

