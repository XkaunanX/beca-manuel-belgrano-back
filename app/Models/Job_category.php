<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_category extends Model
{
    use HasFactory;

    protected $table = 'job_categories';
    protected $primaryKey = 'id_job_category';
    public $timestamps = 'true';

    protected $fillable = ['name'];
}
