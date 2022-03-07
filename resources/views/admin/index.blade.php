
@extends('layouts.admin')

@section('content')
    
    <div class="p-4">
        <div class="mb-6">
            <h2 class="uppercase font-bold text-xl">
                Bienvenido {{auth()->user()->name}} !!
            </h2>
        </div>

       <div class="grid gap-4">
        <div>Ventas del mes</div>
        <div>Ventas de ayer</div>
       </div>
      
    </div>

  

@endsection