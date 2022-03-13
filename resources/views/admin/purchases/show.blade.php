@extends('layouts.admin')


@section('header')
    @if (session()->has('message'))
        <div x-data="{isOpen:true}" class=" shadow">

            <div  x-show="isOpen" class="animate-bounce flex justify-between items-center alert alert-success w-full p-4 bg-green-500 text-white font-bold">
                {{ session('message') }}
              
                <div class="p-2 cursor-pointer text-white" x-on:click="isOpen=false">
                    <i class="fas fa-times"></i>
                </div>
              
                   
            </div>
        </div>
    @endif
@endsection


@section('title')
    <div class="flex justify-between items-center gap-2">
        <h1>Detalle de compra {{$purchase->id}}</h1>
        <a href="{{route('admin.purchases.index')}}">
            <x-jet-button>Ir a lista de compras</x-jet-button>
        </a>
    </div>
@endsection

@section('content')
   @livewire('admin.purchases.show', ['purchase' => $purchase], key('showPurchase'.$purchase->id))
@endsection