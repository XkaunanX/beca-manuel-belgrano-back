<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitCareer extends Model
{
    public $timestamps = true;

    // UnitCareer pertenece a una sola Unit
    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    // UnitCareer pertenece a una sola Careers
    public function career(){
        return $this->belongsTo(Career::class);
    }
}
