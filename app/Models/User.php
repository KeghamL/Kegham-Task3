<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'course_id',
        'subject_id',
        'password',
        'repassword',
        'birthday',
        'image',
        'gender',
        'role_as',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }

    public function announcment()
    {
        return $this->hasMany('App\Models\Announcement');
    }

    public function assignment()
    {
        return $this->hasMany('App\Models\Assignment');
    }

    public function answer()
    {
        return $this->hasMany('App\Models\Answer');
    }

    public function mark()
    {
        return $this->hasMany('App\Models\Mark');
    }

    public function activity()
    {
        return $this->hasMany('App\Models\Activity');
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function($user){
        $user->assignment()->delete();
        });
        
    }
}
