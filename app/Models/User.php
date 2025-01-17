<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'member_id',
    //     'role_id',
    //     'password',
    // ];

    protected $fillable = ['member_id', 'role_id', 'username', 'password'];

    public function member()
    {
        return $this->belongsTo(member::class);
    }

    public function pattient()
    {
        return $this->belongsTo(Pattient::class, 'username', 'pattient_number');
    }

    public function getBranchNameAttribute()
    {
        $member = member::where('id', $this->member_id)->first();

        return $member->branch ? $member->branch->branch_name : 'No branch name available';
    }

    public function getFullNameAttribute()
    {
        $member = $this->member;

        return $member->f_name . ' ' . $member->l_name;
    }

    public function getActiveSessionsAttribute()
    {
        $query = PatientSession::query()
            ->with(['patient' => function ($query) {
                $query->select('id', 'f_name', 'l_name', 'pattient_number', 'gender');
            }])
            ->join('branches', 'branches.id', '=', 'patient_sessions.branch_id')
            ->where('patient_sessions.is_active', 1)
            ->select(
                'patient_sessions.id',
                'patient_sessions.patient_id',
                'patient_sessions.branch_id'
            )
            ->orderBy('patient_sessions.id', 'desc');

        if (!Auth::user()->hasRole('Super-Admin')) {
            $query->where('patient_sessions.branch_id', Auth::user()->member->branch_id);
        }

        return $query->get();
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        //'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
