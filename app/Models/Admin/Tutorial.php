<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
