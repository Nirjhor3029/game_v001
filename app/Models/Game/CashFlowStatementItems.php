<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashFlowStatementItems extends Model
{
    use HasFactory;
    protected $table = "cash_flow_statements_items";
    protected $fillable = [
        'cash_flow_statement_id', 'title', 'value', 'session_id', 'type'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}