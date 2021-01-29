<?php

use Illuminate\Database\Seeder;

class VacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Vacancy::class, 70)->create();
    }
}
