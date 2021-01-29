<?php

namespace App\Mail;

use App\Models\TenderRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewTenderRequest extends Mailable
{
    use Queueable, SerializesModels;


    protected $model;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(TenderRequest $model)
    {
        $this->model = $model;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'), config('app.name'))
            ->with(['model' => $this->model])
            ->markdown('emails.tender.tender-request');
    }
}
