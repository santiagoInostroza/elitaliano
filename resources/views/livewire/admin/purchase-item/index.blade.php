<div class="block md:flex items-center justify-between gap-4 p-2 hover:bg-gray-100" x-data="purchaseItems()">
    <span>{{$item['name']}}</span>
    <div class="text-sm flex items-end justify-between gap-1 w-full overflow-auto md:overflow-hidden pb-2 md:pb-0">
        <div class="flex flex-col">
            stock
            <div class="p-2">{{$item['stock']}}</div>
        </div>
        <div>
            <div class="flex flex-col">
                Cantidad
                -{{$quantity}}-
                <x-jet-input {{-- x-on:change="insertQuantity(index)" x-on:keyup="insertQuantity(index)" --}}  type="number"  wire:model="quantity"  min="1" class="p-1 w-20" value=""></x-jet-input>
            </div>
            @error('quantity')
                <span class="text-red-600 text-xs p-2">{{$message}} error</span>
            @enderror  
                
        </div>
        <div class="flex flex-col">
            Precio
            <x-jet-input  {{--x-on:change="insertPrice(index)" x-on:keyup="insertPrice(index)" --}} type="number"  min="1" class="p-1 w-20" value=""></x-jet-input>
        </div>
        <div class="flex flex-col">
            Total
            <x-jet-input {{--x-on:change="insertTotal(index)" x-on:keyup="insertTotal(index)"--}} type="number"  min="1" class="p-1 w-24" value=""></x-jet-input>
        </div>

        <div wire:click="valid()" class="cursor-pointer text-red-600 hover:text-red-700 p-4" >Validar</div>
        <div x-on:click="removeItem(index)" class="cursor-pointer text-red-600 hover:text-red-700 p-4" ><i class="fas fa-trash"></i></div>
    </div>
    <script>
        function purchaseItems(){
            return {
                stock:'',
                quantity: '',
                quantityBox: '',
                totalQuantity: '',
                price: '',
                priceBox: '',
                totalPrice: '',
            }
        }
    </script>
</div>
