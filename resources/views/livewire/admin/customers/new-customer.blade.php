<div x-data="{name:@entangle('name').defer, address:'', cel:'', comment:'' }">
    <x-modal.screen2>
        <x-slot name="header">
            <div class="flex items-center gap-4 justify-between">
                <h2 class="uppercase tracking-wide">Nuevo Cliente</h2>
                <div x-on:click="isOpenNewCustomer = false" class="p-4 hover:shadow">
                     <i class="fas fa-times"></i>
                </div>
            </div>
        </x-slot>
        <x-slot name="body">
         <div class="grid gap-4 ">
 
             <div>
                 Nombre
                 <x-jet-input x-model="name" class="w-full border shadow h-10"></x-jet-input>
                 @error('name')
                     <span class="text-xs text-red-500">{{$message}}</span>
                 @enderror
             </div>
 
                 <div>Direccion
                 <x-jet-input x-model='address' class="w-full border shadow h-10"></x-jet-input>
             </div>
                 <div>Cel
                 <x-jet-input x-model='cel' class="w-full border shadow h-10"></x-jet-input>
             </div>
             <div>
                 Comentario
                 <x-jet-input x-model='comment' class="w-full border shadow h-10"></x-jet-input>
             </div>
             
         </div>
     </x-slot>
     <x-slot name="footer">
         <x-jet-button x-on:click="$wire.saveCustomer(name, address, cel, comment)
         .then((response)=>{
             if(response){
                 isOpenNewCustomer=false;
                 name=address=comment='';
                 toast({title:'Se ha creado el cliente!!'});
             }
            
         })">Crear cliente</x-jet-button>
         
     </x-slot>
    </x-modal.screen2>
 </div>
