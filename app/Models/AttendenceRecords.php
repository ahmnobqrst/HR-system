<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttendenceRecords extends Model
{
    use HasTranslations , SoftDeletes;

    protected $guarded = [];
    public $translatable = ['status'];

    protected $casts = [
    'checkIn' => 'datetime',
    'checkOut' => 'datetime',
    'date' => 'date',
];

    public function employee()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
