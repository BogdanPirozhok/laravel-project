<?php

namespace App\Http\Controllers\PublicSite;

use App\Http\Controllers\Controller;
use App\Http\Requests\CatalogRequest\StoreCatalogRequest;
use App\Http\Requests\TenderRequest\StoreTenderRequest;
use App\Models\CatalogRequest;
use App\Models\TenderRequest;
use Illuminate\Http\Request;

class PartnershipController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('public.pages.partnership.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function form()
    {
        return view('public.pages.partnership.partnership-form');
    }

    public function storeTenderRequest(StoreCatalogRequest $request)
    {
        $tenderRequest = CatalogRequest::create($request->validated());

        return response([
           'success' => true,
           'message' => __('catalog.created'),
        ]);
    }
}
