<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graph extends Model
{
    use HasFactory;

    protected $fillable = [
        'graph_item_id', 'rest_id', 'graph_point'
    ];

    public function allRestaurant()
    {
        return $this->belongsTo(Restaurant::class, 'rest_id', 'id');
    }


}
