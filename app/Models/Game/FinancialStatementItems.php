<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialStatementItems extends Model
{
    use HasFactory;
    protected $table = "financial_statement_items";
    protected $fillable = [
        'financial_id', 'title', 'value', 'session_id', 'type'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}