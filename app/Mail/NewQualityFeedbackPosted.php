<?php

namespace App\Mail;

use App\Models\QualityFeedback;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewQualityFeedbackPosted extends Mailable
{
    use Queueable, SerializesModels;

    protected $model;

    /**
     * Create a new message instance.
     *
     * @param QualityFeedback $model
     */
    public function __construct(QualityFeedback $model)
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
            ->markdown('emails.quality-feedback.quality-feedback-posted');
    }
}
