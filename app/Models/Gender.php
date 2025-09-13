<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $fillable = ['name'];
    public $timestamps = true;
    //Un Gender tiene muchos Scholarship
    public function scholarships()
    {
        return $this->hasMany(Scholarship::class);
    }

}