<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\SubNavbar
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $navbar_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Admin\Navbar $navbarItem
 * @method static \Illuminate\Database\Eloquent\Builder|SubNavbar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubNavbar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubNavbar query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubNavbar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubNavbar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubNavbar whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubNavbar whereNavbarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubNavbar whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubNavbar whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SubNavbar extends Model
{
    use HasFactory;
    protected $table ="subnavbars";
    protected $fillable = [
        'name','slug','navbar_id'
    ];
    protected $hidden = [
        'created_at','updated_at'
    ];


    public function navbarItem()
    {
        return $this->belongsTo(Navbar::class, 'navbar_id');
    }
}
