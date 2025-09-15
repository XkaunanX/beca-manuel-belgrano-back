<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankBranch extends Model
{
    protected $fillable = ['name', 'street', 'number', 'city'];

    public $timestamps = true;

    // Un BankBranch se relaciona con una Provinces
    public function province(){
        return $this->belongsTo(Province::class);
    }

    // Un BanckBranch se relaciona con muchos Scholarship
    public function scholarships(){
        return $this->hasMany(Scholarship::class);
    }
}
