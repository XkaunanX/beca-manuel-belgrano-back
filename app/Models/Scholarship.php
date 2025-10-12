<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    protected $fillable = [
        'user_id',
        'genre_id',
        'name',
        'last_name',
        'date_birth',
        'cuil',
        'cuit',
        'children',
        'social_coverage',
        'state_id',
        'civil_status_id',
        'nationality_id',
        'vulnerable_group_id',
        'bank_branch_id'
    ];

    protected $casts = [
        'date_birth' => 'datetime',
    ];

    // Relaciones

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scholarshipAcademicPlans()
    {
        return $this->hasMany(ScholarshipAcademicPlan::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function employments()
    {
        return $this->hasMany(Employment::class);
    }

    public function gender()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }

    public function civilStatus()
    {
        return $this->belongsTo(CivilStatus::class, 'civil_status_id');
    }

    public function vulnerableGroup()
    {
        return $this->belongsTo(VulnerableGroup::class, 'vulnerable_group_id');
    }

    public function scholarshipPayments()
    {
        return $this->hasMany(Payment::class);
    }

    public function bankBranch()
    {
        return $this->belongsTo(BankBranch::class, 'bank_branch_id');
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    public function familyMembers()
    {
        return $this->hasMany(FamilyMember::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}
