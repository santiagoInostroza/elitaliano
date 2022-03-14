<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ElItaliano') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        {{-- FONT AWESOME 5 --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

        {{-- SWEET ALERT --}}
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        


        @livewireStyles

        <style> 
            [x-cloak] { display: none; }
            @media screen and (max-width: 768px) {
                [x-cloak="mobile"] { display: none; }
            }
        </style>
        

        <!-- Scripts -->
        <script src="{{asset('js/myJs.js') }}"></script>
        <script src="{{ mix('js/app.js') }}" defer></script>

        

        
    </head>
    <body class="font-sans antialiased">
        @php
            $vistas =[
                [
                    'name' => 'DASHBOARD',
                    'icon' => 'fas fa-tachometer-alt',
                    'route' => 'admin.dashboard',
                    'can' => 'admin.dashboard'
                ],
                [
                    'name' => 'Mi Info',
                    'icon' => 'fas fa-tachometer-alt',
                    'route' => 'admin',
                    'can' => 'admin'
                ],
                [
                    'name' => 'USUARIOS',
                    'icon' => 'fas fa-users',
                    'route' => 'admin.users',
                    'can' => 'admin.users'
                ],
                [
                    'name' => 'ROLES',
                    'icon' => 'fas fa-users-cog',
                    'route' => 'admin.roles',
                    'can' => 'admin.roles'
                ],
                [
                    'name' => 'COMPRAS',
                    'icon' => 'fas fa-file-invoice',
                    'route' => 'admin.purchases.*',
                    'can' => 'admin.purchases.index',
                    'child' => [
                        [
                            'name' => 'LISTA DE COMPRAS',
                            'icon' => 'fas fa-file-invoice',
                            'route' => 'admin.purchases.index',
                            'can' => 'admin.purchases.index'
                        ],
                        [
                            'name' => 'CREAR COMPRA',
                            'icon' => 'fas fa-file-invoice',
                            'route' => 'admin.purchases.create',
                            'can' => 'admin.purchases.create'
                        ],
                    ]
                ],
               
                [
                    'name' => 'VENTAS',
                    'icon' => 'fas fa-cash-register',
                    'route' => 'admin.sales.*',
                    'can' => 'admin.sales.index',
                    'child' =>  
                        [
                            [
                                'name' => 'LISTA DE VENTAS',
                                // 'icon' => 'fas fa-cash-register',
                                'route' => 'admin.sales.index',
                                'can' => 'admin.sales.index'
                            ],
                            [
                                'name' => 'CREAR VENTA',
                                // 'icon' => 'fas fa-cash-register',
                                'route' => 'admin.sales.create',
                                'can' => 'admin.sales.create'
                            ],
                        ],
                ],
                
                [
                    'name' => 'CATEGORIAS',
                    'icon' => 'fas fa-cash-register',
                    'route' => 'admin.categories.*',
                    'can' => 'admin.categories.index',
                    'child' =>  
                    [
                        [
                            'name' => 'LISTA DE CATEGORIAS',
                            // 'icon' => 'fas fa-cash-register',
                            'route' => 'admin.categories.index',
                            'can' => 'admin.categories.index'
                        ],
                        [
                            'name' => 'CREAR CATEGORIA',
                            // 'icon' => 'fas fa-cash-register',
                            'route' => 'admin.categories.create',
                            'can' => 'admin.categories.create'
                        ],
                    ]
                ],

               
           
                [
                    'name' => 'PRODUCTOS',
                    'icon' => 'fab fa-product-hunt',
                    'route' => 'admin.products',
                    'can' => 'admin.products'
                ],
                [
                    'name' => 'PROVEEDORES',
                    'icon' => 'fas fa-truck-moving',
                    'route' => 'admin.suppliers',
                    'can' => 'admin.suppliers'
                ],
                [
                    'name' => 'Clientes',
                    'icon' => 'fas fa-user',
                    'route' => 'admin.customers',
                    'can' => 'admin.customers'
                ],
               
            ];
        @endphp
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            <!-- Page Content -->
            <main>
                <div x-cloak x-on:resize.window="resize()"  x-data="barraLateral()" class="w-full h-full text-gray-500" >

                    {{-- BARRA LATERAL --}}
                    <div x-cloak  x-show="show" class="fixed z-20 shadow border bg-gray-800 text-gray-400 h-screen overflow-auto  w-72 p-4"  >
                      
                        <div class="flex gap-2 items-center justify-between mb-8">
                           
                            <div class="p-2">
                                {{auth()->user()->name}}
                                <div class="text-xs text-gray-500">
                                    {{auth()->user()->roles()->first()->name}}
                                </div>
                            </div>
                            <div x-on:click="show=!show" class="cursor-pointer px-2">
                                <i class="fas fa-arrow-left" ></i>
                            </div>
                        </div>
                        
                        @foreach ($vistas as $vista)
                            @if (isset($vista['child']))
                                <div x-data="{isOpen:false}" >
                                    <div x-on:click="isOpen = !isOpen" x-on:click.away="isOpen = false" class=" flex justify-between items-center gap-2 p-2 hover:text-white   w-full cursor-pointer @if(request()->routeIs($vista['route'])) bg-gray-900 text-white @endif" :class=" isOpen ? 'font-bold bg-gray-800':'' "  >
                                        <div class="flex items-center gap-2">
                                            <div class="text-gray-300">
                                                <i class="{{$vista['icon']}}"></i>
                                            </div>
                                            <h3>{{ Str::ucfirst(Str::lower($vista['name']))  }}</h3>    
                                        </div>
                                        <div>
                                            <i x-cloak x-show="isOpen" class="fas fa-chevron-up" ></i>
                                            <i x-cloak x-show="!isOpen" class="fas fa-chevron-down" ></i>
                                        </div>
                                    </div>
                                    <div x-cloak x-show="isOpen" class=" w-full" x-transition>
                                        
                                        @foreach ( $vista['child'] as $key => $v )
                                        
                                            @if ( isset($v['can']) && $v['can'] != "")
                                                @can($v['can'])
                                                    <a href="{{ route($v['route']) }}" class="bg-gray-800 flex items-center pl-8 gap-2 p-2 hover:text-white w-full cursor-pointer @if(request()->routeIs($v['route'])) bg-gray-800 text-cyan-500 font-bold hover:text-cyan-700 @endif">
                                                        <h3 class="">{{ Str::ucfirst(Str::lower($v['name'])) }}</h3>
                                                    </a>
                                                @endcan
                                            @else
                                                <a href="{{ route($v['route']) }}" class="bg-gray-800 flex items-center  pl-8 gap-2 p-4 hover:text-white w-full cursor-pointer @if(request()->routeIs($v['route'])) bg-gray-800 text-cyan-500 font-bold hover:text-cyan-700 @endif">
                                                    <h3 class="pl-6">{{ Str::ucfirst(Str::lower($v['name']))  }}</h3>
                                                </a>
                                            @endif
                                        
                                        
                                        @endforeach   

                                    </div>
                                    
                                </div>
                            @else
                                @if (isset($vista['can']) && $vista['can'] != "")
                                    @can($vista['can'])
                                    <a href="{{ route($vista['route']) }}" class="flex items-center gap-2 p-2 hover:text-white  w-full cursor-pointer @if(request()->routeIs($vista['route'])) bg-gray-900 text-white @endif">
                                        <div class="text-gray-400">
                                            <i class="{{$vista['icon']}}"></i>
                                        </div>
                                        <h3>{{  Str::ucfirst(Str::lower($vista['name']))   }}</h3>
                                      
                                    </a>
                                    @endcan
                                @else
                                    <a href="{{ route($vista['route']) }}" class="flex items-center gap-2 p-2 hover:text-white w-full cursor-pointer @if(request()->routeIs($vista['route'])) bg-gray-900 text-white @endif">
                                        <div class="text-gray-400">
                                            <i class="{{$vista['icon']}}"></i>
                                        </div>
                                        <h3>{{ Str::ucfirst(Str::lower($vista['name']))   }}</h3>
                                    </a>
                                @endif
                            @endif
                        @endforeach  
                                     
                    </div>

                    
                    {{-- MAIN --}}
                    <div class="w-full" :class="{'pl-72': (show && !isMobile) }" >
                        
                        @if (isset($header))
                            <header class="">
                                    {{ $header }}
                            </header>
                        @endif
                        @hasSection('header')
                            <header class="uppercase">
                                @yield('header')
                            </header>
                        @endif

                        @livewire('navigation-menu')

                         <!-- Page Heading -->
                        @if (isset($title))
                            <header class="max-w-10xl mx-auto p-2 md:px-6 xl:px-8">
                                    {{ $title }}
                            </header>
                        @endif
                        @hasSection('title')
                            <header class="max-w-10xl mx-auto p-2 md:px-6 xl:px-8">
                                @yield('title')
                            </header>
                        @endif
                        



                        @isset($slot)
                            {{ $slot }}
                        @endisset
                        <div class="max-w-10xl mx-auto px-2 md:px-6 xl:px-8">
                            @yield('content')
                        </div>
                    </div>


                    <script>
                        var isMobile = (window.innerWidth < 768) ? true : false;
                        function resize(){
                            isMobile = (window.innerWidth < 768) ? true : false;
                        };

                        function barraLateral(){
                            return{
                                isMobile : (window.innerWidth < 768) ? true : false,
                                show: (window.innerWidth < 1536) ? false : true,
                                resize:function(){
                                    this.show =  (window.innerWidth < 1536) ? false : true; 
                                    this.isMobile = (window.innerWidth < 768) ? true : false;
                                },
                            }
                        }
                    </script>

                </div>
                
            </main>
        </div>

      

        @stack('modals')

        @livewireScripts
     

    </body>
</html>
