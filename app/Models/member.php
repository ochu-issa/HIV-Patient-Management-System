<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class member extends Model
{
    use HasFactory, HasRoles;

    protected $guard_name = 'web';

    protected $guarded = [];
    
     public function users()
     {
         return $this->hasMany(User::class);
     }
}
