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
                    'route' => 'admin.purchases',
                    'can' => 'admin.purchases'
                ],
                [
                    'name' => 'VENTAS',
                    'icon' => 'fas fa-cash-register',
                    'route' => 'admin.sales',
                    'can' => 'admin.sales'
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
                    'name' => 'CLIENTES',
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
                    <div x-cloak  x-show="show" class="fixed z-20 flex justify-between items-start shadow border bg-gray-800 text-gray-200 h-screen overflow-auto  w-72"  >
                        <div class="flex-1 p-4 pr-0">
                            @foreach ($vistas as $vista)
                                @if (isset($vista['can']) && $vista['can'] != "")
                                    @can($vista['can'])
                                    <a href="{{ route($vista['route']) }}" class="uppercase flex items-center gap-2 p-4 hover:bg-gray-700 border-b border-gray-200 w-full cursor-pointer @if(request()->routeIs($vista['route'])) bg-gray-600 @endif">
                                        <div class="text-gray-400">
                                            <i class="{{$vista['icon']}}"></i>
                                        </div>
                                        <h3>{{ $vista['name'] }}</h3>
                                    </a>
                                    @endcan
                                @else
                                    <a href="{{ route($vista['route']) }}" class="uppercase flex items-center gap-2 p-4 hover:bg-gray-700 border-b border-gray-200 w-full cursor-pointer @if(request()->routeIs($vista['route'])) bg-gray-600 @endif">
                                        <div class="text-gray-400">
                                            <i class="{{$vista['icon']}}"></i>
                                        </div>
                                        <h3>{{ $vista['name'] }}</h3>
                                    </a>
                                @endif
                               
                             
                            @endforeach                           
                        </div>
                        <div x-on:click="show=!show" class="bg-gray-800 w-6 h-full font-bold  cursor-pointer hover:bg-gray-700 text-white flex items-center justify-center" >
                            <div class="py-4">
                                <i class="fas fa-chevron-left" ></i>
                            </div>
                        </div>
                    </div>

                    
                    {{-- MAIN --}}
                    <div class="w-full h-screen " :class="{'pl-72': (show && !isMobile) }" >
                        
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
                            <header class="max-w-7xl mx-auto p-2">
                                    {{ $title }}
                            </header>
                        @endif
                        @hasSection('title')
                            <header class="max-w-7xl mx-auto p-2 uppercase">
                                @yield('title')
                            </header>
                        @endif
                        



                        @isset($slot)
                            {{ $slot }}
                        @endisset
                        <div class="max-w-7xl mx-auto px-2">
                            @yield('content')
                        </div>
                    </div>
                    <script>
                        function barraLateral(){
                            return{
                                show: (window.innerWidth < 1536) ? false : true,
                                isMobile: (window.innerWidth < 768) ? false : false,
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
