<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketCost extends Model
{
    use HasFactory;

    public function market()
    {
        return $this->belongsTo(Market::class);
    }

    public function gm2MarketPromotion()
    {
        return $this->hasMany(Gm2MarketPromotion::class,'market_cost_id','id');
    }

}
