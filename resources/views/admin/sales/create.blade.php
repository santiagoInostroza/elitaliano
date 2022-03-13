@extends('layouts.admin')


@section('title') 
    <div class="flex justify-between items-center gap-4" >
        Crear venta
        <a href="{{ route('admin.sales.index')}}">
            <x-jet-button>Ir a lista de ventas</x-jet-button>
        </a>
     </div>
@endsection


@section('content')
    @livewire('admin.sales.create', key('sales.create'))
@endsection