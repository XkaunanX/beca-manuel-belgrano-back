<?php

namespace App\Http\Controllers;

use App\Models\AcademicPlan;
use Illuminate\Http\Request;

class AcademicPlanController extends Controller
{
    public function index()
    {
        $plans = AcademicPlan::select(
            'id',
            'name',
            'years',
            'subject_count',
            'level_id',
            'career_id',
            'unit_id'
        )->get();

        return response()->json($plans);
    }
}
