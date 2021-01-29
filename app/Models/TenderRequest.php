<?php

namespace App\Models;

use App\Mail\NewCatalogRequest;
use App\Mail\NewTenderRequest;
use App\Repositories\ManagerMailer\MailerManager;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TenderRequest extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'company_name', 'file_path', 'file_name',
        'text', 'data_processing', 'tender_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:s');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tender(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Tender::class, 'id', 'tender_id');
    }


    protected static function booted()
    {
        static::created(function($model) {
            (new MailerManager(ManagerMailingList::TENDER))->mail($model);
        });
    }
}
