<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CivilStatus extends Model
{
    protected $fillable = ['name'];
    public $timestamps = true;

    // Un CivilStatus puede tenerlo muchos Scolarships
    public function scholarships(){
        return $this->hasMany(Scholarship::class);
    }
}