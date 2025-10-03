<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserGoal extends Model
{
    use SoftDeletes;  
    protected $fillable = [
        'name',
        'amount',
        'current_amount',
        'category_id',
        'icon_id',
        'user_id',
    ];

    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function Icon()
    {
        return $this->belongsTo(Icon::class, 'icon_id', 'id');
    }

    public function contributions()
    {
        return $this->hasMany(Contribution::class);
    }
}
