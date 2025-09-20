<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'approved',
    ];

    protected $hidden = [];

    // Casting para que siempre se trate como boolean
    protected $casts = [
        'approved' => 'boolean',
        'created_at' => 'datetime',
    ];

    // Valores por defecto
    protected $attributes = [
        'approved' => false,
    ];

    public $timestamps = true; // Habilitar timestamps (created_at, updated_at)

    // Una Registration pertenece a un solo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Una Registration pertenece a una Calls
    public function call()
    {
        return $this->belongsTo(Call::class);
    }
}
