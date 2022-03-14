<div>
    <x-table.table>
        <x-slot name="title">Productos</x-slot>
        <x-slot name="subtitle">
            <div class="flex justify-end" x-data="{isOpenNewProduct:false}">
                <x-jet-button x-on:click="isOpenNewProduct=true">Nuevo Producto</x-jet-button>
                <div x-cloak x-show="isOpenNewProduct">
                    @livewire('admin.products.new-product')
                </div>

            </div>
        </x-slot>
        <x-slot name="thead">
            <tr>
                <x-table.th>Id</x-table.th>
                <x-table.th>Nombre</x-table.th>
                <x-table.th>Descripcion</x-table.th>
                <x-table.th>Stock</x-table.th>
                <x-table.th>Stock min</x-table.th>
                <x-table.th>Status</x-table.th>
                <x-table.th></x-table.th>
            </tr>
        </x-slot>
        <x-slot name="tbody">
           @foreach ($products as $product)
            <tr>
                <x-table.td>{{$product->id}}</x-table.td>
                <x-table.td>{{$product->name}}</x-table.td>
                <x-table.td>
                    <div>
                        <output title="{{$product->description}}">
                            {{Str::limit($product->description,20)}}
                        </output>
                    </div>
                </x-table.td>
                <x-table.td>{{$product->stock}}</x-table.td>
                <x-table.td>{{$product->stock_min}}</x-table.td>
                <x-table.td>
                    <div>
                        @if ($product->status == 1)
                            Activo
                        @else
                            Inactivo
                        @endif
                    </div>
                </x-table.td>
                <x-table.td>
                    <x-jet-button wire:click="editProduct({{$product}})"><i class="fas fa-pen"></i></x-jet-button>
                </x-table.td>
            </tr>
           @endforeach
        </x-slot>
    </x-table.table>
    @if ($editProduct)
       @livewire('admin.products.edit-product',['product' => $editProductSelected])  
    @endif
</div>
