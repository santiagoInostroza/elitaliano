<div x-data="{name:@entangle('name').defer, address:'', rut:'', rs:'', comment:'' }">
   <x-modal.screen2>
       <x-slot name="header">
           <div class="flex items-center gap-4 justify-between">
               <h2 class="uppercase tracking-wide">Nuevo Proveedor</h2>
               <div x-on:click="isOpenNewSupplier = false" class="p-4 hover:shadow">
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
                <div>Rut
                <x-jet-input x-model='rut' class="w-full border shadow h-10"></x-jet-input>
            </div>
            <div>
                Rason social
                <x-jet-input x-model='rs' class="w-full border shadow h-10"></x-jet-input>
            </div>
            <div>
                Comentario
                <x-jet-input x-model='comment' class="w-full border shadow h-10"></x-jet-input>
            </div>
            
        </div>
    </x-slot>
    <x-slot name="footer">
        <x-jet-button x-on:click="$wire.saveSupplier(name, address, rut, rs, comment)
        .then((response)=>{
            if(response){
                openNewSupplier=false;
                name=address=rut=rs=comment='';
                toast({title:'Se ha creado el proveedor!!'});
            }
           
        })">Crear</x-jet-button>
        
    </x-slot>
   </x-modal.screen2>
</div>
