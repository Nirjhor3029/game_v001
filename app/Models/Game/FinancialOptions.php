<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Game\FinancialOptions
 *
 * @property int $id
 * @property string $title
 * @property float $value
 * @property int $status 0 = fixed, 1 = dynamic
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialOptions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialOptions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialOptions query()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialOptions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialOptions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialOptions whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialOptions whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialOptions whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialOptions whereValue($value)
 * @mixin \Eloquent
 */
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