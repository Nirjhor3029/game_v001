<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Game\RevenueOther
 *
 * @property int $id
 * @property int $revenue_id
 * @property float|null $month1_unit
 * @property float|null $month1_revenue
 * @property float|null $month2_unit
 * @property float|null $month2_revenue
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueOther newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueOther newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueOther query()
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueOther whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueOther whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueOther whereMonth1Revenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueOther whereMonth1Unit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueOther whereMonth2Revenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueOther whereMonth2Unit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueOther whereRevenueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueOther whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RevenueOther extends Model
{
    use HasFactory;
}
