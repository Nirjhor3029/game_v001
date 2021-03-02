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

}
