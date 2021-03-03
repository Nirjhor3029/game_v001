<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gm2MarketPromotion extends Model
{
    use HasFactory;

    public function marketCost ()
    {
        return $this->belongsTo(MarketCost::class);
    }
}
