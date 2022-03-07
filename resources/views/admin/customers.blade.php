@extends('layouts.admin')

@section('content')
    @livewire('admin.customers.index', key('customers'))
@endsection