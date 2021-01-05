<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Configure
 *
 * @property int $id
 * @property float $budget
 * @property float $recruitment_max_budget
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Configure newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Configure newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Configure query()
 * @method static \Illuminate\Database\Eloquent\Builder|Configure whereBudget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configure whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configure whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configure whereRecruitmentMaxBudget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configure whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Configure extends Model
{
    use HasFactory;
}
