<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Institution extends Model
{
    use HasFactory;

    protected $table = 'institutions';
    protected $primaryKey = 'id_institution';
    public $timestamps = true;

    protected $fillable = ['name'];
}
