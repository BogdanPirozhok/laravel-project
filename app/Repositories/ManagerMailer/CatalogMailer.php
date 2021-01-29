<?php


namespace App\Repositories\ManagerMailer;


use App\Mail\NewCatalogRequest;
use App\Models\ManagerMailingList;
use Illuminate\Support\Facades\Mail;

class CatalogMailer extends AbstractMailer
{

    public function mail($model)
    {
        $list = ManagerMailingList::where('type', ManagerMailingList::CATALOG)->first();

        if ($list) {
            Mail::to($list->emails)->send(new NewCatalogRequest($model));
        }
    }

    public function store()
    {
        // TODO: Implement store() method.
    }
}
