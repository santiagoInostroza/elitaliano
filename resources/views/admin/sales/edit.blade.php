@extends('layouts.admin')


@section('title') 
    <div class="flex justify-between items-center gap-4" >
        Editar venta  {{$sale->id}}
        <a href="{{ route('admin.sales.index')}}">
            <x-jet-button>Ir a lista de ventas</x-jet-button>
        </a>
     </div>
@endsection

@section('content')
    @livewire('admin.sales.edit',['sale' => $sale], key('sales.edit{{$sale->id}}'))
@endsection