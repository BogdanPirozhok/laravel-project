<?php


namespace App\Repositories\ManagerMailer;


use App\Mail\NewTenderRequest;
use App\Models\ManagerMailingList;
use Illuminate\Support\Facades\Mail;

class TenderMailer extends AbstractMailer
{

    public function mail($model)
    {
        $list = ManagerMailingList::where('type', ManagerMailingList::TENDER)->first();

        if($list) {
            Mail::to($list->emails)->send(new NewTenderRequest($model));
        }
    }

    public function store()
    {
        // TODO: Implement store() method.
    }
}
