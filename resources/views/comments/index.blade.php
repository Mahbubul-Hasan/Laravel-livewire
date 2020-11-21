@extends('layouts.app')
@section('titile') Comment @endsection
@section('content')
<div class="row mt-5">
    <div class="col-md-6">
        <livewire:tickets/>
    </div>
    <div class="col-md-6">
        <livewire:comments/>
    </div>
</div>
@endsection
