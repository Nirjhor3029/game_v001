<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantPoint extends Model
{
    use HasFactory;

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class,'res_id','id');
    }

    public function restaurantGroup()
    {
        return $this->belongsTo(RestaurantGroup::class,'res_group_id','id');
    }

}
