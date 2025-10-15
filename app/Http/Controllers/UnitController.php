<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::select('id', 'name', 'institution_id')->get();

        return response()->json($units);
    }
}
