@extends('layouts.app')

@section('title', 'Movies List')

@section('content')
<h1>{{$title}}</h1>

@if(empty($films))
    <FONT COLOR="red">No se ha encontrado ninguna película</FONT>
@else
    <div align="center">
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Year</th>
            <th>Genre</th>
            <th>Country</th>
            <th>Duration</th>
            <th>Rating</th>
            <th>Image</th>
        </tr>

        @foreach($films as $film)
            <tr>
                <td>{{ $film->name }}</td>
                <td>{{ $film->year }}</td>
                <td>{{ $film->genre }}</td>
                <td>{{ $film->country }}</td>
                <td>{{ $film->duration }}</td>
                <td>{{ $film->rating }}</td>
                <td><img src={{$film->img_url}} style="width: 100px; heigth: 120px;" /></td>
            </tr>
        @endforeach
    </table>
</div>
@endif
@endsection