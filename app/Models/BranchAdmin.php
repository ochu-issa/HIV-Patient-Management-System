<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Branch;

class BranchAdmin extends Model
{
    use HasFactory;
    public function Branches()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
