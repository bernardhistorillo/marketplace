<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MustachioverseAsset extends Model
{
    protected $fillable = [
        'group_id',
        'name',
        'description',
        "image",
        "thumbnail",
        "attributes",
        'supply'
    ];

    protected $casts = [
        'attributes' => 'array',
    ];
}
