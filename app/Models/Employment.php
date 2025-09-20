<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    protected $fillable = ['name', 'type', 'income', 'description'];
    public $timestamps = true;

    // Un Employment pertenece a un Scholarships
    public function scholarship(){
        return $this->belongsTo(Scholarship::class);    
    }

    // Un Employment pertenece a un FamilyMember
    public function familyMember(){
        return $this->belongsTo(FamilyMember::class);   
    }
}
