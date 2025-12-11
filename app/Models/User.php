<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Translatable\HasTranslations;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable , HasTranslations ,HasRoles , SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = []; 
    public $translatable = ['name','address','gender','job_title',];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function attendance()
    {
        return $this->hasMany(AttendenceRecords::class);
    }
    public function timeOffs()
    {
        return $this->hasMany(TimeOffRequest::class);
    }
    public function workSchedule()
    {
        return $this->belongsTo(WorkSchedules::class);
    }
    public function leaveBalances()
    {
        return $this->hasMany(LeaveBalances::class);
    }
}
