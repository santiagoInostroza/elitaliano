<div>
    <form wire:submit.prevent="editCategory">
        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
            <div class="grid grid-cols-6 gap-6">
                
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="name" value="{{ __('Nombre') }}" />
                    <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="category.name" autocomplete="name" />
                    <x-jet-input-error for="category.name" class="mt-2" />
                </div>
        
                <!-- category -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="category" value="{{ __('Categoria') }}" />
                    <select name="" id="" class="w-full border-gray-300 rounded" wire:model.defer="category.category_id" >
                        <option value="">Selecciona una categoria</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    {{-- <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" /> --}}
                    <x-jet-input-error for="category.category_id" class="mt-2" />
                </div>
            </div>
        </div>

    
        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Guardado.') }}
            </x-jet-action-message>
    
            <x-jet-button wire:loading.attr="disabled" wire:target="photo">
                {{ __('Guardar') }}
            </x-jet-button>
            
        </div>
      
    </form>

   
</div>
