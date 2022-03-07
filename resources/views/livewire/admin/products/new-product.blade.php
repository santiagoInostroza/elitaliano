<div id="createNewProduct" x-data="newProduct()" class="text-gray-500">
    <x-modal.screen2>
        <x-slot name="header">
           <div class="flex justify-between items-center gap-4">
                <h2 class="uppercase tracking-wide"> Nuevo producto</h2>
                <div x-on:click="isOpenNewProduct = false" title="Cerrar Nuevo Producto" class="p-2 hover:shadow">
                    <i class="fas fa-times"></i>
                </div>
           </div>
        </x-slot>
        <x-slot name="body">
            <div class="grid gap-4">
                <label class="block ">
                    Activo 
                    <x-jet-input x-model="status" type="checkbox"  class="px-2 border  rounded " ></x-jet-input>
                </label>
                <div>
                    Nombre
                    <x-jet-input x-model="name" class="px-2 h-10 border w-full rounded border-gray-200" placeholder="Ingresa nombre"></x-jet-input>
                    @error('name')
                    <span class="text-red-500 text-sm">{{$message}}</span>  
                    @enderror
                </div>
              
                <div>
                    Stock Minimo (opcional)
                    <x-jet-input x-model="stock_min" type="number"  class="px-2 h-10 border w-full rounded border-gray-100" ></x-jet-input>
                </div>
            
                <div>
                    Categoria
                    <select x-model="category_id" name="" id=""  class="px-2 h-10 border border-gray-200 shadow w-full rounded">
                        <option value="">Seleccione categoria</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    <div>
                        @error('category_id')
                            <span class="text-red-500 text-sm">{{$message}}</span>  º
                        @enderror
                    </div>
                </div>
                <div>
                    Marca
                    <select x-model="brand_id" class="px-2 h-10 border border-gray-200 shadow w-full rounded" >
                        <option value="">Seleccione marca</option>
                        @foreach ($brands as $brand)
                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                    <div>
                        @error('brand_id')
                        <span class="text-red-500 text-sm">{{$message}}</span>  
                        @enderror
                    </div>
                </div>
                <div>
                    Descripcion (opcional)
                    <textarea x-model="description" class="px-2 h-20 border border-gray-200 shadow w-full rounded" ></textarea>
                </div>
                
            </div>
        </x-slot>
        <x-slot name="footer">
            {{-- <x-jet-button x-on:click="alert('response')">Crear</x-jet-button> --}}
            <x-jet-button x-on:click="create()">Crear</x-jet-button>
        </x-slot>
    </x-modal.screen2>
    <script>
        function newProduct(){
            return{
                name:@entangle('name').defer, 
                description: @entangle('description').defer, 
                stock_min:@entangle('stock_min').defer, 
                status: @entangle('status').defer, 
                category_id: @entangle('category_id'), 
                brand_id: @entangle('brand_id'),

                create:function(){                  
             
                      this.$wire.createProduct(this.name, this.description, this.stock_min, this.status, this.category_id, this.brand_id).then((response)=>{
                        
                        if(response>0){
                            toast({title:'Producto creado con exito!!'})
                            this.isOpenNewProduct=false;
                            this.name = description = '';
                            this.stock_min = category_id = brand_id = 0;
                            this.status = true;
                            this.description = '';
                            this.category_id = '';
                            this.brand_id = '';
                        }else{
                           
                        }
                       
                      });
                },
            }
        }
    </script>
</div>
