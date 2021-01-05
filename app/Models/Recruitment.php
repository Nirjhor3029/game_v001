<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Recruitment
 *
 * @property int $id
 * @property float $hr_manager
 * @property float $bdm
 * @property float $sales_manager
 * @property int $user_id
 * @property int $game_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Recruitment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recruitment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recruitment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Recruitment whereBdm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruitment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruitment whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruitment whereHrManager($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruitment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruitment whereSalesManager($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruitment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruitment whereUserId($value)
 * @mixin \Eloquent
 */
class Recruitment extends Model
{
    use HasFactory;
}
