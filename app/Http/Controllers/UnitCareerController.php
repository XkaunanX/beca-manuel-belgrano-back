<?php

namespace App\Http\Controllers;

use App\Models\UnitCareer;
use Illuminate\Http\Request;

class UnitCareerController extends Controller
{
    public function index()
    {
        $unitCareers = UnitCareer::select('id', 'unit_id', 'career_id')->get();

        return response()->json($unitCareers);
    }
}
