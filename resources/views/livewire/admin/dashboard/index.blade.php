<div>
    @php
        $data=[
            [
                'name' => 'COMPRAS',
                'route' => 'admin.purchases',
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
                'route' => 'admin.sales',
                'bg_color' => 'bg-green-700',
                'text_color' => 'text-gray-200',
                'icon' => 'fas fa-dollar',
                'detail' => "$".  number_format($sales->sum('total'),0,',','.'),
            ],
            
        ];
    @endphp
    <div>
        DASHBOARDD
    </div>
    <div class="grid gap-4 grid-cols-2 md:grid-cols-3  xl:grid-cols-5">
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
       
      
    </div>

</div>
