<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpCode extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'created_by', 'otp_code', 'is_active'];

    public function patient()
    {
        return $this->belongsTo(Pattient::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
