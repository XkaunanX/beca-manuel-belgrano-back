<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitCareer extends Model
{
    // Es **obligatorio** si la tabla no es plural
    protected $table = 'unit_career';

    protected $fillable = ['unit_id', 'career_id'];
}
