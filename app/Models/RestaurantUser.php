<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantUser extends Model
{
    use HasFactory;
    protected $table = "restaurant_user";

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class,'restaurant_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function restaurantGroup()
    {
        return $this->belongsTo(RestaurantGroup::class,'rest_group_id','id');
    }
    
}
