<?php

namespace App\Http\Controllers;

use App\Models\VulnerableGroup;
use Illuminate\Http\Request;

class VulnerableGroupController extends Controller
{
    public function index()
    {
        $groups = VulnerableGroup::select('id', 'name')->get();

        return response()->json($groups);
    }
}
