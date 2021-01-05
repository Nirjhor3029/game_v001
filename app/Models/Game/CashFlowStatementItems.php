<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Game\CashFlowStatementItems
 *
 * @property int $id
 * @property string $title
 * @property float $value
 * @property int $cash_flow_statement_id
 * @property string $session_id
 * @property int|null $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatementItems newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatementItems newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatementItems query()
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatementItems whereCashFlowStatementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatementItems whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatementItems whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatementItems whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatementItems whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatementItems whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatementItems whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatementItems whereValue($value)
 * @mixin \Eloquent
 */
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