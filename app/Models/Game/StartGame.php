<?php

namespace App\Models\Game;

use App\Models\Revenue;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Game\StartGame
 *
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Revenue[] $revenue
 * @property-read int|null $revenue_count
 * @method static \Illuminate\Database\Eloquent\Builder|StartGame newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StartGame newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StartGame query()
 * @method static \Illuminate\Database\Eloquent\Builder|StartGame whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StartGame whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StartGame whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StartGame whereUserId($value)
 * @mixin \Eloquent
 * @property-read User $user
 */
class StartGame extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function revenue()
    {
        return $this->hasMany(Revenue::class, 'game_id', 'id');
    }
}
