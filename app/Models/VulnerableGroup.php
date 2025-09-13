<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VulnerableGroup extends Model
{
    protected $fillable = ['name'];
    public $timestamps = true;

//Un VulnerableGroup tiene muchos Scholarship
    public function scholarships()
    {
        return $this->hasMany(Scholarship::class);  
    }
}