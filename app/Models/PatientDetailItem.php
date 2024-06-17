<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDetailItem extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['patient_details_id', 'cd4_count', 'viral_load', 'allergies', 'blood_pressure', 'medication_adherence', 'diagnosis_date', 'weight', 'art_regimen', 'next_appointment_date', 'appointment_by', 'status'];

    public function patientDetail()
    {
        return $this->belongsTo(PatientDetails::class, 'patient_details_id', 'id');
    }

    public function getAppointmentWithAttribute()
    {
        if ($this->appointment_by) {
            $user = User::find($this->appointment_by);
            return $user->member->f_name.' '.$user->member->l_name;
        }
        return 'No appointment set';
    }
}
