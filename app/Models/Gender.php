<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Gender extends Model
{
    use HasFactory;
    
    protected $table = 'genders';
    protected $primaryKey = 'id_gender';
    public $timestamps = 'true';

    protected $fillable = ['name'];
}
