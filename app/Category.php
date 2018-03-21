<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillables = [
        'id', 'name',
    ];

    public $incrementing = false;
}
