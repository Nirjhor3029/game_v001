<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Game\ResultProcess
 *
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property int $process_id
 * @property float|null $assigned_value
 * @property float|null $actual_value
 * @property float|null $point_value
 * @property float|null $mark_value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess query()
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess whereActualValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess whereAssignedValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess whereMarkValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess wherePointValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess whereProcessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess whereUserId($value)
 * @mixin \Eloquent
 */
class ResultProcess extends Model
{
    use HasFactory;
}
