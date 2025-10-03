<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{

    protected $fillable = [
        'user_goal_id',
        'amount',
    ];


}
