<?php

namespace App\Http\Controllers;

use App\Models\CivilStatus;
use Illuminate\Http\Request;

class CivilStatusController extends Controller
{
    public function index()
    {
        $civilStatuses = CivilStatus::select('id', 'name')->get();

        return response()->json($civilStatuses);
    }
}
