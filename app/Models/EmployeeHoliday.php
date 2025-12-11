<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class EmployeeHoliday extends Model
{
    use SoftDeletes,HasTranslations;

    public $guarded = [];
    public $translatable = ['leave_type','reason'];

    protected $dates = ['start_date', 'end_date'];

     public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }



}
