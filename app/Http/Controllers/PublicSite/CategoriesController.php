<?php

namespace App\Http\Controllers\PublicSite;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Category\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    /**
     * @return Application|Factory|View
    **/
    public function index()
    {
        $catalog = Category::where([
                ['related_to', Product::class],
                ['behavior_type', 'category']
            ])
            ->select('slug')
            ->firstOrFail();

        $category = Category::where([
                ['related_to', Product::class],
                ['behavior_type', 'filter'],
                ['is_primary', true]
            ])
            ->select('id', 'slug')
            ->firstOrFail();

        $categories = Category::where('parent_id', $category->id)
            ->orderByDesc('_lft')
            ->get();

        foreach ($categories as $item) {
            $item->url = url('products/'. $catalog->slug .'/'. $category->slug .'_'. $item->slug);
        }

        $response = [
            'products'    => Product::where('is_popular', true)->limit(16)->get(),
            'categories'  => $categories,
            'catalog_url' => url('products/'. $catalog->slug)
        ];

        return view('public.pages.categories', compact('response'));
    }
}
