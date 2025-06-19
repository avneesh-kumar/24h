@extends('layouts.app')

@section('content')
@if($areas->isNotEmpty())
    @include('components.area', ['areas' => $areas])
@endif
@endsection 