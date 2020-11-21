@extends('layouts.app')
@section('titile') Counter @endsection
@section('content')
    {{-- <livewire:counter /> --}}
    @livewire('counter')
@endsection
