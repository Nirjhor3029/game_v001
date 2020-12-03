<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $table = "budgets";
    protected $fillable = [
        'recruitment', 'manufacturing', 'launch', 'other', 'marketplace_id', 'user_id', 'game_id'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}