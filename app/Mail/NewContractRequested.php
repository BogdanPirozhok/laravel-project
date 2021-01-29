<?php

namespace App\Mail;

use App\Models\ContactRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewContractRequested extends Mailable
{
    use Queueable, SerializesModels;

    protected $model;

    /**
     * Create a new message instance.
     *
     * @param ContactRequest $model
     */
    public function __construct(ContactRequest $model)
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
            ->markdown('emails.contact.contact-request');
    }
}
