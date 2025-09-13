<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['amount', 'date'];

    public $timestamps = true;

    protected $casts = [
        'date' => 'date',
    ];

    // Un Payment pertenece a un Scholarship
    public function scholarship(){
        return $this->belongsTo(Scholarship::class);    
    }

    //Un Payment pertenece a un BankBranch
    public function bankBranch(){
        return $this->belongsTo(BankBranch::class); 
    }
}
