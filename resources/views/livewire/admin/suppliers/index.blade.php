<div x-data="supplierMain">

   
    <x-table.table>
        <x-slot name="title">Proveedores</x-slot>
        <x-slot name="subtitle">
            <div class="flex justify-end">
                <x-jet-button x-on:click="openNewSupplier = true">Nuevo proveedor</x-jet-button>
                <div x-cloak x-show="openNewSupplier">
                    @livewire('admin.suppliers.new-supplier')
                </div>
            </div>
        </x-slot>
        <x-slot name="thead">
            <tr>
                <x-table.th>Id</x-table.th>
                <x-table.th>Nombre</x-table.th>
                <x-table.th>Direccion</x-table.th>
                <x-table.th>Rut</x-table.th>
                <x-table.th>Razon Social</x-table.th>
                <x-table.th>Comentario</x-table.th>
                <x-table.th></x-table.th>
            </tr>
        </x-slot>
        <x-slot name="tbody">
           @foreach ($suppliers as $supplier)
            <tr>
                <x-table.td>{{$supplier->id}}</x-table.td>
                <x-table.td>{{$supplier->name}}</x-table.td>
               
                <x-table.td>{{$supplier->address}}</x-table.td>
                <x-table.td>{{$supplier->rut}}</x-table.td>
                <x-table.td>
                    <div>
                       {{$supplier->rs}}
                    </div>
                </x-table.td>
                <x-table.td>
                    <div>
                        <div title="{{$supplier->comment}}">
                            {{Str::limit($supplier->comment,20)}}
                        </div>
                    </div>
                </x-table.td>
                <x-table.td>
                    <div class="flex justify-end gap-4">
                        <x-jet-button wire:click="openEditSupplier({{$supplier}})"><i class="fas fa-pen"></i></x-jet-button>
                        <x-jet-danger-button wire:click="openDeleteSupplier({{$supplier}})"><i class="fas fa-trash"></i></x-jet-danger-button>
                    </div>
                </x-table.td>
            </tr>
           @endforeach
        </x-slot>
    </x-table.table>
    <div>
        @if ($isOpenEditSupplier)
            @livewire('admin.suppliers.edit-supplier',['supplier' => $supplierSelected])  
        @endif
        @if ($isOpenDeleteSupplier)
            <div>
                <x-modal.alert2>
                    <x-slot name="header">
                        Eliminar {{$supplierSelected->name}}
                    </x-slot>
                    <x-slot name="body">
                        Seguro deseas eliminar este proveedor?
                    </x-slot>
                    <x-slot name="footer">
                        <div class="flex justify-between items-center">
                            <x-jet-danger-button wire:click="deleteSupplier()">Eliminar</x-jet-danger-button>
                            <x-jet-button wire:click="$set('isOpenDeleteSupplier',false)">No</x-jet-button>
                        </div>
                    </x-slot>

                </x-modal.alert2>
            </div>
        @endif

    </div>
    <script>
        function supplierMain(){
            return{
                openNewSupplier:false,
                openEditSupplier:false,
            }
        }
    </script>
</div>

