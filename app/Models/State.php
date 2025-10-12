<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ['name', 'description'];

    // Un estado puede tener muchas becas
    public function scholarships()
    {
        return $this->hasMany(Scholarship::class);
    }
}
