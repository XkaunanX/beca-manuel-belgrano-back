<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    protected $fillable = ['name', 'last_name', 'social_coverage'];
    public $timestamps = true;
    //Un FamilyMember tiene muchos Job
    public function jobs(){
        return $this->hasMany(Job::class);  
    }

    //Un FamilyMember tiene muchos Assets
    public function assets(){
        return $this->hasMany(Asset::class);    
    }
}
