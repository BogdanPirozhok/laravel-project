<?php

namespace App\Http\Controllers\PublicSite;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductSimilarResource;
use App\Http\Resources\TruncatedResource;
use App\Models\Product;
use App\Models\Recipe;
use App\Repositories\Category\Models\Category;
use App\Repositories\EditorJS\EditorJsRenderer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RecipeController extends Controller
{
    /**
     * @param Request $request
     * @param EditorJsRenderer $editorRender
     * @return Application|Factory|View
     */
    public function index(Request $request, EditorJsRenderer $editorRender)
    {
        $recipe = Recipe::with(['categories'])
            ->where('slug', $request->route()->parameter('recipe'))
            ->firstOrFail();

        $recipe->body        = $editorRender->render($recipe->body);
        $recipe->ingredients = $editorRender->render($recipe->ingredients);

        $category = Category::where([
                ['related_to', Recipe::class],
                ['behavior_type', 'filter'],
                ['is_primary', true]
            ])
            ->select('id', 'slug')
            ->firstOrFail();

        $catalog = Category::where([
                ['related_to', Recipe::class],
                ['behavior_type', 'category']
            ])
            ->select('name', 'slug')
            ->firstOrFail();

        $category->descendants = $recipe->categories->where('parent_id', $category->id)->first();

        if ( !$category->descendants ) {
            abort(404);
        }

        $query_similar = DB::table('similar_recipes')
            ->where('recipe_id', $recipe->id)
            ->select('similar_product_id')
            ->pluck('similar_product_id');


        $recipe->products = Product::whereIn('id', $query_similar)->select('id', 'image_url', 'name')->limit(16)->get();


        $meta_title       = $recipe->meta_title ?? null;
        $meta_description = $recipe->meta_description ?? null;

        $response = [
            'data' => $recipe,
            'paths'   => [
                'home' => [
                    'name' => 'Главная',
                    'link' => url('/')
                ],
                'catalog' => [
                    'name' => $catalog->name,
                    'link' => url('/recipes/'. $catalog->slug)
                ],
                'category' => [
                    'name' => $category->descendants->name,
                    'link' => url('/recipes/'. $catalog->slug .'/'. $category->slug .'_'. $category->descendants->slug)
                ],
                'product' => [
                    'name' => $recipe->name,
                    'link' => $recipe->url
                ]
            ]
        ];

        return view('public.pages.recipe', compact('response', 'meta_title', 'meta_description'));
    }
}
