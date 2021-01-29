<?php

use Illuminate\Database\Seeder;

class QualityFeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\QualityFeedback::unsetEventDispatcher();
        factory(\App\Models\QualityFeedback::class, 30)->create();
    }
}
