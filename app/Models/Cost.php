<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subCosts(){

        return $this->hasMany('App\Models\Cost', 'parent_id');

    }
}
