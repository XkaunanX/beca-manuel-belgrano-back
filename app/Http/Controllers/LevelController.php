<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::select('id', 'name', 'description')->get();

        return response()->json($levels);
    }
}
