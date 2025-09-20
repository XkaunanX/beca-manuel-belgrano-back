<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = ['name'];
    public $timestamps = true;

    // Una Province puede tener muchos BankBranchs
    public function bankBranches(){
        return $this->hasMany(BankBranch::class);
    }
}
