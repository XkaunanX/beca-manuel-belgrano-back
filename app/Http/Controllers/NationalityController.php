<?php

namespace App\Http\Controllers;

use App\Models\Nationality;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
    public function index()
    {
        $nationalities = Nationality::select('id', 'name')->get();

        return response()->json($nationalities);
    }
}
