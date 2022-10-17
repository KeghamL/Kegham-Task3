<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'answer_id',
        'description',
        'mark',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function answer()
    {
        return $this->belongsTo('App\Models\Answer');
    }

    public function assignment()
    {
        return $this->belongsTo('App\Models\Assignment');
    }

    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }
}
