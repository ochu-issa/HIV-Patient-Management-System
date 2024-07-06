<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pattient extends Model
{
    use HasFactory;

    protected $fillable = ['f_name', 'l_name', 'gender', 'address', 'age', 'dob', 'phone_number', 'pattient_number', 'branch_id', 'status'];

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

    public function getFullNameAttribute()
    {
        $full_name = $this->f_name . ' ' . $this->l_name;
        return $full_name;
    }
}
