<?php


namespace App\Repositories\ManagerMailer;


use App\Mail\NewQualityFeedbackPosted;
use App\Models\ManagerMailingList;
use Illuminate\Support\Facades\Mail;

class QualityMailer extends AbstractMailer
{

    public function mail($model)
    {
        $list = ManagerMailingList::where('type', ManagerMailingList::QUALITY)->first();

        if($list) {
            Mail::to($list->emails)->send(new NewQualityFeedbackPosted($model));
        }
    }

    public function store()
    {
        // TODO: Implement store() method.
    }
}
