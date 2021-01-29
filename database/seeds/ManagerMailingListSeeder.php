<?php

use App\Models\ManagerMailingList;
use Illuminate\Database\Seeder;

class ManagerMailingListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ManagerMailingList::create([
            'type' => ManagerMailingList::VACANCY,
            'emails' => [
                'example@domain.com'
            ],
        ]);
        ManagerMailingList::create([
            'type' => ManagerMailingList::TENDER,
            'emails' => [
                'example@domain.com'
            ],
        ]);
        ManagerMailingList::create([
            'type' => ManagerMailingList::CONTACT,
            'emails' => [
                'example@domain.com'
            ],
        ]);
        ManagerMailingList::create([
            'type' => ManagerMailingList::QUALITY,
            'emails' => [
                'example@domain.com'
            ],
        ]);
        ManagerMailingList::create([
            'type' => ManagerMailingList::CATALOG,
            'emails' => [
                'example@domain.com'
            ],
        ]);
    }
}
