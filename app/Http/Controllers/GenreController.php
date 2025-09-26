<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // devuelve solo los nombres de los generos en un array
        return response()->json(Genre::pluck('name'));
    }
}
