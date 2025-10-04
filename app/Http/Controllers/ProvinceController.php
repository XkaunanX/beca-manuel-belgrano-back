<?php

namespace App\Http\Controllers;

use App\Models\BankBranch;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = Province::select('id', 'name')->get();

        return response()->json($provinces);
    }

    public function cities($provinceId)
    {
        $cities = BankBranch::where('province_id', $provinceId)
            ->distinct('city')
            ->pluck('city');

        return response()->json($cities);
    }
}
