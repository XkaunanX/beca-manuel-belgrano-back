<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

# Modelo a tomar de ejemplo !!!

/* 
Formato qur tiene que usar:

1ro -> protected $fillable
2do -> protected $hidden
3ro -> protected function casts(): array
4to -> Relaciones (hasMany, belongsTo, etc)

*/

class Institution extends Model
{
    use HasFactory;

    protected $table = 'institutions'; # -> Si el Archivo esta en PascalCase no es nesesario definir nombre

    protected $primaryKey = 'id_institution'; # -> Esto no va, dejemos con nombre id a la PK

    public $timestamps = true; # -> Por ahora no va, cambiar valor a false

    protected $fillable = ['name']; # -> Esto dice que campos son definibles con instrucciones del tipo User::create($request->all())
                                    # Una id no va aca por ejemplo, o atributos que se definen en la base de datos

    /* -> Ejemplo, esto no va aca: Estos son los campos que el backend nunca tienen que devolver.
    protected $hidden = [
        'password',
        'remember_token',
    ];*/

    /* -> Ejemplo, esto no va aca: Esto define como se transforman los datos
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }*/
}
