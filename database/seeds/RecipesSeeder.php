<?php

use App\Models\Recipe;
use Illuminate\Database\Seeder;

class RecipesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attachable = (new Recipe)->getAttachableCategories([], true);

        factory(Recipe::class, 50)
            ->create()
            ->each(function ($recipe) use ($attachable) {
                $recipe->categories()->sync($attachable->random());
            });
    }
}
