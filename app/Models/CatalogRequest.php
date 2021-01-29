<?php

namespace App\Models;

use App\Mail\NewCatalogRequest;
use App\Mail\NewContractRequested;
use App\Mail\VacancyWasInquired;
use App\Repositories\ManagerMailer\MailerManager;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CatalogRequest extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'company_name', 'text', 'data_processing'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:s');
    }

    protected static function booted()
    {
        static::created(function($model) {
            (new MailerManager(ManagerMailingList::CATALOG))->mail($model);
        });
    }
}
