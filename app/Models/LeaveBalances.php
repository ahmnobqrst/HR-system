<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveBalances extends Model
{
    use HasTranslations , SoftDeletes;
    protected $guarded = [];
    public $translatable = ['leave_type'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
