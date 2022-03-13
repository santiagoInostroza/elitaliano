<div class="bg-white shadow rounded">

   <div class="grid grid-cols-1 lg:grid-cols-2 p-4">
      <div class="grid grid-cols-3">
         <div class="font-bold "> Proveedor:</div>
         <div class="col-span-2"> {{$purchase->supplier->name}} </div>
      </div>
      <div class="grid grid-cols-3">
         <div class="font-bold">Total:</div>
         <div class="col-span-2"> ${{number_format($purchase->total,0,',','.')}} </div>
      </div>
      <div class="grid grid-cols-3">
         <div class="font-bold"> Fecha de compra:</div>
         <div class="col-span-2">{{Str::ucfirst(Helper::date($purchase->date)->dayName) }} {{ Helper::date($purchase->date)->format('d-m-Y')}} </div>
      </div>
      <div class="grid grid-cols-3">
         <div class="font-bold">Compra ingresada por:</div>
         <div class="col-span-2"> {{$purchase->createdBy()->name}} </div>
      </div>
     
      <div class="grid grid-cols-3">
         <div class="font-bold">Estado de pago:</div>
         <div class="col-span-2"> 
            @if ($purchase->payment_status==1)
               Pendiente
            @elseif($purchase->payment_status==2)
               Abonado ${{number_format($purchase->payment_amount,0,',','.')}}
            @elseif($purchase->payment_status==3)
               Pagado 
            @endif   
         </div>
      </div>
      
      @if($purchase->payment_status!=3)
      
         <div class="grid grid-cols-3">
            <div class="font-bold"> Monto pendiente :</div>
            <div class="col-span-2">${{number_format($purchase->pending_amount,0,',','.')}}  </div>
         </div>
      @endif  

      @if($purchase->payment_status==3)
         <div class="grid grid-cols-3">
            <div class="font-bold">Compra pagada el:</div>
            <div class="col-span-2">
                {{Str::ucfirst(Helper::date($purchase->payment_date)->dayName) }} {{ Helper::date($purchase->payment_date, true)->format('d-m-Y H:i:s')}} 
            </div>
         </div>
      @endif  
      
   
      
      @if($purchase->comment!="")
         <div class="grid grid-cols-3">
            <div class="font-bold"> Comentario:</div>
            <div class="col-span-2"> {{$purchase->comment}} </div>
         </div>
      @endif   
      
   </div>
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
            @foreach ($purchase->purchaseItems as $item)
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
   
</div>
