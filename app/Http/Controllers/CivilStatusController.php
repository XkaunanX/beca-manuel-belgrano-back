<?php

namespace App\Http\Controllers;

use App\Models\CivilStatus;
use Illuminate\Http\Request;

class CivilStatusController extends Controller
{
    public function index()
    {
        return response()->json(CivilStatus::pluck('name'));
    }
}
