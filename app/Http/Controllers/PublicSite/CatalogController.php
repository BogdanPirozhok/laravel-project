<?php

namespace App\Http\Controllers\PublicSite;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Recipe;
use App\Repositories\Category\Strategies\CategoryNestedUri;
use App\Repositories\Category\UriHandler;
use Illuminate\Http\RedirectResponse;
use App\Repositories\Category\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function productCatalog(Category $category, Request $request, $params = null) {
        $response = self::getData($category, $params, $request, Product::class, [
            'method' => 'productCatalog',
            'bind'   => 'product_catalog'
        ]);

        if ( isset($response['filters']) ) {
            $response['base_path'] = url('products/'. $request->route()->parameter('product_catalog')->slug);
            return view('public.pages.products', compact('response'));
        }

        return $response;
    }

    public function recipeCatalog(Category $category, Request $request, $params = null) {
        $response = self::getData($category, $params, $request, Recipe::class, [
            'method' => 'recipeCatalog',
            'bind'   => 'recipe_catalog'
        ]);

        if ( isset($response['filters']) ) {
            $response['base_path'] = url('recipes/'. $request->route()->parameter('recipe_catalog')->slug);
            return view('public.pages.recipes', compact('response'));
        }

        return $response;
    }

    public function recipeShow() {
        $category = Category::where([
                ['related_to', Recipe::class],
                ['behavior_type', 'category']
            ])
            ->firstOrFail();

        return redirect('recipes/'. $category->slug);
    }

    public function getData($category, $params, $request, $model, $route) {
        $page    = (int) $request->get('page') ?? 0;
        $handler = new UriHandler(new CategoryNestedUri($route), $category, $model, $params);
        $return  = $handler->execute();
        $perPage = 12;

        if($return instanceof RedirectResponse) {
            //return $return;
            abort(404);
        } else {
            $group = $return['appliedFilters']->groupBy('parent_id');
            $ids   = [];

            foreach ($group as $item) {
                $ids[] = $model::withAnyCategories($item->pluck('id'))->pluck('id')->toArray();
            }

            $ids   = count($ids) > 1 ? $data = array_values(array_intersect(...$ids)) : $ids[0];
            $query = $model::whereIn('id', $ids)->orderBy('id', 'desc');

            $return['query'] = [
                'current_page' => $page,
                'total'        => $query->count(),
                'per_page'     => $perPage,
                'data'         => $query->skip($page * $perPage)->take($perPage)->get()
            ];

            if ($request->get('json')) {
                return $return;
            }

            $categories = Category::where([
                    ['related_to', $model],
                    ['behavior_type', 'filter']
                ])
                ->with(['descendants' => function($query) {
                    $query->orderBy('id', 'asc');
                }])
                ->orderByDesc('is_primary')
                ->orderByDesc('id')
                ->get();

            return [
                'data'    => $return,
                'filters' => $categories
            ];
        }
    }
}
