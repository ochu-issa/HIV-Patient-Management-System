<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pattient extends Model
{
    use HasFactory;

    //belng to branch
    public function Branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    //has many Patients Details
    public function PatientDetails()
    {
        return $this->hasMany(PatientDetails::class, 'patient_id');
    }
}
