<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TitansToken extends Model
{
    protected $casts = [
        'attributes' => 'array',
    ];
}
