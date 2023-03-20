<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receptionist extends Model
{
    use HasFactory;

    //belng to branch
    public function Branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
