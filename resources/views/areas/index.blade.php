@extends('layouts.app')

@section('title', 'Areas We Serve')
@section('meta_description', 'Explore the areas we serve with Ready 24h Security. Providing top-notch security services across California.')

@section('content')
@if($areas->isNotEmpty())
    @include('components.area', ['areas' => $areas, 'showAll' => false])
@endif
@endsection 