<?php

use Illuminate\Database\Seeder;

class ContactRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // disabling event dispatcher
        \App\Models\ContactRequest::unsetEventDispatcher();
        factory(\App\Models\ContactRequest::class, 50)->create();

    }
}
