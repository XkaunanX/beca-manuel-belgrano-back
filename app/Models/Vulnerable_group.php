<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vulnerable_group extends Model
{
    use HasFactory;

    protected $table = 'vulnerable_groups';
    protected $primaryKey = 'id_vulnerable_group';
    public $timestamps = 'true';

    protected $fillate = ['name'];
}
