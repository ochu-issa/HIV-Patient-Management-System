<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDetails extends Model
{
    use HasFactory;

    protected $guarded = [];

    //belng to Patient
    public function Pattient()
    {
        return $this->belongsTo(Pattient::class, 'patient_id');
    }

    public function patientDetailItem()
    {
        return $this->hasOne(PatientDetailItem::class, 'patient_details_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }
}
