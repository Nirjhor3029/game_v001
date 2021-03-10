<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantGroup extends Model
{
    use HasFactory;

    public function marketCosts()
    {
        return $this->hasMany(MarketCost::class, 'market_id', 'id');
    }
    public function restaurantPoints()
    {
        return $this->hasMany(RestaurantPoint::class, 'res_group_id', 'id');
    }
}
