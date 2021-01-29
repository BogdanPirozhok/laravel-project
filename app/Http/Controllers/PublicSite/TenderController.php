<?php

namespace App\Http\Controllers\PublicSite;

use App\Helpers\LfmHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tender\GetPublicTenderList;
use App\Http\Requests\TenderRequest\StoreTenderRequest;
use App\Http\Resources\PublicTenderListResource;
use App\Models\Tender;
use App\Models\TenderRequest;

class TenderController extends Controller
{
    use LfmHelper;

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('public.pages.purchases.index');
    }

    /**
     * @param GetPublicTenderList $request
     * @return mixed
     */
    public function ajax(GetPublicTenderList $request)
    {
        switch ($request->get('type')) {
            case 'tender':
                return PublicTenderListResource::collection(Tender::tender()->published()->orderBy('id', 'desc')->paginate(5)->appends($request->validated()));
                break;

            case 'purchase':
                return PublicTenderListResource::collection(Tender::purchase()->published()->orderBy('id', 'desc')->paginate(5)->appends($request->validated()));
                break;

            default:
                return 'this cant be happening';
                break;
        }
    }

    public function storeTenderRequest(StoreTenderRequest $request)
    {
        if ($request->has('file')) {
            $file =
                $this->handleFile(
                    new TenderRequest,
                    $request->file('file'),
                    '/shares/tender-request',
                    [
                        'file_path' => 'file_path',
                        'file_name' => 'file_name'
                    ]
                );
        }

        $additionalArray = [
            'file_path' => $file['filePath'] ??  null,
            'file_name' => $file['fileName'] ?? null,
        ];


        $tenderRequest = TenderRequest::create(
            array_merge($request->validated(),$additionalArray)
        );


        return response([
            'success' => true,
            'message' => __('tender.request.created'),
        ]);

    }
}
