<?php

namespace App\Http\Controllers;

use App\Models\BankBranch;
use Illuminate\Http\Request;

class BankBranchController extends Controller
{
    // GET /api/bank-branches
    public function index(Request $request)
    {
        $query = BankBranch::select('id', 'name', 'street', 'number', 'city', 'province_id');

        // Filtrar por provincia si viene el parámetro
        if ($request->has('province_id')) {
            $query->where('province_id', $request->province_id);
        }

        $branches = $query->get();

        return response()->json($branches);
    }

    // GET /api/bank-branches/{id}
    public function show($id)
    {
        $branch = BankBranch::select('id', 'name', 'street', 'number', 'city', 'province_id')
            ->find($id);

        if (!$branch) {
            return response()->json(['message' => 'Sucursal no encontrada'], 404);
        }

        return response()->json($branch);
    }

    // POST /api/bank-branches
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'street' => 'required|string',
            'number' => 'nullable|string',
            'city' => 'required|string',
            'province_id' => 'required|integer|exists:provinces,id',
        ]);

        $branch = BankBranch::create($validated);

        return response()->json($branch, 201);
    }

    // PUT /api/bank-branches/{id}
    public function update(Request $request, $id)
    {
        $branch = BankBranch::find($id);
        if (!$branch) {
            return response()->json(['message' => 'Sucursal no encontrada'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'street' => 'sometimes|required|string',
            'number' => 'nullable|string',
            'city' => 'sometimes|required|string',
            'province_id' => 'sometimes|required|integer|exists:provinces,id',
        ]);

        $branch->update($validated);

        return response()->json($branch);
    }

    // DELETE /api/bank-branches/{id}
    public function destroy($id)
    {
        $branch = BankBranch::find($id);
        if (!$branch) {
            return response()->json(['message' => 'Sucursal no encontrada'], 404);
        }

        $branch->delete();

        return response()->json(null, 204);
    }
}
