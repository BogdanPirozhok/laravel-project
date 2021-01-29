<?php

namespace App\Models;

use App\Mail\VacancyWasInquired;
use App\Repositories\ManagerMailer\MailerManager;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class VacancyInquirer extends Model
{
    protected $fillable = [
        'email', 'name', 'phone', 'application_text', 'resume_file_path', 'resume_file_name', 'vacancy_id',
    ];

//    protected $dispatchesEvents = [
//        'created' => VacancyWasInquired::class
//    ];


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:s');
    }


    protected $casts = [
        'created_at' => 'datetime:d.m.Y',
    ];

    /**
     * Return related vacancy
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vacancy(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Vacancy::class, 'id', 'vacancy_id');
    }


    /**
     *
     */
    protected static function booted()
    {
        static::created(function($model) {
            (new MailerManager(ManagerMailingList::VACANCY))->mail($model);
        });
    }
}
