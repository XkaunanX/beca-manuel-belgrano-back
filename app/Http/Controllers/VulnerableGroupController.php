<?php

namespace App\Http\Controllers;
use App\Models\VulnerableGroup;
use Illuminate\Http\Request;

class VulnerableGroupController extends Controller
{
    public function index()
    {
        return response()->json(VulnerableGroup::pluck('name'));
    }
}
