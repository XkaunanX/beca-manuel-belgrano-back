<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Renewal extends Model
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

    // Una Renewal pertenece a un solo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Una Renewal pertenece a una Call
    public function call()
    {
        return $this->belongsTo(Call::class);
    }
}
