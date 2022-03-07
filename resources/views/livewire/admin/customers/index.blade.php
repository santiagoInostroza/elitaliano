<div x-data="customerMain">

   
    <x-table.table>
        <x-slot name="title">Clientes</x-slot>
        <x-slot name="subtitle">
            <div class="flex justify-end">
                <x-jet-button x-on:click="openNewCustomer = true">Nuevo cliente</x-jet-button>
                <div x-cloak x-show="openNewCustomer">
                    @livewire('admin.customers.new-customer')
                </div>
            </div>
        </x-slot>
        <x-slot name="thead">
            <tr>
                <x-table.th>Id</x-table.th>
                <x-table.th>Nombre</x-table.th>
                <x-table.th>Direccion</x-table.th>
                <x-table.th>Cel</x-table.th>
                <x-table.th>Comentario</x-table.th>
                <x-table.th></x-table.th>
            </tr>
        </x-slot>
        <x-slot name="tbody">
           @foreach ($customers as $customer)
            <tr>
                <x-table.td>{{$customer->id}}</x-table.td>
                <x-table.td>{{$customer->name}}</x-table.td>
               
                <x-table.td>{{$customer->address}}</x-table.td>
                <x-table.td>{{$customer->cel}}</x-table.td>
               
                <x-table.td>
                    <div>
                        <div title="{{$customer->comment}}">
                            {{Str::limit($customer->comment,20)}}
                        </div>
                    </div>
                </x-table.td>
                <x-table.td>
                    <div class="flex justify-end gap-4">
                        <x-jet-button wire:click="openEditCustomer({{$customer}})"><i class="fas fa-pen"></i></x-jet-button>
                        <x-jet-danger-button wire:click="openDeleteCustomer({{$customer}})"><i class="fas fa-trash"></i></x-jet-danger-button>
                    </div>
                </x-table.td>
            </tr>
           @endforeach
        </x-slot>
    </x-table.table>
    <div>
        @if ($isOpenEditCustomer)
            @livewire('admin.customers.edit-customer',['customer' => $customerSelected])  
        @endif
        @if ($isOpenDeleteCustomer)
            <div>
                <x-modal.alert2>
                    <x-slot name="header">
                        Eliminar {{$customerSelected->name}}
                    </x-slot>
                    <x-slot name="body">
                        Seguro deseas eliminar este cliente?
                    </x-slot>
                    <x-slot name="footer">
                        <div class="flex justify-between items-center">
                            <x-jet-danger-button wire:click="deleteCustomer()">Eliminar</x-jet-danger-button>
                            <x-jet-button wire:click="$set('isOpenDeleteCustomer',false)">No</x-jet-button>
                        </div>
                    </x-slot>

                </x-modal.alert2>
            </div>
        @endif

    </div>
    <script>
        function customerMain(){
            return{
                openNewCustomer:false,
                openEditCustomer:false,
            }
        }
    </script>
</div>


