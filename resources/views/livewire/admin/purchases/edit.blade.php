<div 
   id="editPurchase" 
   class="text-gray-600"
   x-data="editPurchase(@entangle('items').defer,@entangle('items2').defer,@entangle('quantity').defer,@entangle('quantityBox').defer,@entangle('totalQuantity').defer,@entangle('price').defer,@entangle('priceBox').defer,@entangle('totalPrice').defer,@js($products),@entangle('total_sale').defer,@entangle('supplier_id').defer, @entangle('payment_status').defer, @entangle('payment_amount').defer, @entangle('comment').defer)" 
   x-init="startEditPurchase()">
   <x-modal.screen2>
       {{-- <x-jet-button>Nueva Compra</x-jet-button>    --}}
       <x-slot name="header">
           <div class="flex justify-between gap-4 items-center">
               <h2 class="uppercase tracking-wide">Editar compra {{$purchase->id}}</h2>
               <div x-on:click="openEditPurchase=false" class="p-2 hover:shadow cursor-pointer">
                   <i class="fas fa-times"></i>
               </div>
           </div>
       </x-slot>  
       <x-slot name="body">
           <div class="grid grid-cols-1 lg:grid-cols-5 gap-4">
               <section class=" lg:col-span-3" >
                   {{-- PRODUCTOS --}}
                   <article>
                       <div class="w-full relative">
                           <div class="flex gap-4 items-center justify-between">
                               <x-jet-input x-on:click="open()" type="search" class="w-full p-2 border" x-model="search" placeholder="Buscar producto..."></x-jet-input>
                               <x-jet-button x-on:click="openNewProduct=true"><i class="fas fa-plus"></i></x-jet-button>
                               <div x-cloak x-show="openNewProduct">
                                   @livewire('admin.products.new-product')
                               </div>
                           </div>
                           <div x-show="showProducts" x-on:click.away="showProducts =false" class="w-full">
                               <div class="w-full bg-white border shadow absolute z-10 ">
                                   <div class="flex justify-between px-2 bg-gray-100 items-center gap-4">
                                       <h2 class="font-bold">Lista de productos</h2>
                                       <div x-on:click="close" class="p-2 px-4 rounded   cursor-pointer transform hover:scale-125">
                                           <i class="fas fa-times"></i>
                                       </div>
                                   </div>   
                                   
                                   <ul class="max-h-96  bg-white w-full overflow-auto shadow-2xl" >
                                       <template x-if="filteredProducts.length == 0">
                                           <li class="hover:bg-red-200 text-red-600 p-2 w-full overflow-auto">
                                               No se encuentran productos relacionados con '<span x-text="search"></span>'
                                           </li>
                                       </template>
                                       <template x-for="(product, index) in filteredProducts" :key="product.id">
                                           <li>
                                               <div class="hover:bg-gray-100  py-2 relative border-b" :class="{'hover:bg-green-100 text-green-600': items2.includes(product.id)}">
                                                   <div  x-on:click="addItem(product)" class=" absolute  inset-0 cursor-pointer" :class="{'hidden':items2.includes(product.id)}"></div>
                                                   <div class="flex items-center justify-between gap-2 pr-4">
                                                       <div class=" p-2 " x-text="product.name"></div>
                                                     
                                                       <div class="flex justify-between items-center gap-4">
                                                           <div> stock </div>
                                                           <span class="" x-html="product.stock"></span>
                                                           <template x-if="totalQuantity[items.indexOf(product)]>0">
                                                               <div class="flex items-center text-green-600 ">
                                                               (Nuevo stock <span class="pl-2" x-text="number_format(Number(product.stock) + Number(totalQuantity[items.indexOf(product)]))"></span>)
                                                               </div>
                                                           </template>
                                                       </div>                                                   
                                                           
                                                   </div>
                                                   <div  class="px-2 flex gap-4 justify-between items-center w-full overflow-auto" >
                                                      
                                                       <template x-if="items2.includes(product.id)">
                                                           <div class="text-sm flex items-end justify-between gap-1 w-full text-green-600">
                                                               
                                                               <div class="flex flex-col">
                                                                   Cantidad
                                                                   <x-jet-input x-on:change="insertQuantity(items2.indexOf(product.id))" x-on:keyup="insertQuantity(items2.indexOf(product.id))" type="number" x-model="quantity[items2.indexOf(product.id)]"   min="1" class="p-1 w-20" value=""></x-jet-input>
                                                               </div>
                                                               <div class="flex flex-col">
                                                                   Cantidad por caja
                                                                   <x-jet-input x-on:change="insertQuantityBox(items2.indexOf(product.id))" x-on:keyup="insertQuantityBox(items2.indexOf(product.id))" type="number"  x-model="quantityBox[items2.indexOf(product.id)]"  min="1" class="p-1 w-20"></x-jet-input>
                                                               </div>
                                                               <div class="flex flex-col">
                                                                   Cantidad Total
                                                                   <x-jet-input x-on:change="insertTotalQuantity(items2.indexOf(product.id))" x-on:keyup="insertTotalQuantity(items2.indexOf(product.id))" type="number"  x-model="totalQuantity[items2.indexOf(product.id)]"  min="1" class="p-1 w-20"></x-jet-input>
                                                               </div>
                                                               <div class="flex flex-col">
                                                                   Precio
                                                                   <x-jet-input x-on:change="insertPrice(items2.indexOf(product.id))" x-on:keyup="insertPrice(items2.indexOf(product.id))" type="number" x-model="price[items2.indexOf(product.id)]"  min="1" class="p-1 w-20" value=""></x-jet-input>
                                                               </div>
                                                               <div class="flex flex-col">
                                                                   Precio por caja
                                                                   <x-jet-input x-on:change="insertPriceBox(items2.indexOf(product.id))" x-on:keyup="insertPriceBox(items2.indexOf(product.id))" type="number" x-model="priceBox[items2.indexOf(product.id)]"  min="1" class="p-1 w-20" value=""></x-jet-input>
                                                               </div>
                                                               <div class="flex flex-col">
                                                                   Precio total
                                                                   <x-jet-input x-on:change="insertTotalPrice(items2.indexOf(product.id))" x-on:keyup="insertTotalPrice(items2.indexOf(product.id))" type="number" x-model="totalPrice[items2.indexOf(product.id)]"  min="1" class="p-1 w-24" value=""></x-jet-input>
                                                               </div>
                                                               <div x-on:click="removeItem(items2.indexOf(product.id))" class="cursor-pointer text-red-600 hover:text-red-700 p-4" ><i class="fas fa-trash"></i></div>
                                                           </div>
                                                       </template>
                                                   </div>
                                               </div>
                                           </li>
                                       </template>
                                   </ul>
                               </div>
                           </div>

                           <template x-if="!items.length>0">
                               <h3 class="my-2 p-2">No hay productos agregados</h3> 
                           </template>

                           <div class="mt-4">
                               
                                <template x-if="items.length>0">
                                    <x-table.table>
                                        <x-slot name='title'>Items Agregados</x-slot>
                                        <x-slot name='thead'>
                                            <tr>
                                                <x-table.th>  Item </x-table.th>
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
                                            <template x-for="(item, index) in items" :key="index">
                                                <tr class="w-full overflow-auto bg-white">
                                                    <x-table.td>
                                                        <span class="" x-text="index+1"></span>
                                                    </x-table.td>
                                                    <x-table.td>
                                                        <div class="flex flex-col">
                                                            <span class="" x-text="item.name"></span>
                                                            <div class="flex items-center">
                                                                <span class="p-2" x-text="item.stock"></span>
                                                                <div class="flex items-center text-green-600 ">
                                                                    (<span x-text="number_format(Number(item.stock) + Number(totalQuantity[index]))"></span>)
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </x-table.td>
                                                    <x-table.td>
                                                        <x-jet-input x-on:change="insertQuantity(index)" x-on:keyup="insertQuantity(index)" type="number"  x-model="quantity[index]"  min="1" class="p-1 w-20"></x-jet-input>
                                                        <template x-if="( (quantity[index]=='' || quantity[index]==0 ) && showErrors)">
                                                            <div class="text-red-600 text-sm p-1 rounded absolute ">* cantidad</div> 
                                                        </template> 
                                                    </x-table.td>
                                                    <x-table.td>
                                                        <x-jet-input x-on:change="insertQuantityBox(index)" x-on:keyup="insertQuantityBox(index)" type="number"  x-model="quantityBox[index]"  min="1" class="p-1 w-20"></x-jet-input>
                                                        <template x-if="( (quantityBox[index]=='' || quantityBox[index]==0 ) && showErrors)">
                                                            <div class="text-red-600 text-sm p-1 rounded absolute ">*cantidad x caja</div> 
                                                        </template>  
                                                    </x-table.td>
                                                    <x-table.td>
                                                        <span x-text="number_format(totalQuantity[index])"></span> k.
                                                        
                                                    </x-table.td>
                                                    <x-table.td>
                                                        <x-jet-input x-on:change="insertPrice(index)" x-on:keyup="insertPrice(index)" type="number" x-model="price[index]"  min="1" class="p-1 w-20" value=""></x-jet-input>
                                                        <template x-if="( (price[index]=='' || price[index]==0 ) && showErrors)">
                                                            <div class="text-red-600 text-sm p-1 rounded absolute ">*precio</div> 
                                                        </template>    
                                                    </x-table.td>
                                                    <x-table.td>
                                                        <x-jet-input x-on:change="insertPriceBox(index)" x-on:keyup="insertPriceBox(index)" type="number" x-model="priceBox[index]"  min="1" class="p-1 w-20" value=""></x-jet-input>
                                                        <template x-if="( (priceBox[index]=='' || priceBox[index]==0 ) && showErrors)">
                                                            <div class="text-red-600 text-sm p-1 rounded absolute ">*Precio x caja</div> 
                                                        </template>   
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
                            </div>
                          
                           {{-- <template x-if="items.length>0">
                               <div class="w-full overflow-auto border my-4 bg-gray-50">
                                   <h3 class="my-2 p-2 font-bold tracking-wide">Items agregados</h3>
                                  
                                   <ul class="w-full overflow-auto bg-white">
                                       <template x-for="(item, index) in items" :key="index">
                                       
                                           <li class="hover:bg-gray-100 pb-7 border-b">
                                          
                                                <div class="p-1 flex gap-4 items-center justify-between mr-6 tracking-wide">
                                                    <div>
                                                        <span class="" x-text="index+1"></span>-
                                                        <span class="" x-text="item.name"></span>
                                                    </div>
                                                    <div class="flex items-center gap-1">
                                                        
                                                        stock
                                                        <span class="" x-text="number_format(item.stock)"></span>
                                                        <div class="text-green-600" >
                                                            (<span x-text="number_format(Number(item.stock) + Number(totalQuantity[index]))"></span>)
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                               <div class="text-sm flex items-end p-1 justify-between gap-1 w-full overflow-auto md:pb-0">
                                                  
                                                   <div class="">
                                                       <div class="flex flex-col">
                                                           Cantidad
                                                           <x-jet-input x-on:change="insertQuantity(index)" x-on:keyup="insertQuantity(index)" type="number"  x-model="quantity[index]"  min="1" class="p-1 w-20"></x-jet-input>
                                                       </div>
                                                       <template x-if="( (quantity[index]=='' || quantity[index]==0 ) && showErrors)">
                                                           <div class="text-red-600 text-sm p-1 rounded absolute bg-red-100">Ingresa cantidad</div> 
                                                       </template>                                                       
                                                   </div>
                                                   <div class="">
                                                       <div class="flex flex-col">
                                                           Cantidad por caja
                                                           <x-jet-input x-on:change="insertQuantityBox(index)" x-on:keyup="insertQuantityBox(index)" type="number"  x-model="quantityBox[index]"  min="1" class="p-1 w-20"></x-jet-input>
                                                       </div>
                                                       <template x-if="( (quantityBox[index]=='' || quantityBox[index]==0 ) && showErrors)">
                                                           <div class="text-red-600 text-sm p-1 rounded absolute bg-red-100">Ingresa cantidad por caja</div> 
                                                       </template>                                                       
                                                   </div>
                                                   <div class="">
                                                       <div class="flex flex-col">
                                                           Cantidad Total
                                                           <x-jet-input x-on:change="insertTotalQuantity(index)" x-on:keyup="insertTotalQuantity(index)" type="number"  x-model="totalQuantity[index]"  min="1" class="p-1 w-20"></x-jet-input>
                                                       </div>
                                                       <template x-if="( (totalQuantity[index]=='' || totalQuantity[index]==0 ) && showErrors)">
                                                           <div class="text-red-600 text-sm p-1 rounded absolute bg-red-100">Ingresa cantidad total</div> 
                                                       </template>                                                       
                                                   </div>
                                                   <div>
                                                       <div class="flex flex-col">
                                                           Precio
                                                           <x-jet-input x-on:change="insertPrice(index)" x-on:keyup="insertPrice(index)" type="number" x-model="price[index]"  min="1" class="p-1 w-20" value=""></x-jet-input>
                                                       </div>
                                                       <template x-if="( (price[index]=='' || price[index]==0 ) && showErrors)">
                                                           <div class="text-red-600 text-sm p-1 rounded absolute bg-red-100">Ingresa precio</div> 
                                                       </template>
                                                   </div>
                                                   <div>
                                                       <div class="flex flex-col">
                                                           Precio por caja
                                                           <x-jet-input x-on:change="insertPriceBox(index)" x-on:keyup="insertPriceBox(index)" type="number" x-model="priceBox[index]"  min="1" class="p-1 w-20" value=""></x-jet-input>
                                                       </div>
                                                       <template x-if="( (priceBox[index]=='' || priceBox[index]==0 ) && showErrors)">
                                                           <div class="text-red-600 text-sm p-1 rounded absolute bg-red-100">Ingresa Precio por caja</div> 
                                                       </template>
                                                   </div>
                                           
                                                   <div>
                                                       <div class="flex flex-col">
                                                           Precio total
                                                           <x-jet-input x-on:change="insertTotalPrice(index)" x-on:keyup="insertTotalPrice(index)" type="number" x-model="totalPrice[index]"  min="1" class="p-1 w-24" value=""></x-jet-input>
                                                       </div>
                                                       <template x-if="( (totalPrice[index]=='' || totalPrice[index]==0 ) && showErrors)">
                                                           <div class="text-red-600 text-sm p-1 rounded absolute bg-red-100">Ingresa precio total</div> 
                                                       </template>
                                                   </div>
                                                   <div x-on:click="removeItem(index)" class="cursor-pointer text-red-600 hover:text-red-700 p-4" ><i class="fas fa-trash"></i></div>
                                               </div>
                                           </li>
                                       </template>
                                   </ul>
                               </div>    
                           </template> --}}
                       </div>
                   </article>
               </section>
               <section class="border  lg:col-span-2">
                   {{-- total --}}
                   <article class="p-8 text-2xl bg-yellow-400 text-white font-bold text-center">
                       TOTAL $<span x-text="number_format(total_sale)"></span>
                   </article>
                   {{-- proveedor --}}
                   <article>
                       <div class="flex items-center gap-1 justify-between my-2 px-2">
                           <div class="w-32">Proveedor</div>
                           <div class="flex items-center gap-4 flex-1">
                               <select x-model="supplier_id" x-on:change="$wire.saveSupplierId(supplier_id)" class="w-full">
                                   <option value="">Selecciona un proveedor</option>
                                   @foreach ($suppliers as $supplier)
                                       <option  value="{{$supplier->id}}" @if($supplier->id == $supplier_id ) selected @endif>{{$supplier->name}}</option>
                                   @endforeach
                               </select>
                   
                               <div id="newSupplier" x-data="{name:'', address:'', rut:'', rs:'', comment:'' }" class="max-w-lg">
                                   <x-modal.screen>
                                   <x-jet-button><i class="fas fa-plus"></i></x-jet-button>
                                   <x-slot name="header">
                                       <div>
                                           Nuevo Proveedor
                                       </div>
                                   </x-slot>
                                   <x-slot name="body">
                                       <div>
                                           Nombre
                                           <x-jet-input x-model="name" class="w-full border shadow h-10"></x-jet-input>
                                           Direccion
                                           <x-jet-input x-model='address' class="w-full border shadow h-10"></x-jet-input>
                                           Rut
                                           <x-jet-input x-model='rut' class="w-full border shadow h-10"></x-jet-input>
                                           Rason social
                                           <x-jet-input x-model='rs' class="w-full border shadow h-10"></x-jet-input>
                                           Comentario
                                           <x-jet-input x-model='comment' class="w-full border shadow h-10"></x-jet-input>
                                           
                                       </div>
                                   </x-slot>
                                   <x-slot name="footer">
                                       <x-jet-button x-on:click="$wire.saveSupplier(name, address, rut, rs, comment)
                                       .then(()=>{
                                           show=false;
                                           name=address=rut=rs=comment='';
                                           toast({title:'Se ha creado el proveedor!!'});
                                       })">Crear</x-jet-button>
                                       
                                   </x-slot>
                                   </x-modal.screen>
                               </div>
                           </div>
                       
                       </div>
                       @error('supplier_id')
                           <div class="text-red-600 text-sm p-2">{{$message}}</div>
                       @enderror

                   </article>
                   {{-- fecha --}}
                   <article>
                       <div class="flex items-center gap-1 justify-between my-2 px-2">
                           <div class="w-32">Fecha</div>
                           <div class="flex-1"><x-jet-input class="w-full" type="date" wire:model='date' ></x-jet-input></div>
                       </div>
                       @error('date')
                           <div class="text-red-600 text-sm p-2">{{$message}}</div>
                       @enderror
                   </article>
                   {{-- Estado de pago --}}
                   <article>
                       <div class="mt-4 flex gap-x-2 items-center">
                           <div class="w-32 ml-2">Estado de pago</div>
                           <label class="cursor-pointer block hover:bg-gray-200 p-2" :class="{'bg-gray-800 text-white hover:bg-gray-900' : (payment_status==1)}">
                               Pendiente
                               <x-jet-input class="mt-4 px-3 hidden" type="radio" x-model="payment_status" value="1" ></x-jet-input>
                           </label>
                           <label class="cursor-pointer block hover:bg-gray-200 p-2" :class="{'bg-gray-800 text-white hover:bg-gray-900' : (payment_status==2)}">
                               Abonado
                               <x-jet-input class="mx-4 px-3 hidden" type="radio" x-model="payment_status" value="2" ></x-jet-input>
                           </label>
                           <label  class="cursor-pointer block hover:bg-gray-200 p-2" :class="{'bg-gray-800 text-white hover:bg-gray-900' : (payment_status==3)}">
                               Pagado
                               <x-jet-input class="mx-4 px-3 hidden" type="radio" x-model="payment_status" value="3"  ></x-jet-input>
                           </label>
                       </div>
                       @error('payment_status')
                           <span class="text-sm text-red-600 px-2">{{$message}}</span>
                       @enderror
                       <template x-if="payment_status == 2">
                           <div class="p-2" wire:ignore>
                               <x-jet-input  type="number" x-model="payment_amount" class="w-full" placeholder="Ingresa monto de abono"></x-jet-input>
                               <div>
                                   @error('payment_amount')
                                       <span class="text-red-600 text-sm p-2">{{$message}}</span>
                                   @enderror
                               </div>
                           </div>
                       </template>
                   </article>
                   {{-- COMENTARIO --}}
                   <article>
                       <div class="mt-4 flex gap-x-2 items-center">
                           <div class="w-32 ml-2">Comentario</div>
                           <div class="p-2 w-full">
                               <textarea x-model="comment"  class="w-full"></textarea>
                           </div>
                          
                       </div>
                   </article>
                   <div class="flex items-center gap-4 justify-end p-2">
                    <x-jet-button x-on:click="editPurchase()">Editar Compra</x-jet-button>
                    <div x-show="loading">cargando...</div>
                </div>       
               </section>
           </div>
       </x-slot>
   </x-modal.screen2> 
</div>   
