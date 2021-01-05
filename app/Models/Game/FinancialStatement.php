<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Game\FinancialStatement
 *
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property float $total_revenue
 * @property float $total_expanses
 * @property string $session_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatement query()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatement whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatement whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatement whereTotalExpanses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatement whereTotalRevenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatement whereUserId($value)
 * @mixin \Eloquent
 */
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