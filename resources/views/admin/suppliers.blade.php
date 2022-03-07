@extends('layouts.admin')

@section('content')
    @livewire('admin.suppliers.index', key('suppliers'))
@endsection