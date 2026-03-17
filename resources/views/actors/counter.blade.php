@extends('layouts.app')

@section('title', 'Movies List')

@section('content')

<h1>{{ $title }}</h1>

@if(isset($actors))
    <p>Total de actores: {{ $actors }}</p>
@endif
@endsection