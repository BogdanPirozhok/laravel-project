<?php

use Illuminate\Database\Seeder;

class StoreNetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\StoreNetwork::class, 10)->create();


        // creating networks for macking related points to them
        $fixture = factory(\App\Models\StoreNetwork::class, 4)->create([
            'mark_image_path' => 'http://pirat.test/library/img/rybka.png',
            'mark_image_name' => 'rybka.png'
        ]);

        foreach ($fixture as $item) {
            factory(\App\Models\Point::class, 50)->create([
                'store_uid' => $item->store_uid,
                'type' => \App\Models\Point::NETWORK
            ]);
        }

    }
}
