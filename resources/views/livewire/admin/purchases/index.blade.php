<div  id="purchaseMain" x-data="purchaseMain()" x-on:keyup.alt.n.window="openNewPurchase= true" class="relative">

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
            <x-table.tr>
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
                     @can('admin.purchases.show')
                        <a href="{{route('admin.purchases.show',$purchase)}}">
                           <x-jet-secondary-button ><i class="fas fa-eye"></i></x-jet-secondary-button>
                        </a>
                     @endcan
                     @can('admin.purchases.show')
                        <a href="{{ route('admin.purchases.show',$purchase)}}">
                           <x-jet-secondary-button><i class="fas fa-pen"></i></x-jet-secondary-button>
                        </a>
                     @endcan

                     @can('admin.purchases.destroy')
                        <x-jet-danger-button x-on:click="openDeletePurchase=true;$wire.setPurchase({{ $purchase }})"><i class="fas fa-trash"></i></x-jet-secondary-button>
                     @endcan
                  </div>
               </x-table.td>
            </x-table.tr>
         @endforeach
      </x-slot>
   </x-table.table>
   <div>
   
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
      
   </script>
</div>
 
