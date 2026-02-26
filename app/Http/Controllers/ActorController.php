<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class ActorController extends Controller
{
    //
     public function listActors()
    {
        $title = "Listado de todos los actores";
        $actors=DB::table('actors')->get();
        return view("actors.list", ["actors" => $actors, "title" => $title]);
    }
}