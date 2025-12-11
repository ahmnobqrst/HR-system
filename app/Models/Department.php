<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasTranslations , SoftDeletes;
    protected $guarded = [];
    public $translatable = ['name','description'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    
}
