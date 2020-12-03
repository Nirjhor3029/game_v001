<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashFlowStatement extends Model
{
    use HasFactory;
    protected $table = "cash_flow_statements";
    protected $fillable = [
        'user_id', 'game_id', 'total_revenue', 'total_expanses'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}