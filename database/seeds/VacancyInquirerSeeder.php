<?php

use Illuminate\Database\Seeder;

class VacancyInquirerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vacancies = \App\Models\Vacancy::pluck('id');

        factory(\App\Models\VacancyInquirer::class, 50)->create()
            ->each(function ($inquirer) use ($vacancies) {
                $inquirer->update([
                    'vacancy_id' => $vacancies->random(),
                ]);
            });
    }
}
