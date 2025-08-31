<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $table = 'registrations';
    protected $primaryKey = 'id_registration';
    public $timestamps = true;

    protected $fillable = [
        'date',
        'approved',
        'id_user',
        'id_call'
    ];

    //relaciones
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function call()
    {
        return $this->belongsTo(Call::class, 'id_call');
    }

}
