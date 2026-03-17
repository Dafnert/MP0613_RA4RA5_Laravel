<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Actor;


class ActorController extends Controller
{
    //
    public function listActors()
    {
        $title = "Listado de todos los actores";
        $actors = Actor::all();
        return view("actors.list", ["actors" => $actors, "title" => $title]);
    }
    public function listActorsByDecade($year = null)
    {
        $title = "Buscar actores por criterio";

        $start = $year;
        $end = $year + 9;

        $actors = Actor::whereYear('birthdate', '>=', $start)
            ->whereYear('birthdate', '<=', $end)
            ->get();

        return view("actors.list", ["actors" => $actors, "title" => $title]);
    }
}