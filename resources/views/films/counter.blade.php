@extends('layouts.app')

@section('title', 'Movies List')

@section('content')

<h1>{{ $title }}</h1>

@if(isset($films))
    <p>Total de películas: {{ $films }}</p>
@endif
@endsection