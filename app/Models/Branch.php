<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    //has many branchadmin
    public function BranchAdmin()
    {
        return $this->hasMany(BranchAdmin::class, 'branch_id');
    }

    //has many Receptionist
    public function Receptionist()
    {
        return $this->hasMany(Receptionist::class, 'branch_id');
    }

    //has many Doctors
    public function Doctor()
    {
        return $this->hasMany(Doctor::class, 'branch_id');
    }
}
