<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Assignment extends Model
{
    use HasFactory, Notifiable;
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

    public function users()
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }

    public function mark()
    {
        return $this->hasMany('App\Models\Mark');
    }
}
