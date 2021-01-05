<?php

namespace App\Models;

use App\Models\Game\StartGame;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Revenue
 *
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property int $market_place_id
 * @property int $product_id
 * @property float|null $product_cost
 * @property float|null $opex
 * @property float|null $total_cost
 * @property float|null $competitors_price
 * @property float|null $mark_up
 * @property float|null $price
 * @property float|null $unit_sold
 * @property float|null $revenue
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read StartGame $game
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue query()
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereCompetitorsPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereMarkUp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereMarketPlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereOpex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereProductCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereRevenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereTotalCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereUnitSold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereUserId($value)
 * @mixin \Eloquent
 */
class Revenue extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function game()
    {
        return $this->belongsTo(StartGame::class);
    }
}
