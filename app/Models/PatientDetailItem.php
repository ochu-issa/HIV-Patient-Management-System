<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDetailItem extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['patient_detail_id', 'cd4_count', 'viral_load', 'allergies', 'blood_pressure', 'medication_adherence', 'diagnosis_date', 'weight', 'art_regimen', 'next_appointment_date', 'next_appointment_date' ,'status'];

    public function patientDetail()
    {
        return $this->belongsTo(PatientDetails::class);
    }
}
