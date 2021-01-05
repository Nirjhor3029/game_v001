<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\TutorialPlaceholder
 *
 * @property int $id
 * @property string|null $title
 * @property string $placeholder
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TutorialPlaceholder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TutorialPlaceholder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TutorialPlaceholder query()
 * @method static \Illuminate\Database\Eloquent\Builder|TutorialPlaceholder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TutorialPlaceholder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TutorialPlaceholder wherePlaceholder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TutorialPlaceholder whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TutorialPlaceholder whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TutorialPlaceholder extends Model
{
    use HasFactory;
    protected $table ="tutorial_placeholder";
    protected $fillable = [
        'title','placeholder'
    ];
    protected $hidden = [
        'created_at','updated_at'
    ];

}
