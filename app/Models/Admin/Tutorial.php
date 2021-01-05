<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\Tutorial
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int|null $priority
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Tutorial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tutorial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tutorial query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tutorial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tutorial whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tutorial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tutorial wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tutorial whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tutorial whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tutorial extends Model
{
    use HasFactory;
    protected $table ="tutorials";
    protected $fillable = [
        'title','description'
    ];
    protected $hidden = [
        'created_at','updated_at'
    ];

}
