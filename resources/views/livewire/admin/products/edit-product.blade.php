<div>
    <form wire:submit.prevent="save">
    <x-modal.screen2>
            <x-slot name="header">
                <div wire:click="$emitUp('closeEditProduct')" class="absolute right-0 top-0 p-4 cursor-pointer hover:font-thin">
                    <i class="fas fa-times"></i>
                </div>
                <h1 class="uppercase tracking-wide">Editar {{$product->name}}</h1>
            </x-slot>
            <x-slot name="body">
                <div class="grid gap-4">
                    
                    <label class="block ">
                        Activo 
                        <x-jet-input wire:model="product.status" type="checkbox"  class="px-2 border border-gray-200  rounded " ></x-jet-input>
                    </label>
                    <div>
                        Nombre:
                        <x-jet-input wire:model.debounce.1200ms="product.name" class="px-2 h-10 border w-full rounded border-gray-200" placeholder="Ingresa nombre"></x-jet-input>
                        @error('product.name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        Stock Minimo (opcional)
                        <x-jet-input wire:model.debounce.1200ms="product.stock_min" type="number"  class="px-2 h-10 border w-full rounded border-gray-200" ></x-jet-input>
                    </div>
                    <div>
                        Categoria
                        <select wire:model="product.category_id" name="" id=""  class="px-2 h-10 border border-gray-200 shadow w-full rounded">
                            <option value="0">Seleccione categoria</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        Marca
                        <select wire:model="product.brand_id" class="px-2 h-10 border border-gray-200 shadow w-full rounded" >
                            <option value="0">Seleccione marca</option>
                            @foreach ($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        Descripcion (opcional)
                        <textarea wire:model.debounce.1200ms="product.description" class="px-2 h-20 border border-gray-200 shadow w-full rounded" ></textarea>
                    </div>
                        
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-button type="submit">Guardar</x-jet-button>

            </x-slot>
        </x-modal.screen2>
    </form>
</div>
