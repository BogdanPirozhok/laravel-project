<?php

namespace App\Mail;

use App\Models\VacancyInquirer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VacancyWasInquired extends Mailable
{
    use Queueable, SerializesModels;

    protected $inquirer;

    /**
     * Create a new message instance.
     *
     * @param $inquirer
     */
    public function __construct(VacancyInquirer $inquirer)
    {
        $this->inquirer = $inquirer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'), config('app.name'))
            ->with(['inquirer' => $this->inquirer])
            ->markdown('emails.vacancy.inquired');
    }
}
