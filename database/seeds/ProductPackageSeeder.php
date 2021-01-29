<?php

use App\Models\Product;
use App\Repositories\Category\Models\Category;
use Illuminate\Database\Seeder;

class ProductPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $package = Category::create([
            'name' => 'Great package',
            'image_url' => 'http://google.com/',
            'behavior_type' => 'product_package',
            'related_to' => Product::class,
        ]);

        $package2 = Category::create([
            'name' => 'Bad package',
            'image_url' => 'http://google.com/',
            'behavior_type' => 'product_package',
            'related_to' => Product::class,
        ]);

    }
}
