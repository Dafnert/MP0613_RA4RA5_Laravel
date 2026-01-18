@extends('layouts.app')

@section('title', 'Movies List')

@section('content')
   <div @class(['container', 'mt-5', 'content-wrapper'])>

    <h2 @class(['mb-4'])>Lista de Películas</h2>

    <div @class(['row', 'mb-5'])>
        <div @class(['col-md-4', 'mb-3'])>
            <div @class(['card', 'shadow-sm', 'p-3'])>
                <a href="/filmout/oldFilms">Pelis antiguas</a>
            </div>
        </div>
        <div @class(['col-md-4', 'mb-3'])>
            <div @class(['card', 'shadow-sm', 'p-3'])>
                <a href="/filmout/newFilms">Pelis nuevas</a>
            </div>
        </div>
        <div @class(['col-md-4', 'mb-3'])>
            <div @class(['card', 'shadow-sm', 'p-3'])>
                <a href="/filmout/films">Todas las pelis</a>
            </div>
        </div>
        <div @class(['col-md-4', 'mb-3'])>
            <div @class(['card', 'shadow-sm', 'p-3'])>
                <a href="/filmout/yearFilms">Pelis por año</a>
            </div>
        </div>
        <div @class(['col-md-4', 'mb-3'])>
            <div @class(['card', 'shadow-sm', 'p-3'])>
                <a href="/filmout/genreFilms">Pelis por género</a>
            </div>
        </div>
        <div @class(['col-md-4', 'mb-3'])>
            <div @class(['card', 'shadow-sm', 'p-3'])>
                <a href="/filmout/sortFilms">Pelis ordenadas por año</a>
            </div>
        </div>
        <div @class(['col-md-4', 'mb-3'])>
            <div @class(['card', 'shadow-sm', 'p-3'])>
                <a href="/filmout/countFilms">¿Cuántas películas hay?</a>
            </div>
        </div>
    </div>

        <h2>Crear una película</h2>
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
            </ul>
        </div>
    @endif
        <div @class(['card', 'p-4'])>
            <form action="{{ route('createFilm') }}" method="POST">
                @csrf

                <input type="text" name="name" id="name" @class(['form-control']) placeholder="Nombre de la película" >

                <input type="number" name="year" id="year" @class(['form-control']) placeholder="Año" >

                <input type="text" name="genre" id="genre" @class(['form-control']) placeholder="Género" >

                <input type="text" name="country" id="country" @class(['form-control']) placeholder="País" >

                <input type="number" name="duration" id="duration" @class(['form-control']) placeholder="Duración (min)">

                <input type="text" name="img_url" id="img_url" @class(['form-control']) placeholder="URL de la imagen PNG/JPG">

                <button type="submit" @class(['btn', 'btn-primary', 'mt-3'])>Enviar</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

@endsection
