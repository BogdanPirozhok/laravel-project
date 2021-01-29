<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat = app('rinvex.categories.category');


        // categories for products
        $all_products = $cat->create([
            'name'          => 'Все продукты',
            'related_to'    => \App\Models\Product::class,
            'behavior_type' => 'category'
        ]);

        $material = $all_products->children()->create([
            'name'          => 'Сырье',
            'related_to'    => \App\Models\Product::class,
            'behavior_type' => 'filter',
            'is_primary'    => true,
            'is_published'  => true,
        ]);

        $caviar = $material->children()->create([
            'name'          => 'Икра',
            'related_to'    => \App\Models\Product::class,
            'behavior_type' => 'parameter',
            'is_published'  => true,

        ]);

        $cambala = $material->children()->create([
            'name'          => 'Камбала',
            'related_to'    => \App\Models\Product::class,
            'behavior_type' => 'parameter',
            'is_published'  => true,
        ]);

        $midii = $material->children()->create([
            'name'          => 'Мидии',
            'related_to'    => \App\Models\Product::class,
            'behavior_type' => 'parameter',
            'is_published'  => true,

        ]);


        $forel = $material->children()->create([
            'name'          => 'Форель',
            'related_to'    => \App\Models\Product::class,
            'behavior_type' => 'parameter',
            'is_published'  => true,

        ]);


        $feature = $all_products->children()->create([
            'name'          => 'Особенности',
            'related_to'    => \App\Models\Product::class,
            'behavior_type' => 'filter'

        ]);

        $k_pivu = $feature->children()->create([
            'name'          => 'К пиву',
            'related_to'    => \App\Models\Product::class,
            'behavior_type' => 'parameter'

        ]);

        $nat_color = $feature->children()->create([
            'name'          => 'Натуральный цвет',
            'related_to'    => \App\Models\Product::class,
            'behavior_type' => 'parameter'

        ]);

        $super_natural = $feature->children()->create([
            'name'          => '100% натурально',
            'related_to'    => \App\Models\Product::class,
            'behavior_type' => 'parameter'

        ]);

        $akcia = $feature->children()->create([
            'name'          => 'Акция',
            'related_to'    => \App\Models\Product::class,
            'behavior_type' => 'parameter'

        ]);


        // categories for recipes

        $recipes = $cat->create([
            'name'          => 'Все рецепты',
            'related_to'    => \App\Models\Recipe::class,
            'behavior_type' => 'category'
        ]);

        $recipes_categories = $recipes->children()->create([
            'name'          => 'Категории',
            'related_to'    => \App\Models\Recipe::class,
            'behavior_type' => 'filter',
            'is_primary'    => true,
        ]);

        $recipes_categories_cold = $recipes_categories->children()->create([
            'name'          => 'Холодные закуски',
            'related_to'    => \App\Models\Recipe::class,
            'behavior_type' => 'parameter'
        ]);

        $recipes_categories_hot = $recipes_categories->children()->create([
            'name'          => 'Горячие закуски',
            'related_to'    => \App\Models\Recipe::class,
            'behavior_type' => 'parameter'
        ]);

        $recipes_categories_dish = $recipes_categories->children()->create([
            'name'          => 'Горячие блюда',
            'related_to'    => \App\Models\Recipe::class,
            'behavior_type' => 'parameter'
        ]);


        $ingr = $recipes->children()->create([
            'name'          => 'Ингредиент',
            'related_to'    => \App\Models\Recipe::class,
            'behavior_type' => 'filter'
        ]);

        $seled = $ingr->children()->create([
            'name'          => 'Селедь',
            'related_to'    => \App\Models\Recipe::class,
            'behavior_type' => 'parameter'
        ]);

        $forel = $ingr->children()->create([
            'name'          => 'Форель',
            'related_to'    => \App\Models\Recipe::class,
            'behavior_type' => 'parameter'
        ]);

        $keta = $ingr->children()->create([
            'name'          => 'Кета',
            'related_to'    => \App\Models\Recipe::class,
            'behavior_type' => 'parameter'
        ]);

        $level = $recipes->children()->create([
            'name'          => 'Сложность приготовления',
            'related_to'    => \App\Models\Recipe::class,
            'behavior_type' => 'filter'
        ]);

        $easy = $level->children()->create([
            'name'          => 'Легко готовить',
            'related_to'    => \App\Models\Recipe::class,
            'behavior_type' => 'parameter'
        ]);

        $mid = $level->children()->create([
            'name'          => 'Средней сложность',
            'related_to'    => \App\Models\Recipe::class,
            'behavior_type' => 'parameter'
        ]);

        $hard = $level->children()->create([
            'name'          => 'Достаточно сложно',
            'related_to'    => \App\Models\Recipe::class,
            'behavior_type' => 'parameter'
        ]);


        $news_akcii = $cat->create([
            'name'          => 'Акции',
            'related_to'    => \App\Models\Post::class,
            'behavior_type' => 'taxonomy'
        ]);


        $news_new = $cat->create([
            'name'          => 'Новинки',
            'related_to'    => \App\Models\Post::class,
            'behavior_type' => 'taxonomy'
        ]);

        $news_some = $cat->create([
            'name'          => 'Розыгрыши',
            'related_to'    => \App\Models\Post::class,
            'behavior_type' => 'taxonomy'
        ]);

    }
}
