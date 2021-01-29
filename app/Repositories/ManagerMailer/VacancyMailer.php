<?php


namespace App\Repositories\ManagerMailer;


use App\Mail\VacancyWasInquired;
use App\Models\ManagerMailingList;
use Illuminate\Support\Facades\Mail;

class VacancyMailer extends AbstractMailer
{

    public function mail($model)
    {
        $list = ManagerMailingList::where('type', ManagerMailingList::VACANCY)->first();

        Mail::to($list->emails)->send(new VacancyWasInquired($model));
    }

    public function store()
    {
        // TODO: Implement store() method.
        dd('store method');
    }
}
