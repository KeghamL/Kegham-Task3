<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'course',
        'branch',
    ];
    public function assignment()
    {
        return $this->hasMany('App\Models\Assignment');
    }

    public function subject()
    {
        return $this->hasMany('App\Models\Subject');
    }

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }
}
