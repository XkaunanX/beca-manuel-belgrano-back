<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = ['name', 'type', 'income', 'description'];
    public $timestamps = true;

    // Un Job pertenece a un Scholarship
    public function scholarship(){
        return $this->belongsTo(Scholarship::class);    
    }

    //Un Job pertenece a un FamilyMember
    public function familyMember(){
        return $this->belongsTo(FamilyMember::class);   
    }
}
