<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialStatement extends Model
{
    use HasFactory;
    protected $table = "financial_statements";
    protected $fillable = [
        'user_id', 'game_id', 'total_revenue', 'total_expanses'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}