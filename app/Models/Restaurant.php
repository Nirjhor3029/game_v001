<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    public function graph()
    {
        return $this->hasMany(Graph::class, 'rest_id', 'id');
    }

    public function restaurantPoint()
    {
        return $this->hasMany(RestaurantPoint::class, 'res_id', 'id');
    }
    public function restaurantUser()
    {
        return $this->hasMany(RestaurantUser::class, 'restaurant_id', 'id');
    }
}
