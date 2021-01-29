<?php

namespace App\Http\Controllers\PublicSite;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{

    /**
     * @param $page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($page)
    {
        $this->authorize('view', $page);

        if(view()->exists($page->template->path)) {
            return view($page->template->path, $page->combineVariables());
        } else {
            abort(404);
        }
    }
}
