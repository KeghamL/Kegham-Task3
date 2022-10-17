<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'assignment_id',
        'user_id',
        'description',
        'image',

    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function assignment()
    {
        return $this->belongsTo('App\Models\Assignment');
    }

    public function courses()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function mark()
    {
        return $this->hasMany('App\Models\Mark');
    }
}
