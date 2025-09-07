<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory; # Permite usar factories para generar datos de prueba
use Illuminate\Foundation\Auth\User as Authenticatable; # Clase base de Laravel para usuarios que pueden autenticarse
use Illuminate\Notifications\Notifiable; # Permite enviar notificaciones al usuario (email, SMS, etc.)
use Laravel\Sanctum\HasApiTokens; # Permite manejar tokens de API con Sanctum
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable # Herencia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, HasRoles; # Uso de traits -> mecanismo que permite reutilizar codigo en varias clases sin necesidad de herencia

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [ # Define los atributos, evita asignaciones masivas no deseadas al crear un usuario
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [ # Define los atributos que no se incluyen al serializar el modelo a JSON
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array # Casts convierte automaticamente los tipos de atributos al trabajar con ellos
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}