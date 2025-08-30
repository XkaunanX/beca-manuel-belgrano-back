<?php

# Espacio de nombres -> organizar el codigo y evitar conflictos
namespace App\Http\Controllers;

# Importaciones (Pensar como clases con sus metodos)
use App\Models\User; # Modelo User
use Illuminate\Http\Request; # Clase Request -> Representa la peticion HTTP
use Illuminate\Support\Facades\Hash; # Permite trabajar con contraseñas encriptadas 
use Illuminate\Support\Facades\Auth; # Maneja la autenticacion de usuarios
use Illuminate\Support\Facades\Validator; # Validar datos

class AuthController extends Controller # Heredar todas las funciones basicas de un controlador en laravel
{
    // Register (name, email, password, confirm_password)
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [ # Validator -> valida la peticion 
            "name" => "required|string|max:255",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:6|confirmed",
        ]);
        if ($validator->fails()) { # La validacion fallo
            return response()->json([  # Respuesta
                "success" => false, # Devuelvo una bandera booleana
                "message" => "Validation errors", # Texto general de error
                "errors" => $validator->errors(), # Listado de tallado de los errores por campo
            ], 422); # 422 Unprocessable Entity -> no cumplen las reglas de negocio/validacion
        }
        $user = User::create([ # Creo un nuevo usuario
            "name" => $request->name, # Utilizo los campos de la request 
            "email" => $request->email,
            "password" => Hash::make($request->password), # Guardo la password hasheada
        ]);
        return response()->json([ # Respuesta
            "success" => true,
            "message" => "User registered successfully",
            "user" => $user, # Devuelvo el usuario
        ], 201); // HTTP 201 Created -> el recurso fue creado correctamente
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


        # $user = User::with('roles')->find(Auth::id());
        # $user = Auth::user()->load('roles'); Despues de obtenerlo
        $user = Auth::user(); # Obtener el usuario actualmente autenticado
        $token = $user->createToken("auth_token")->plainTextToken; # Genera el token de acceso personal

        return response()->json([ # Deveria devolver los roles
            "success" => true,
            "message" => "User logged in successfully",
            "token" => $token,
            "user" => $user,
        ], 200); # 200 OK -> La operacion tuvo exito
    }

    // Profile (user)
    public function profile(Request $request)
    {
        return response()->json([
            "success" => true,
            "message" => "Authenticated user data",
            "user" => $request->user(),
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
