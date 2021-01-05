<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Game\FinancialStatementItems
 *
 * @property int $id
 * @property string $title
 * @property float $value
 * @property int $financial_id
 * @property string $session_id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatementItems newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatementItems newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatementItems query()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatementItems whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatementItems whereFinancialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatementItems whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatementItems whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatementItems whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatementItems whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatementItems whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatementItems whereValue($value)
 * @mixin \Eloquent
 */
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