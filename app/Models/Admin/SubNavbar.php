<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
