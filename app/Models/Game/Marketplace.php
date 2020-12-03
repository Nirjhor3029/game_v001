<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketplace extends Model
{
    use HasFactory;
    protected $table = "marketplaces";
    protected $fillable = [
        'id', 'name'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}