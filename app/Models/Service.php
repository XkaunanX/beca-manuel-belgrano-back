<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $fillable = ['name', 'description', 'week_hours', 'start_date', 'end_date'];

    // Un Service pertenece a una sola Unit
    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    // Un Service pertenece a un solo Scolarship
    public function scholarship(){
        return $this->belongsTo(Scholarship::class);
    }
}
