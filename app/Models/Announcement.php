<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'user_id',
        'title',
        'description',

    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
