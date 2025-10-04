<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use App\Models\ScholarshipAcademicPlan;
use Illuminate\Support\Carbon;
use App\Models\Call;
use App\Models\Registration;
use App\Models\CivilStatus;
use App\Models\Nationality;
use App\Models\VulnerableGroup;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'              => 'required|string|max:255',
            'apellido'            => 'required|string|max:255',
            'fechaNacimiento'     => 'required|date',
            'estadoCivil'         => 'required|string',
            'nacionalidad'        => 'required|string',
            'cantidadHijos'       => 'required|integer|min:0',
            'grupoPrioritario'    => 'required|string',
            'academic_plan_id'    => 'required|integer|exists:academic_plans,id',
            'bank_branch_id'      => 'required|integer|exists:bank_branches,id',
        ]);

        $user = auth()->user();

        $scholarship = Scholarship::where('user_id', $user->id)->firstOrFail();

        $scholarship->update([
            'name'                => $validated['nombre'],
            'last_name'           => $validated['apellido'],
            'date_birth'          => $validated['fechaNacimiento'],
            'civil_status_id'     => CivilStatus::where('name', $validated['estadoCivil'])->value('id'),
            'nationality_id'      => Nationality::where('name', $validated['nacionalidad'])->value('id'),
            'children'            => $validated['cantidadHijos'],
            'vulnerable_group_id' => VulnerableGroup::where('name', $validated['grupoPrioritario'])->value('id'),
            'bank_branch_id'      => $validated['bank_branch_id'],
        ]);

        ScholarshipAcademicPlan::create([
            'scholarship_id'     => $scholarship->id,
            'academic_plan_id'   => $validated['academic_plan_id'],
            'regular'            => $request->regular ?? false,
            'start_semester'     => $request->start_semester ?? null,
            'start_date'         => $request->start_date ?? now(),
            'end_date'           => $request->end_date ?? null,
            'approved_subjects'  => $request->approved_subjects ?? 0,
        ]);

        $today = Carbon::today()->toDateString();

        $calls = Call::where(function ($q) use ($today) {
            $q->whereNull('enrollment_start_date')
              ->orWhereDate('enrollment_start_date', '<=', $today);
        })->where(function ($q) use ($today) {
            $q->whereNull('enrollment_end_date')
              ->orWhereDate('enrollment_end_date', '>=', $today);
        })->get();

        if ($calls->count() === 0) {
            return response()->json(['message' => 'No hay ninguna convocatoria abierta para inscribirse.'], 422);
        }

        if ($calls->count() > 1) {
            return response()->json(['message' => 'Hay más de una convocatoria activa. Contacte al administrador.'], 422);
        }

        $call = $calls->first();

        if (Registration::where('user_id', $user->id)->where('call_id', $call->id)->exists()) {
            return response()->json(['message' => 'El usuario ya está inscripto en la convocatoria actual.'], 422);
        }

        $registration = new Registration();
        $registration->user_id = $user->id;
        $registration->call_id = $call->id;
        $registration->approved = $request->input('approved', false);
        $registration->save();


        return response()->json(['message' => 'Inscripción guardada correctamente.'], 201);
    }
}
