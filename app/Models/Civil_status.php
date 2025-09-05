<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Civil_status extends Model
{
    use HasFactory;

    protected $table = 'civil_statuses';
    protected $primaryKey = 'id_civil_status';
    public $timestamps = 'true';

    protected $fillate = ['name'];
}
