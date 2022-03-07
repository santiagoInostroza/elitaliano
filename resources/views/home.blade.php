@extends('layouts.home')

@section('content')

    <div class="min-h-screen flex justify-center items-center">

        <div class="fixed inset-0">
            <img class="w-full h-full object-cover " src="{{ asset('images/cover_page/paltas.jpg') }}" alt="PALTAS">  
        </div>


        <div class="backdrop-blur-sm bg-white/30 p-8">

            <div class="text-green-800 text-5xl font-bold tracking-widest mb-4">EL ITALIANO</div>
            <p class="mt-8">
                @if (Route::has('login'))
                    <div class="">
                        @auth
                            <a href="{{ route('admin') }}" class="uppercase text-gray-700 dark:text-gray-500 underline">Tablero de administracion</a>
                        @else
                            <a href="{{ route('admin') }}" class="uppercase text-gray-700 dark:text-gray-500 underline">Iniciar Sesión</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class=" uppercase ml-4 text-gray-700 dark:text-gray-500 underline">Registrarse</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </p>

        </div>
       
           

       



    </div>


   

@endsection    
        
       