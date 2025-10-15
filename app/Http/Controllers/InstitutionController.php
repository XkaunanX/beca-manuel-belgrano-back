<?php

namespace App\Http\Controllers;

use App\Models\BankBranch;
use App\Models\Institution;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{
    public function index()
    {
        $institutions = Institution::select('id', 'name')->get();

        return response()->json($institutions);
        
    }

    // InstitutionController.php
public function getLocalitiesByProvince(Request $request)
{
    $provinceId = $request->query('provinceId');
    if (!$provinceId) {
        return response()->json([], 400);
    }

    // Suponiendo que tienes un modelo Institution con relación a Locality
    $localities = BankBranch::where('province_id', $provinceId)
                           ->orderBy('name')
                           ->get(['id','name']);

    return response()->json($localities);
}

}
