<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    //belong to Branch
    public function Branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
