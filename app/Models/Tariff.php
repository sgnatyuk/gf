<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    protected $table = 'tariffs';

    protected $guarded = [];

    protected $casts = [
        'name'          => 'string',
        'description'   => 'string',
        'price'         => 'float',
        'disabled_days' => 'array',
    ];
}
