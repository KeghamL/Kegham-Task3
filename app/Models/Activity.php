<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'urladdress',

    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
