<?php

namespace App\Mail;

use App\Models\CatalogRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewCatalogRequest extends Mailable
{
    use Queueable, SerializesModels;


    protected $model;

    /**
     * Create a new message instance.
     *
     * @param CatalogRequest $model
     */
    public function __construct(CatalogRequest $model)
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
            ->markdown('emails.catalog.catalog-request');
    }
}
