<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriteriaCombination extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'x_axis', 'y_axis', 'point'
    ];
}
