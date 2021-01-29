<?php

use Illuminate\Database\Seeder;

class TenderAndPurchasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Tender::class, 50)
            ->states('tender')
            ->create();
        factory(\App\Models\Tender::class, 50)
            ->states('purchase')
            ->create();
    }
}
