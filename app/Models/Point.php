<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{

    const RETAIL = 1;
    const DISTRIBUTOR = 2;
    const NETWORK = 3;

    protected $fillable = [
        'type', 'address', 'name', 'info', 'longitude', 'latitude', 'store_uid'
    ];

    protected $casts = [
        'longitude' => 'float',
        'latitude' => 'float',
        'lng' => 'float',
        'lat' => 'float',
    ];

    public function network()
    {
        return $this->hasOne(
            StoreNetwork::class,
            'store_uid',
            'store_uid'
        );
    }
}
