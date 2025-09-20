<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    protected $fillable = ['name'];
    public $timestamps = true;

    //Una nacionalidad tiene muchos Scholarships
    public function scholarships()
    {
        return $this->hasMany(Scholarship::class);
    }

}