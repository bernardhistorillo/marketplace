<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChenInkToken extends Model
{
    protected $casts = [
        'attributes' => 'array',
    ];
}
