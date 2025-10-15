<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scholarship;
use Illuminate\Support\Facades\Log;  // Para logs detallados

class ScholarshipController extends Controller
{
    /**
     * Devuelve los datos personales del usuario autenticado.
     * Si algún dato no está disponible, se devuelve "Pendiente de completar".
     * Incluye manejo de errores y logs para depuración.
     */
    public function getMyScholarData(Request $request)
    {
        try {
            // Obtenemos el usuario autenticado (Laravel Sanctum)
            $user = $request->user();

            Log::info('Intentando obtener datos para usuario ID: ' . ($user ? $user->id : 'No autenticado'));

            if (!$user) {
                Log::error('Error: Usuario no autenticado');
                return response()->json([
                    'error' => 'Usuario no autenticado',
                    'details' => 'No se encontró usuario en la request.'
                ], 401);
            }

            // Inicializamos con datos base del usuario (usando campos del esquema users, asumiendo)
            $data = [
                'nombre' => $user->name ?? 'Pendiente de completar',
                'apellido' => $user->last_name ?? 'Pendiente de completar',  // Si existe en users
                'dni' => $user->dni ?? 'Pendiente de completar',  // Verifica si existe
                'fecha_nacimiento' => $user->birth_date ?? 'Pendiente de completar',
                'email' => $user->email ?? 'Pendiente de completar',
            ];

            Log::info('Datos iniciales del usuario: ' . json_encode($data));

            // Buscamos la scholarship del usuario con eager loading de relaciones
            if (!method_exists($user, 'scholarship')) {
                Log::error('Error: Relación scholarship no definida en el modelo User');
                return response()->json([
                    'error' => 'Error interno: Relación no configurada',
                    'details' => 'Verifica la relación en App\Models\User.'
                ], 500);
            }

            $scholarship = $user->scholarship()->with(['user', 'nationality'])->first();

            if (!$scholarship) {
                Log::warning('No se encontró beca para usuario ID: ' . $user->id);
                return response()->json([
                    'error' => 'No se encontró beca para este usuario.',
                    'details' => 'Verifica si el usuario tiene una beca asociada.'
                ], 404);
            }

            Log::info('Beca encontrada para usuario ID: ' . $user->id);

            // Accedemos a datos de la relación user (email del usuario asociado)
            if (!isset($scholarship->user)) {
                Log::warning('Relación user en scholarship no cargada para usuario ID: ' . $user->id);
            }
            $userData = $scholarship->user ?? null;

            // Override con datos de la scholarship y relaciones si existen
            // Usamos campos del esquema scholarships (cuil, cuit, etc.)
            $data['nombre'] = $scholarship->name ?? $data['nombre'];
            $data['apellido'] = $scholarship->last_name ?? $data['apellido'];
            $data['dni'] = ($scholarship->cuil ?? $scholarship->cuit) ?? $data['dni'];  // Prioridad CUIL/CUIT como en el esquema
            $data['fecha_nacimiento'] = $scholarship->date_birth?->format('Y-m-d') ?? $data['fecha_nacimiento'];
            $data['email'] = $userData?->email ?? $data['email'];  // De la relación

            // Agregamos campos adicionales del esquema si son relevantes (ej. genre_id, si existe)
            if (isset($scholarship->genre_id)) {
                $data['genre_id'] = $scholarship->genre_id ?? 'Pendiente de completar';
            }

            Log::info('Datos finales de la beca: ' . json_encode($data));

            return response()->json($data);  // Respuesta exitosa
        } catch (\Exception $e) {
            // Captura cualquier excepción y loguea detalles
            Log::error('Error en getMyScholarData: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'user_id' => $request->user()?->id ?? 'No autenticado',
                'exception_code' => $e->getCode(),
            ]);

            return response()->json([
                'error' => 'Error interno del servidor',
                'details' => $e->getMessage(),  // Solo en dev; quita en prod
                'code' => $e->getCode(),
            ], 500);
        }
    }
}
