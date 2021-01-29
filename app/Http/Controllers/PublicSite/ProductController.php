<?php

namespace App\Http\Controllers\PublicSite;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductSimilarResource;
use App\Http\Resources\TruncatedResource;
use App\Models\Product;
use App\Models\Recipe;
use App\Repositories\Category\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $product = Product::with(['tags', 'package', 'similarProducts', 'similarRecipes', 'categories'])
            ->where('slug', $request->route()->parameter('product'))
            ->firstOrFail();

        $category = Category::where([
                ['related_to', Product::class],
                ['behavior_type', 'filter'],
                ['is_primary', true]
            ])
            ->select('id', 'slug')
            ->firstOrFail();

        $query = Category::where('behavior_type', 'category')
            ->select('related_to', 'name', 'slug')
            ->get();

        $catalog = [
            'product' => $query->where('related_to', Product::class)->first(),
            'recipe'  => $query->where('related_to', Recipe::class)->first()
        ];

        $category->descendants = $product->categories->where('parent_id', $category->id)->first();

        if ( !$category->descendants ) {
            abort(404);
        }

        $product->similar_products = $product->similarProducts->take(4);
        $product->package          = $product->package->first();

        $meta_title       = $product->meta_title ?? null;
        $meta_description = $product->meta_description ?? null;

        $response = [
            'data'    => $product,
            'recipes' => [
                'data' => $product->similarRecipes->first(),
                'link' => url('/recipes/'. $catalog['recipe']->slug)
            ],
            'paths'   => [
                'home' => [
                    'name' => 'Главная',
                    'link' => url('/')
                ],
                'catalog' => [
                    'name' => $catalog['product']->name,
                    'link' => url('/products/'. $catalog['product']->slug)
                ],
                'category' => [
                    'name' => $category->descendants->name,
                    'link' => url('/products/'. $catalog['product']->slug .'/'. $category->slug .'_'. $category->descendants->slug)
                ],
                'product' => [
                    'name' => $product->name,
                    'link' => $product->url
                ]
            ]
        ];

        return view('public.pages.product', compact('response', 'meta_title', 'meta_description'));
    }
}
