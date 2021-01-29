<?php


namespace App\Repositories\ManagerMailer;


use App\Mail\NewContractRequested;
use App\Models\ManagerMailingList;
use Illuminate\Support\Facades\Mail;

class ContactMailer extends AbstractMailer
{

    public function mail($model)
    {
        $list = ManagerMailingList::where('type', ManagerMailingList::CONTACT)->first();

        if($list) {
            Mail::to($list->emails)->send(new NewContractRequested($model));
        }
    }

    public function store()
    {
        // TODO: Implement store() method.
    }
}
