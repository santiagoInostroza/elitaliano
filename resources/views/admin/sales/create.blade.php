@extends('layouts.admin')


@section('title') 
    Crear Venta 
@endsection


@section('content')
    @livewire('admin.sales.create', key('sales.create'))
@endsection