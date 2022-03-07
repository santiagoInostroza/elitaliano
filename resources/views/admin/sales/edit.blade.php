@extends('layouts.admin')

@section('title') 
    Editar venta  {{$sale->id}}
    {{-- {{$sale}} --}}
@endsection

@section('content')
    @livewire('admin.sales.edit',['sale' => $sale], key('sales.edit{{$sale->id}}'))
@endsection