<?php

// i cant use Public as part of namespace. Its reserved by php. Sad!
namespace App\Http\Controllers\PublicSite;

use App\Helpers\LfmHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vacancy\VacancyInquiry;
use App\Http\Resources\PublicVacancyList;
use App\Models\Vacancy;
use App\Models\VacancyInquirer;
use App\Repositories\BodyBuilder\VacancyBody;

class VacancyController extends Controller
{
    use LfmHelper;

    public function index()
    {
        return view('public.pages.work.index');
    }

    public function vacancyList()
    {
        $vacancies = Vacancy::published()->orderBy('id', 'desc')->get();

        return PublicVacancyList::collection($vacancies);
    }

    /**
     * @param Vacancy $vacancy
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \App\Repositories\BodyBuilder\Exceptions\BodyBuilderException
     */
    public function show(Vacancy $vacancy)
    {
        $body = new VacancyBody($vacancy->body);
        $data = $vacancy;
        unset($data['body']);
        return view('public.pages.work.vacancy', [
            'html' => $body->instance->render(),
            'data' => $data,
        ]);
    }


    public function inquiry(VacancyInquiry $request)
    {
        if ($request->has('resume')) {
            $file = $request->file('resume');
            $workDir = '/shares/rezume';

            $lfm = $this->lfm;

            $disc = config('lfm.disk');
            $fs = config('filesystems.disks.' . $disc);

            $lfm->dir($workDir);

            $newFileName = $lfm->upload($file);

            $filePath = $fs['url'] . 'files' . $workDir . '/' . $newFileName;
        }

        $validated = $request->validated();
        unset($validated['resume']);

        $inquiry = VacancyInquirer::create(array_merge($validated, ['resume_file_path' => $filePath ?? null, 'resume_file_name' => $newFileName ?? null]));

        return response([
            'success' => true,
            'message' => __('vacancy.inquiry.applied')
        ]);
    }
}
