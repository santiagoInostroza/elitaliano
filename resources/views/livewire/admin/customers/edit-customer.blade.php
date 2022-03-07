<div>
    <x-modal.screen2>
        <x-slot name="header">
            <div class="flex items-center gap-4 justify-between">
                <h2 class="uppercase tracking-wide">Editar {{$customer->name}}</h2>
                <div wire:click="$emit('closeEditCustomer')" class="p-4 hover:shadow">
                     <i class="fas fa-times"></i>
                </div>
            </div>
        </x-slot>
        <x-slot name="body">
         <div class="grid gap-4 ">
 
             <div>
                 Nombre
                 <x-jet-input wire:model.debounce.500ms="customer.name" class="w-full border shadow h-10"></x-jet-input>
                 @error('name')
                     <span class="text-xs text-red-500">{{$message}}</span>
                 @enderror
             </div>
 
                 <div>Direccion
                 <x-jet-input wire:model.defer='customer.address' class="w-full border shadow h-10"></x-jet-input>
             </div>
                 <div>Cel
                 <x-jet-input wire:model.defer='customer.cel' class="w-full border shadow h-10"></x-jet-input>
             </div>
            
             <div>
                 Comentario
                 <x-jet-input wire:model.defer='customer.comment' class="w-full border shadow h-10"></x-jet-input>
             </div>
             
         </div>
     </x-slot>
     <x-slot name="footer">
         <x-jet-button wire:click="saveCustomer()">Editar</x-jet-button>
     </x-slot>
    </x-modal.screen2>
</div>
