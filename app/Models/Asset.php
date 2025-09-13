<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = ['name', 'type'];
    public $timestamps = true;
    //Un Asset pertenece a un Scholarship
    public function scholarship(){
        return $this->belongsTo(Scholarship::class);    
    }

    //Un Asset pertenece a un FamilyMember
    public function familyMember(){
        return $this->belongsTo(FamilyMember::class);   
    }

    
}
