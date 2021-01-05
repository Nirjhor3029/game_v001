<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\Navbar
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int|null $priority
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\SubNavbar[] $subNavbarItem
 * @property-read int|null $sub_navbar_item_count
 * @method static \Illuminate\Database\Eloquent\Builder|Navbar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Navbar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Navbar query()
 * @method static \Illuminate\Database\Eloquent\Builder|Navbar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navbar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navbar whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navbar wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navbar whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navbar whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Navbar extends Model
{
    use HasFactory;
    protected $table ="navbars";
    protected $fillable = [
        'name','slug'
    ];
    protected $hidden = [
        'created_at','updated_at'
    ];

    /**
     * Get the Sub nav-bar items for the specific nav-bar item.
     */
    public function subNavbarItem()
    {
        return $this->hasMany(SubNavbar::class);
    }
}
