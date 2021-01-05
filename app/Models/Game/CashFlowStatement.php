<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Game\CashFlowStatement
 *
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property float $total_revenue
 * @property float $total_expanses
 * @property string $session_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatement query()
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatement whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatement whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatement whereTotalExpanses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatement whereTotalRevenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatement whereUserId($value)
 * @mixin \Eloquent
 */
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