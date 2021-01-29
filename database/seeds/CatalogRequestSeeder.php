<?php

use Illuminate\Database\Seeder;

class CatalogRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\CatalogRequest::class, 50)->create();
    }
}
