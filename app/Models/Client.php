<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $guarded = [];

    protected $casts = [
        'name'  => 'string',
        'phone' => 'string',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
