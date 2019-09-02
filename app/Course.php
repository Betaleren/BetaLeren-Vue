<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'time_length', 'thumbnail'
    ];
}
