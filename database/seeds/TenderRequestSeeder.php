<?php

use Illuminate\Database\Seeder;

class TenderRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenderIds = \App\Models\Tender::tender()->published()->pluck('id');

        factory(\App\Models\TenderRequest::class, 50)
            ->create([
                'tender_id' => $tenderIds->random()
            ]);
    }
}
