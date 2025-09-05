<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Academic_plan extends Model
{
    use HasFactory;

    protected $table = 'academic_plans';
    protected $primaryKey = 'id_academic_plan';
    public $timestamps = true;

    protected $fillable = ['years','level','subject_count','name'];
}
