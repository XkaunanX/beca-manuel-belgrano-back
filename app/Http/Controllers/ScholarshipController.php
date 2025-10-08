<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scholarship;

class ScholarshipController extends Controller
{
    /**
     * Devuelve los datos personales del usuario autenticado.
     * Si algún dato no está disponible, se devuelve "Pendiente de completar".
     */
    public function getMyScholarData(Request $request)
    {
        // Obtenemos el usuario autenticado (Laravel Sanctum)
        $user = $request->user();

        // Verificamos que exista (por seguridad extra)
        if (!$user) {
            return response()->json([
                'error' => 'Usuario no autenticado'
            ], 401);
        }

        // Inicializamos con datos base del usuario
        $data = [
            'nombre' => $user->name ?? 'Pendiente de completar',
            'apellido' => $user->last_name ?? 'Pendiente de completar',
            'dni' => $user->dni ?? 'Pendiente de completar',
            'fecha_nacimiento' => $user->birth_date ?? 'Pendiente de completar',
            'email' => $user->email ?? 'Pendiente de completar',
        ];

        // Buscamos la scholarship del usuario con eager loading de relaciones (user y nationality)
        $scholarship = $user->scholarship()->with(['user', 'nationality'])->first();

        if ($scholarship) {
            // Accedemos a datos de la relación user (email del usuario asociado)
            $userData = $scholarship->user;

            // Override con datos de la scholarship y relaciones si existen
            $data['nombre'] = $scholarship->name ?? $data['nombre'];
            $data['apellido'] = $scholarship->last_name ?? $data['apellido'];
            $data['dni'] = ($scholarship->cuil ?? $scholarship->cuit) ?? $data['dni']; // Prioridad CUIL/CUIT como DNI
            $data['fecha_nacimiento'] = $scholarship->date_birth?->format('Y-m-d') ?? $data['fecha_nacimiento'];
            $data['email'] = $userData->email ?? $data['email']; // De la relación user (debería coincidir con $user->email)
        }

        // Construimos la respuesta con valores por defecto
        return response()->json($data);
    }
}
