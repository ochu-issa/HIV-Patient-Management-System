<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientSession extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'branch_id', 'patient_otp_id', 'created_by', 'updated_by', 'is_active'];

    public function patient()
    {
        return $this->belongsTo(Pattient::class, 'patient_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
