<?php

namespace App\Http\Controllers;

use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::select('id', 'name')->get();

        return response()->json($genres);
    }
}
