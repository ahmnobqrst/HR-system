<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimeOffRequest extends Model
{
    use HasTranslations , SoftDeletes;
    protected $guarded = [];
    public $translatable = ['type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }
}
