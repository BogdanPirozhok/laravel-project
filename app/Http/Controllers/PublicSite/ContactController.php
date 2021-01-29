<?php

namespace App\Http\Controllers\PublicSite;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest\ContactForm;
use App\Models\ContactRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('public.pages.contacts');
    }

    /**
     * @param ContactForm $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function form(ContactForm $request)
    {

        ContactRequest::create($request->validated());

        return response([
            'success' => true,
            'message' => __('contact-request.created')
        ]);
    }
}
