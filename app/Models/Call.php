<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    use HasFactory;

    protected $table = 'calls';
    protected $primaryKey = 'id_call';
    public $timestamps = true;

    protected $fillable = ['starting_date', 'end_date', 'hours', 'points'];

    protected $casts = [
        'starting_date' => 'date',
        'end_date' => 'date'
    ];
}