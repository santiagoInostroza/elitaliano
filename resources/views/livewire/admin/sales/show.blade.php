<div>
    <x-modal.screen2>
      <x-slot name="header">
         <div class="flex justify-between items-center">
            <h2>Venta {{$sale->id}} </h2>  
            <div class="p-2 cursor-pointer" wire:click="$emit('closeShowSale')"><i class="fas fa-times"></i></div>
         </div>
      </x-slot>
      <x-slot name="body">
         <div class="grid grid-cols-1 lg:grid-cols-2 mb-4">
            <div class="grid grid-cols-3">
               <div class="font-bold "> Cliente:</div>
               <div class="col-span-2"> {{$sale->customer->name}} </div>
            </div>
            <div class="grid grid-cols-3">
               <div class="font-bold">Total:</div>
               <div class="col-span-2"> ${{number_format($sale->total,0,',','.')}} </div>
            </div>
            <div class="grid grid-cols-3">
               <div class="font-bold"> Fecha de venta:</div>
               <div class="col-span-2">{{Str::ucfirst(Helper::date($sale->date)->dayName) }} {{ Helper::date($sale->date)->format('d-m-Y')}} </div>
            </div>
            <div class="grid grid-cols-3">
               <div class="font-bold">Venta ingresada por:</div>
               <div class="col-span-2"> {{$sale->createdBy()->name}} </div>
            </div>
           
            <div class="grid grid-cols-3">
               <div class="font-bold">Estado de pago:</div>
               <div class="col-span-2"> 
                  @if ($sale->payment_status==1)
                     Pendiente
                  @elseif($sale->payment_status==2)
                     Abonado ${{number_format($sale->payment_amount,0,',','.')}}
                  @elseif($sale->payment_status==3)
                     Pagado 
                  @endif   
               </div>
            </div>
            
            @if($sale->payment_status!=3)
            
               <div class="grid grid-cols-3">
                  <div class="font-bold"> Monto pendiente :</div>
                  <div class="col-span-2">${{number_format($sale->pending_amount,0,',','.')}}  </div>
               </div>
            @endif  

            @if($sale->payment_status==3)
               <div class="grid grid-cols-3">
                  <div class="font-bold">Compra pagada el:</div>
                  <div class="col-span-2">
                      {{Str::ucfirst(Helper::date($sale->payment_date)->dayName) }} {{ Helper::date($sale->payment_date, true)->format('d-m-Y H:i:s')}} 
                  </div>
               </div>
            @endif  
            
         
            
            @if($sale->comment!="")
               <div class="grid grid-cols-3">
                  <div class="font-bold"> Comentario:</div>
                  <div class="col-span-2"> {{$sale->comment}} </div>
               </div>
            @endif   
            
         </div>

         <hr>

         <div>
            <x-table.table>
               {{-- <x-slot name="title"></x-slot>
               <x-slot name="subtitle"></x-slot> --}}
               <x-slot name="thead">
                  <tr>
                     <x-table.th><div>Item</div></x-table.th>
                     <x-table.th><div>Nombre</div></x-table.th>
                     <x-table.th><div>Cantidad</div></x-table.th>
                     <x-table.th><div>Cantidad por caja</div></x-table.th>
                     <x-table.th><div>Cantidad total</div></x-table.th>
                     <x-table.th><div>Precio</div></x-table.th>
                     <x-table.th><div>Precio por caja</div></x-table.th>
                     <x-table.th><div>Precio total</div></x-table.th>       
                  </tr>
               </x-slot>
               <x-slot name="tbody">
                  @foreach ($sale->saleItems as $item)
                     <tr>
                        <x-table.td><div>{{$loop->iteration}}</div></x-table.td>
                        <x-table.td><div>{{$item->product->name}}</div></x-table.td>
                        <x-table.td><div>{{$item->quantity}}</div></x-table.td>
                        <x-table.td><div>{{$item->quantity_box}}</div></x-table.td>
                        <x-table.td><div>{{$item->total_quantity}}</div></x-table.td>
                        <x-table.td><div>${{number_format($item->price,0,',','.')}}</div></x-table.td>
                        <x-table.td><div>${{number_format($item->price_box,0,',','.')}}</div></x-table.td>
                        <x-table.td><div>${{number_format($item->total_price,0,',','.')}}</div></x-table.td> 
                     </tr>                         
                  @endforeach
               
               </x-slot>
            </x-table.table>
         </div>
      </x-slot>
      <x-slot name="footer">
         <div class="my-2">
            <x-jet-button wire:click="$emit('closeShowSale')">Cerrar</x-jet-button>
         </div>
      </x-slot>
    </x-modal-screen2>
</div>
