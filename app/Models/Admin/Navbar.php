<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
