<?php

namespace App\Models;

use App\Mail\NewContractRequested;
use App\Mail\NewQualityFeedbackPosted;
use App\Repositories\ManagerMailer\MailerManager;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class QualityFeedback extends Model
{
    protected $fillable = [
        'purchase_date', 'purchase_place_name', 'purchase_place_address', 'barcode_file_path', 'barcode_file_name',
        'purchase_product_name', 'purchase_product_date', 'purchase_product_barcode', 'purchase_product_description',
        'wishes', 'contact_me', 'contact_name', 'contact_attribute'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:s');
    }

    protected static function booted()
    {
        static::created(function($model) {
            (new MailerManager(ManagerMailingList::QUALITY))->mail($model);
        });
    }
}
