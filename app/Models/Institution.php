<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable = ['name'];
    public $timestamps = true;

    // Una Institution puede tener muchas Units
    public function units()
    {
        return $this->hasMany(Unit::class);
    }
}
