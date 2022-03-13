@extends('layouts.admin')

@section('title')
  <div class="flex justify-between items-center gap-2">
    <h1>Crear Compra</h1>
    <a href="{{route('admin.purchases.index')}}">
        <x-jet-button>Ir a lista de compras</x-jet-button>
    </a>
  </div>
@endsection

@section('content')
   @livewire('admin.purchases.create-purchase')
@endsection