<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Scholarship;
use App\Models\ScholarshipAcademicPlan;
use App\Models\Call;
use App\Models\Registration;
use App\Models\CivilStatus;
use App\Models\Nationality;
use App\Models\VulnerableGroup;
use App\Models\State;

class RegistrationController extends Controller
{
    /**
     * Almacena una nueva inscripción del usuario autenticado.
     * Actualiza los datos del Scholarship y asigna el estado "inscripcion_pendiente".
     */
    public function store(Request $request)
    {
        // ✅ Validación de campos
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

        // ✅ Usuario autenticado
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'Usuario no autenticado.'], 401);
        }

        // ✅ Becario asociado al usuario
        $scholarship = Scholarship::where('user_id', $user->id)->firstOrFail();

        // ✅ Buscar el estado "inscripcion_pendiente" (creado previamente en la tabla states)
        $stateId = State::where('name', 'inscripcion_pendiente')->value('id');

        // ✅ Actualizar datos del becario
        $scholarship->update([
            'name'                => $validated['nombre'],
            'last_name'           => $validated['apellido'],
            'date_birth'          => $validated['fechaNacimiento'],
            'civil_status_id'     => CivilStatus::where('name', $validated['estadoCivil'])->value('id'),
            'nationality_id'      => Nationality::where('name', $validated['nacionalidad'])->value('id'),
            'children'            => $validated['cantidadHijos'],
            'vulnerable_group_id' => VulnerableGroup::where('name', $validated['grupoPrioritario'])->value('id'),
            'bank_branch_id'      => $validated['bank_branch_id'],
            'state_id'            => $stateId, // 🔥 Asignamos automáticamente el estado "inscripcion_pendiente"
        ]);

        // ✅ Registrar el plan académico del becario
        ScholarshipAcademicPlan::create([
            'scholarship_id'     => $scholarship->id,
            'academic_plan_id'   => $validated['academic_plan_id'],
            'regular'            => $request->boolean('regular', false),
            'start_semester'     => $request->input('start_semester'),
            'start_date'         => $request->input('start_date', now()),
            'end_date'           => $request->input('end_date'),
            'approved_subjects'  => $request->input('approved_subjects', 0),
        ]);

        // ✅ Buscar convocatoria activa según fecha actual
        $today = Carbon::today()->toDateString();

        $calls = Call::where(function ($q) use ($today) {
                $q->whereNull('enrollment_start_date')
                  ->orWhereDate('enrollment_start_date', '<=', $today);
            })
            ->where(function ($q) use ($today) {
                $q->whereNull('enrollment_end_date')
                  ->orWhereDate('enrollment_end_date', '>=', $today);
            })
            ->get();

        // Validaciones sobre la convocatoria
        if ($calls->count() === 0) {
            return response()->json(['message' => 'No hay ninguna convocatoria abierta para inscribirse.'], 422);
        }

        if ($calls->count() > 1) {
            return response()->json(['message' => 'Hay más de una convocatoria activa. Contacte al administrador.'], 422);
        }

        $call = $calls->first();

        // ✅ Evitar inscripciones duplicadas
        $alreadyRegistered = Registration::where('user_id', $user->id)
            ->where('call_id', $call->id)
            ->exists();

        if ($alreadyRegistered) {
            return response()->json(['message' => 'El usuario ya está inscripto en la convocatoria actual.'], 422);
        }

        // ✅ Crear inscripción
        Registration::create([
            'user_id'  => $user->id,
            'call_id'  => $call->id,
            'approved' => $request->boolean('approved', false),
        ]);

        return response()->json(['message' => 'Inscripción guardada correctamente.'], 201);
    }
}
