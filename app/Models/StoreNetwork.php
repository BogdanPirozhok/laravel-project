<?php

namespace App\Models;

use App\Helpers\LfmHelper;
use Illuminate\Database\Eloquent\Model;

class StoreNetwork extends Model
{

    protected $fillable = [
        'name', 'description', 'logo_image_path', 'logo_image_name',
        'mark_image_path', 'mark_image_name', 'external_url', 'store_uid'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function points()
    {
        return $this->hasMany(Point::class, 'store_uid', 'store_uid');
    }
}
