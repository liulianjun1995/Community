<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Zan extends Model
{
    protected $fillable = [
        'user_id','comment_id'
    ];
}
