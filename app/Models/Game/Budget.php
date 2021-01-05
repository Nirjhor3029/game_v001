<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Game\Budget
 *
 * @property int $id
 * @property float $recruitment
 * @property float $manufacturing
 * @property float $launch
 * @property float $other
 * @property int $marketplace_id
 * @property int $user_id
 * @property int $game_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Budget newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Budget newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Budget query()
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereLaunch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereManufacturing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereMarketplaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereOther($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereRecruitment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereUserId($value)
 * @mixin \Eloquent
 */
class Budget extends Model
{
    use HasFactory;

    protected $table = "budgets";
    protected $fillable = [
        'recruitment', 'manufacturing', 'launch', 'other', 'marketplace_id', 'user_id', 'game_id'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}