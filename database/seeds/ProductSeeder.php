<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attachable = ((new Product)->getAttachableCategories([], true));
        $tags = App\Repositories\Category\Models\Category::where('behavior_type', 'image_tag')->pluck('id');
        $package = App\Repositories\Category\Models\Category::package()->pluck('id');

        factory(Product::class, 50)
            ->create()
            ->each(function($product) use ($attachable, $tags, $package) {
                $similarProduct = Product::whereNotIn('id', [$product->id])->inRandomOrder()->pluck('id');
                $product->similarProducts()->sync($similarProduct->random());
                $product->categories()->sync($attachable->random());
                $product->tags()->sync($tags->random());
                $product->package()->sync($package->random());
            });

    }
}
