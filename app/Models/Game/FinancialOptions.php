<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialOptions extends Model
{
    use HasFactory;
    protected $table = "financial_options";
    protected $fillable = [
        'title', 'value'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}