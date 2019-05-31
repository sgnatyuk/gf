<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $guarded = [];

    protected $casts = [
        'client_id' => 'integer',
        'tariff_id' => 'integer',
        'name'      => 'string',
        'address'   => 'string',
    ];

    public function tariff()
    {
        return $this->belongsTo(Tariff::class);
    }
}
