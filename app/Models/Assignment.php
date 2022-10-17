<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'subject_id',
        'user_id',
        'title',
        'description',
        'marks',
        'submission',
        'image',
        'status',

    ];
    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function mark()
    {
        return $this->hasMany('App\Models\Mark');
    }
}
