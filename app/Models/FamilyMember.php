<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    protected $fillable = ['name', 'last_name', 'social_coverage'];
    public $timestamps = true;

    public function scholarships()
    {
        return $this->belongsToMany(Scholarship::class, 'family_member_scholarship');
    }

    //Un FamilyMember tiene muchos Jobs
    public function Employments(){
        return $this->hasMany(Employment::class);  
    }

    //Un FamilyMember tiene muchos Assets
    public function assets(){
        return $this->hasMany(Asset::class);    
    }
}
