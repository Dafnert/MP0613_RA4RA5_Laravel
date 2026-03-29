<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Film;


class FilmController extends Controller
{

    /**
     * Read films from storage
     */
    // public static function readFilms(): array
    // {
    //     $films = Storage::json('/public/films.json');
    //     return $films;
    // }
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
        $year = $year ?: 2000;
        $title = "Listado de Pelis Antiguas (Antes de $year)";
        $films = Film::where('year', '<', $year)->get();

        return view('films.list', ['films' => $films, 'title' => $title]);
    }
    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        $year = $year ?: 2000;
        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = Film::where('year', '>=', $year)->get();

        return view('films.list', ['films' => $films, 'title' => $title]);
    }
    public function listYearFilms($year = null)
    {
        $year = $year ?: 2000;
        $title = "Listado de Pelis por Año";
        $films = Film::where('year', $year)->get();

        return view('films.list', ['films' => $films, 'title' => $title]);
    }
    public function sortFilms()
    {

        $title = "Pelis ordenadas por año (nuevas a antiguas)";
        $films = Film::orderBy('year', 'desc')->get();

        return view('films.list', ['films' => $films, 'title' => $title]);
    }
    public function countFilms()
    {
        $title = "¿Cuántas películas hay?";
        $films = Film::count();

        return view('films.counter', ["films" => $films, "title" => $title]);
    }
    public function listGenreFilms($genre = null)
    {
        $title = "Listado de Pelis del género";

        if (is_null($genre)) {
            $films = Film::all();
        } else {
            $films = Film::where('genre', $genre)->get();
        }

        return view('films.list', ['films' => $films, 'title' => $title]);
    }
    /**
     * Lista TODAS las películas o filtra x año o categoría.
     */
    public function listFilms($year = null, $genre = null)
    {
        $query = Film::query();
        $title = "Listado de todas las pelis";

        if (!is_null($year) && !is_null($genre)) {
            $query->where('year', $year)->whereRaw('LOWER(genre) = ?', [strtolower($genre)]);
            $title = "Listado de todas las pelis filtrado x categoria y año";
        } elseif (!is_null($year)) {
            $query->where('year', $year);
            $title = "Listado de todas las pelis filtrado x año";
        } elseif (!is_null($genre)) {
            $query->whereRaw('LOWER(genre) = ?', [strtolower($genre)]);
            $title = "Listado de todas las pelis filtrado x categoria";
        }

        $films = $query->get();

        return view('films.list', ['films' => $films, 'title' => $title]);
    }
    public function createFilm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|integer|min:1800|max:' . (date('Y') + 1),
            'genre' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'img_url' => 'nullable|url|max:1024',
        ]);

        if ($this->isFilm($validated['name'])) {
            return redirect()->back()->withInput()->withErrors(['name' => 'Esta película ya existe']);
        }

        Film::create($validated);

        $title = "Listado de películas";
        $films = Film::all();

        return view('films.list', ['films' => $films, 'title' => $title]);
    }
    public function isFilm(string $name): bool
    {
        return Film::where('name', $name)->exists();
    }
    public function index()
    {
        $films = Film::with(['actors' => function($query){
            $query->select('actors.id','name', 'surname', 'birthdate', 'country', 'salary', 'img_url');
        }])->get(['films.id','name', 'year', 'genre', 'country', 'duration', 'rating', 'img_url']);
        return response()->json($films);
    }
   
}