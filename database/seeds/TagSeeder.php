<?php

use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Repositories\Category\Models\Category;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Best Value 2020',
            'image_url' => 'http://google.com/',
            'related_to' => Product::class,
            'behavior_type' => 'image_tag'
        ]);

        Category::create([
            'name' => 'Bad Thing',
            'image_url' => 'http://google.com/',
            'related_to' => Product::class,
            'behavior_type' => 'image_tag'
        ]);

        Category::create([
            'name' => '100% natural',
            'image_url' => 'http://google.com/',
            'related_to' => Product::class,
            'behavior_type' => 'image_tag'
        ]);
    }
}
