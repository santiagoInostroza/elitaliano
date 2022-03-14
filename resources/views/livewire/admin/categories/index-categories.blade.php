<div>
   
    <x-table.table>
        <x-slot name="thead">
            <x-table.tr>
                <x-table.th>Id</x-table.th>
                <x-table.th>Nombre</x-table.th>
                <x-table.th>Categoria</x-table.th>
                <x-table.th>Subcategorias</x-table.th>
                <x-table.th></x-table.th>
            </x-table.tr>     
        </x-slot>

        <x-slot name="tbody">
            @foreach ($categories as $category)
                <x-table.tr>
                    <x-table.td>{{$category->id}}</x-table.td>
                    <x-table.td>{{$category->name}}</x-table.td>
                    <x-table.td>{{ (isset($category->category()->name) ) ?  $category->category()->name : '' }}</x-table.td>
                    <x-table.td>{{ ($category->subCategories()->count()) ?  $category->subCategories()->map(function($subcategory){ return $subcategory->id;} ) : '' }}</x-table.td>
                    <x-table.td>
                        <div class="flex gap-2 items-center">

                            @can('admin.categories.edit')
                                <a href="{{route('admin.categories.edit',$category)}}">
                                    <x-jet-secondary-button> <i class="fas fa-pen"></i></x-jet-secondary-button>
                                </a>
                            @endcan
                            @can('admin.categories.destroy')
                                <div x-data="{isOpenDelete:false}">

                                    <x-jet-danger-button x-on:click="isOpenDelete=true"> <i class="fas fa-trash"></i></x-jet-danger-button>
                                    <div x-cloak x-show="isOpenDelete" x-transition >
                                        <x-modal.alert2>
                                            <x-slot name="header">
                                                Eliminar categoria?
                                            </x-slot>
                                            <x-slot name="body">
                                                Seguro deseas eliminar la categoria {{$category->id}}
                                            </x-slot>
                                            <x-slot name="footer">
                                                <x-jet-button x-on:click="isOpenDelete=false">Cancelar</x-jet-button>
                                                <x-jet-danger-button x-on:click="$wire.deleteCategory({{$category->id}}).then( ()=>{isOpenDelete=false})">Eliminar</x-jet-danger-button>
                                            </x-slot>
                                        </x-modal.alert2>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </x-table.td>
               
                </x-table.tr>   
            @endforeach 
        </x-slot>
    </x-table.table>
</div>
