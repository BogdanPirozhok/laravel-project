<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManagerMailingList extends Model
{
    const VACANCY = 1;
    const TENDER = 2;
    const CONTACT = 3;
    const QUALITY = 4;
    const CATALOG = 5;

    protected $fillable = [
        'type', 'emails',
    ];

    protected $casts = [
        'emails' => 'array'
    ];
}
