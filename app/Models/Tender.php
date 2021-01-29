<?php

namespace App\Models;

use App\Traits\ScopeTrait;
use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    use ScopeTrait;

    const TENDER   = 'tender';
    const PURCHASE = 'purchase';

    protected $fillable = [
        'type', 'name', 'unit', 'volume', 'description', 'is_published', 'deadline', 'job_description_file_path',
        'job_description_file_name', 'job_work_file_path', 'job_work_file_name', 'external_link'
    ];

    /**
     * @param $query
     * @return mixed
     */
    public function scopePurchase($query)
    {
        return $query->where('type', Tender::PURCHASE);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeTender($query)
    {
        return $query->where('type', Tender::TENDER);
    }
}

