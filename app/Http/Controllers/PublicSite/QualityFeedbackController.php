<?php

namespace App\Http\Controllers\PublicSite;

use App\Helpers\LfmHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\QualityFeedback\StoreReview;
use App\Models\QualityFeedback;

class QualityFeedbackController extends Controller
{
    use LfmHelper;

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('public.pages.quality');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function feedback()
    {
        return view('public.pages.quality-form');
    }

    /**
     * @param StoreReview $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(StoreReview $request)
    {
        if ($request->has('barcode_file')) {
            $file = $request->file('barcode_file');
            $lfm = $this->lfm;
            $workDir = '/shares/quality/barcode';
            $lfm->dir($workDir);
            $disc = config('lfm.disk');
            $fs = config('filesystems.disks.' . $disc);

            $fileName = $lfm->upload($file);
            $filePath = $fs['url'] . 'files' . $workDir . '/' . $fileName;
        }

        $array = [
            'barcode_file_name' => $fileName ?? null,
            'barcode_file_path' => $filePath ?? null,
        ];

        $review = QualityFeedback::create(array_merge($request->validated(), $array));

        return response([
            'success' => true,
            'message' => __('quality.review.stored'),
        ]);
    }
}
