<?php

namespace App\Http\Controllers\PublicSite;

use App\Http\Controllers\Controller;
use App\Http\Resources\PublicPostResource;
use App\Models\Post;
use App\Repositories\Category\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $page     = (int) $request->get('page') ?? 0;
        $perPage  = 5;
        $category = $request->route()->parameter('category') ?? 0;
        $where    = [
            ['cat.categorizable_type', Post::class],
            ['is_featured', false],
        ];

        if ( $category ) {
            $category = Category::where('slug', $category)->value('id');
        }

        if ($category) {
            $where[] = ['cat.category_id', $category];
        }

        $query_list = Post::join('categorizables as cat', 'cat.categorizable_id', 'posts.id')
            ->where($where)
            ->with('categories')
            ->select('posts.*')
            ->orderByDesc('id');

        $list = [
            'current_page' => $page,
            'per_page'     => $perPage,
            'total'        => $query_list->count(),
            'data'         => $query_list->skip($page * $perPage)->take($perPage)->get()
        ];

        $list['data'] = PublicPostResource::collection($list['data']);

        if ($request->get('json')) {
            return $list;
        }

        $featured      = Post::with('categories')->where('is_featured', true)->orderByDesc('id')->get();
        $query_filters = DB::table('categorizables')
            ->where('categorizable_type',Post::class)
            ->distinct('category_id')
            ->pluck('category_id');

        $response = [
            'featured'  => PublicPostResource::collection($featured),
            'list'      => $list,
            'base_path' => url('/news'),
            'filter'    => [
                'selected' => $category,
                'items'    => Category::whereIn('id', $query_filters)->get()
            ]
        ];

        return view('public.pages.news', compact('response'));
    }
}
