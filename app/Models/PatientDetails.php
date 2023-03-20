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
}
