<?php

# Espacio de nombres -> organizar el codigo y evitar conflictos
namespace App\Http\Controllers;

# Importaciones (Pensar como clases con sus metodos)
use App\Models\User; # Modelo User
use App\Models\Scholarship;
use App\Models\Genre;
use Illuminate\Http\Request; # Clase Request -> Representa la peticion HTTP
use Illuminate\Support\Facades\Hash; # Permite trabajar con contraseñas encriptadas 
use Illuminate\Support\Facades\Auth; # Maneja la autenticacion de usuarios
use Illuminate\Support\Facades\Validator; # Validar datos

class AuthController extends Controller # Heredar todas las funciones basicas de un controlador en laravel
{
    // Register (name, email, password, confirm_password)
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:6|confirmed",
            "nombre" => "required|string|max:255",
            "apellido" => "required|string|max:255",
            "cuitCuil" => "required|digits:11|unique:scholarships,cuit",
            "genero" => [
                "required",
                "string",
                function ($attribute, $value, $fail) {
                    if (!Genre::where('name', $value)->exists()) {
                        $fail("El genero seleccionado es invalido.");
                    }
                }
            ],
        ], [
            "email.unique" => "El email ya está registrado. Por favor usá otro.",
            "cuitCuil.unique" => "El CUIT/CUIL ya existe en el sistema.",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation errors",
                "errors" => $validator->errors(),
            ], 422);
        }

        try {
            // Creamos el usuario
            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
            ]);

            // Obtenemos el id del genero
            $genre = Genre::where('name', $request->genero)->first();
            if (!$genre) {
                return response()->json([
                    "success" => false,
                    "message" => "Genero invalido"
                ], 422);
            }

            // Creamos el scholarship con genre_id
            $scholarship = Scholarship::create([
                "user_id" => $user->id,
                "name" => $request->nombre,
                "last_name" => $request->apellido,
                "cuit" => $request->cuitCuil,
                "genre_id" => $genre->id,
            ]);

            return response()->json([
                "success" => true,
                "message" => "User and scholarship registered successfully",
                "user" => [
                    "id" => $user->id,
                    "name" => $user->name,
                    "email" => $user->email,
                    "roles" => $user->roles->pluck('name'),
                ],
                "scholarship" => [
                    "id" => $scholarship->id,
                    "name" => $scholarship->name,
                    "last_name" => $scholarship->last_name,
                    "cuit" => $scholarship->cuit,
                    "genre_id" => $scholarship->genre_id,
                ],
            ], 201);
        } catch (\Exception $e) {
            error_log('Error creating user: ' . $e->getMessage());
            error_log($e->getTraceAsString()); // stack trace completo
            return response()->json([
                "success" => false,
                "message" => "Error creating user",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    // Login (email, password)
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [ # Valida 
            "email" => "required|email",
            "password" => "required",
        ]);

        if ($validator->fails()) { # Respuesta
            return response()->json([
                "success" => false,
                "message" => "Validation errors",
                "errors" => $validator->errors(),
            ], 422); # 422 Unprocessable Entity -> no cumplen las reglas de negocio/validacion.
        }

        if (!Auth::attempt($request->only("email", "password"))) {
            return response()->json([
                "success" => false,
                "message" => "Invalid credentials",
            ], 401); # 401 Unauthorize -> No tiene credenciales validas de autenticacion
        }


        $user = Auth::user()->load('roles');
        $token = $user->createToken("auth_token")->plainTextToken; # Genera el token de acceso personal

        return response()->json([ # Deveria devolver los roles
            "success" => true,
            "message" => "User logged in successfully",
            "token" => $token,
            "user" => [
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email,
                "roles" => $user->roles->pluck('name'),
            ],
        ], 200); # 200 OK -> La operacion tuvo exito
    }

    // Profile (user)
    public function profile(Request $request)
    {
        $user = $request->user()->load('roles');
        return response()->json([
            "success" => true,
            "message" => "Authenticated user data",
            "user" => [
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email,
                "roles" => $user->roles->pluck('name'),
            ],
        ], 200); # 200 OK -> La operacion tuvo exito
    }

    // Logout Api ()
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete(); # Obtiene el token de acceso actual que se uso en la peticion y lo elimina de la BDD

        return response()->json([
            "success" => true,
            "message" => "Logged out successfully",
        ], 200); # 200 OK -> La operacion tuvo exito
    }
}
