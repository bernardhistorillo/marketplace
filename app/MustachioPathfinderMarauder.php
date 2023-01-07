<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MustachioPathfinderMarauder extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'attributes',
        'exists',
    ];
}
