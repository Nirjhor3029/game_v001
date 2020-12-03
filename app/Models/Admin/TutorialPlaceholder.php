<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
