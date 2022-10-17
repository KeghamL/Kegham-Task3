<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'subjectfullname',
        'subjectshortname',
    ];

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function assignment()
    {
        return $this->hasMany('App\Models\Assignment');
    }

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }

    public function answer()
    {
        return $this->hasMany('App\Models\Answer');
    }

    public function mark()
    {
        return $this->hasMany('App\Models\Mark');
    }
}
