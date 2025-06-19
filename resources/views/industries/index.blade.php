@extends('layouts.app')

@section('content')
@if($industries->isNotEmpty())
    @include('components.industries', ['industries' => $industries])
@endif
@endsection 