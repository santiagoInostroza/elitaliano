<div class="bg-indigo-50 text-gray-900">
    @php
        $data=[
            [
                'name' => 'COMPRAS',
                'route' => 'admin.purchases.index',
                'bg_color' => 'bg-green-300',
                'text_color' => 'text-gray-700',
                'icon' => 'fas fa-file-invoice',
                'detail' => "$".  number_format($purchases->sum('total'),0,',','.'),
            ],
            [
                'name' => 'Productos',
                'route' => 'admin.products',
                'bg_color' => 'bg-green-400',
                'text_color' => 'text-gray-700',
                'icon' => 'fab fa-product-hunt',
                'detail' => "".  number_format($products->count(),0,',','.'),
            ],
            [
                'name' => 'Proveedores',
                'route' => 'admin.suppliers',
                'bg_color' => 'bg-green-500',
                'text_color' => 'text-gray-700',
                'icon' => 'fas fa-truck-moving',
                'detail' => "".  number_format($supplier->count(),0,',','.'),
            ],
            [
                'name' => 'Clientes',
                'route' => 'admin.customers',
                'bg_color' => 'bg-green-600',
                'text_color' => 'text-gray-200',
                'icon' => 'fas fa-user',
                'detail' => "".  number_format($customers->count(),0,',','.'),
            ],
            [
                'name' => 'Ventas',
                'route' => 'admin.sales.index',
                'bg_color' => 'bg-green-700',
                'text_color' => 'text-gray-200',
                'icon' => 'fas fa-dollar',
                'detail' => "$".  number_format($sales->sum('total'),0,',','.'),
            ],
            
        ];
    @endphp
    <div class="grid gap-6 my-10">
        
        <div class="bg-indigo-200 text-gray-900 p-8 tracking-wide">
            <h2 class="font-bold text-3xl">Saludos, El Italiano 👋</h2>
            <div class="font-sans">Aqui verás lo que está pasando con tu empresa</div>
        </div>



        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="p-6 shadow rounded bg-white ">
                <div>
                    <i class="fas fa-file-invoice text-4xl text-green-500"></i>
                </div>
                <h2 class="font-bold text-xl my-2">Compras ({{ $purchases->count() }})</h2>
                <div class="text-xl md:text-4xl"> 
                    ${{ number_format($purchases->sum('total'),0,',','.')}}
                </div>
                <div class="hidden md:block mt-4">
                    <div>
                       
                    </div>
                    <div>
                        Pendientes ${{  number_format($purchases->sum('pending_amount'),0,',','.') }}
                    </div>
                    <div>
                        Pagadas  ${{number_format($purchases->sum('payment_amount'),0,',','.')}}
                    </div>
                </div>
            </div>
           
           
            <div class="p-6 shadow rounded bg-white">
                <div>
                    <i class="fas fa-cash-register text-4xl text-green-500"></i>
                </div>
                <h2 class="font-bold text-xl my-2">Ventas ({{ $sales->count() }})</h2>
                <div class="text-xl md:text-4xl"> 
                    ${{ number_format($sales->sum('total'),0,',','.') }}
                </div>
                <div class="hidden md:block mt-4">
                    <div>
                        Pendientes ${{  number_format($sales->sum('pending_amount'),0,',','.') }}
                    </div>
                    <div>
                        Pagadas  ${{number_format($sales->sum('payment_amount'),0,',','.')}}
                    </div>
                </div>
            </div>
            <div class="p-6 shadow rounded bg-white">
                <div>
                    <i class="fas fa-money-bill  text-4xl text-green-500"></i>
                   
                </div>
                <h2 class="font-bold text-xl my-2">Diferencia</h2>
                <div class="text-xl md:text-4xl"> ${{ number_format($sales->sum('total') - $purchases->sum('total'),0,',','.')}}</div>
            </div>

            <div class="p-6 shadow rounded bg-white">
                <div>
                    <i class="fas fa-money-bill  text-4xl text-green-500"></i>
                   
                </div>
                <h2 class="font-bold text-xl my-2">Stock</h2>
            
                <div class="text-xl md:text-4xl"> ${{ number_format($stock,0,',','.')}}</div>
            </div>
        </div>
        
    </div>

    <div>
        Agregar más estadisticas...

    </div>

    {{-- <div class="grid gap-4 grid-cols-2 md:grid-cols-3  xl:grid-cols-5 ">
        @foreach ($data as $item)
            <a href="{{route($item['route'])}}">
                <div class="p-4 rounded shadow {{$item['bg_color']}} max-w-xs ">
                    <div class="grid gap-4 {{$item['text_color']}}">
                        <div class="flex gap-2 items-center">
                            <i class="{{$item['icon']}}"></i>
                            <h2 class="text-xl uppercase"> {{$item['name']}} </h2>
                        </div>
                        <hr>
                        <p class="{{$item['text_color']}} text-xl font-bold">
                           {{$item['detail']}}
                        </p>
                    </div>
                </div>
            </a>
        @endforeach
       
      
    </div> --}}

</div>
