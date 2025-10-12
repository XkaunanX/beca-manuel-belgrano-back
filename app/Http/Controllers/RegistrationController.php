<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use App\Models\ScholarshipAcademicPlan;
use App\Models\Registration;
use Illuminate\Http\Request;
use Exception;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validaciones básicas, call_id obligatorio
            $validated = $request->validate([
                'fechaNacimiento'     => 'required|date',
                'civil_status_id'     => 'required|integer',
                'nationality_id'      => 'required|integer',
                'cantidadHijos'       => 'required|integer|min:0',
                'vulnerable_group_id' => 'required|integer',
                'academic_plan_id'    => 'required|integer',
                'bank_branch_id'      => 'required|integer',
                'call_id'             => 'required|integer',
                'regular'             => 'sometimes|boolean',
                'start_semester'      => 'sometimes|string|max:20',
                'start_date'          => 'sometimes|date',
                'end_date'            => 'sometimes|date',
                'approved_subjects'   => 'sometimes|integer|min:0',
                'approved'            => 'sometimes|boolean'
            ]);

            $user = auth()->user();
            if (!$user) {
                return response()->json(['message' => 'Usuario no autenticado.'], 401);
            }

            // Bloque principal con try/catch general
            $scholarship = $scholarshipPlan = $registration = null;

            try {
                // Scholarship
                $scholarship = Scholarship::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'date_birth'          => $validated['fechaNacimiento'],
                        'civil_status_id'     => $validated['civil_status_id'],
                        'nationality_id'      => $validated['nationality_id'],
                        'children'            => $validated['cantidadHijos'],
                        'vulnerable_group_id' => $validated['vulnerable_group_id'],
                        'bank_branch_id'      => $validated['bank_branch_id'],
                        'state_id'            => 1 // solo se asigna al crear
                    ]
                );

                // ScholarshipAcademicPlan
                $scholarshipPlan = ScholarshipAcademicPlan::updateOrCreate(
                    [
                        'scholarship_id' => $scholarship->id,
                        'academic_plan_id' => $validated['academic_plan_id']
                    ],
                    [
                        'regular'           => $validated['regular'] ?? false,
                        'start_semester'    => $validated['start_semester'] ?? null,
                        'start_date'        => $validated['start_date'] ?? now(),
                        'end_date'          => $validated['end_date'] ?? null,
                        'approved_subjects' => $validated['approved_subjects'] ?? 0,
                    ]
                );

                // Registration
                $registration = Registration::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'call_id' => $validated['call_id'],
                        'approved' => $validated['approved'] ?? false
                    ]
                );

            } catch (Exception $e) {
                return response()->json([
                    'message' => 'Error al guardar datos',
                    'error'   => $e->getMessage()
                ], 500);
            }

            $message = $registration->wasRecentlyCreated
                ? 'Inscripción creada correctamente.'
                : 'Inscripción actualizada correctamente.';

            return response()->json([
                'message' => $message,
                'scholarship_id' => $scholarship->id ?? null,
                'registration_id' => $registration->id ?? null
            ], $registration->wasRecentlyCreated ? 201 : 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Error de validación',
                'errors'  => $e->errors()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error al procesar la solicitud',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
