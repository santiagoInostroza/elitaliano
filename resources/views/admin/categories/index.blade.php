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
    <div class="flex justify-between items-center gap-4" >
        Categorias 
        <a href="{{ route('admin.categories.create')}}">
            <x-jet-button>Nueva Categoria</x-jet-button>
        </a>
     </div>
@endsection


@section('content')

    @livewire('admin.categories.index-categories', key('categories'))
    
@endsection