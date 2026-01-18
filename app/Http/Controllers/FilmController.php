<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FilmController extends Controller
{

    /**
     * Read films from storage
     */
    public static function readFilms(): array
    {
        $films = Storage::json('/public/films.json');
        return $films;
    }
    public static function create()
    {
        return view('films.list');
    }

    /**
     * List films older than input year 
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listOldFilms($year = null)
    {
        $old_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Antiguas (Antes de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            //foreach ($this->datasource as $film) {
            if ($film['year'] < $year)
                $old_films[] = $film;
        }
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }
    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] >= $year)
                $new_films[] = $film;
        }
        return view('films.list', ["films" => $new_films, "title" => $title]);
    }
    public function listYearFilms($year = null)
    {
        $year_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis por Año";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] == $year)
                $year_films[] = $film;
        }
        return view('films.list', ["films" => $year_films, "title" => $title]);
    }
    public function sortFilms()
    {

        $title = "Pelis ordenadas por año (nuevas a antinguas)";
        $films = FilmController::readFilms();

        $sort_films = collect($films)->sortByDesc('year');

        return view('films.list', ["films" => $sort_films, "title" => $title]);
    }
    public function countFilms()
    {
        $title = "¿Cuántas películas hay?";
        $films = FilmController::readFilms();
        $count_films = count($films);

        return view('films.counter', ["films" => $count_films, "title" => $title]);
    }
    public function listGenreFilms($genre = null)
    {
        $title = "Listado de Pelis del género";
        $films = FilmController::readFilms();

        $genre_films = [];
        foreach ($films as $film) {
            if ($film['genre'] == $genre) {
                $genre_films[] = $film;
            }
        }

        return view('films.list', [
            "films" => $genre_films,
            "title" => $title
        ]);
    }
    /**
     * Lista TODAS las películas o filtra x año o categoría.
     */
    public function listFilms($year = null, $genre = null)
    {
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        //if year and genre are null
        if (is_null($year) && is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on year or genre informed
        foreach ($films as $film) {
            if ((!is_null($year) && is_null($genre)) && $film['year'] == $year) {
                $title = "Listado de todas las pelis filtrado x año";
                $films_filtered[] = $film;
            } else if ((is_null($year) && !is_null($genre)) && strtolower($film['genre']) == strtolower($genre)) {
                $title = "Listado de todas las pelis filtrado x categoria";
                $films_filtered[] = $film;
            } else if (!is_null($year) && !is_null($genre) && strtolower($film['genre']) == strtolower($genre) && $film['year'] == $year) {
                $title = "Listado de todas las pelis filtrado x categoria y año";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }
    public function createFilm(Request $request)
    {
        $name = $request->input('name');
        $year = $request->input('year');
        $genre = $request->input('genre');
        $country = $request->input('country');
        $duration = $request->input('duration');
        $img_url = $request->input('img_url');
        $films = FilmController::readFilms();
        
    
        if ($this->isFilm($name)) {
        return redirect()->back()
            ->withInput()
            ->withErrors(['name' => 'Esta película ya existe']);
    }
        $films[] = [
            "name" => $name,
            "year" => $year,
            "genre" => $genre,
            "country" => $country,
            "duration" => $duration,
            "img_url" => $img_url
        ];
        Storage::disk('public')->put('films.json', json_encode($films));
        $title = "Listado de películas";
        return view('films.list', [
            "films" => $films,
            "title" => $title
        ]);
    }
    public function isFilm(string $name): bool
    {
        $films = FilmController::readFilms();
        foreach ($films as $film) {
            if ($film['name'] == $name) {
                return true;
            }
        }
        return false;
    }
}