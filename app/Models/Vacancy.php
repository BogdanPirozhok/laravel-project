<?php

namespace App\Models;

use App\Repositories\Sanitizers\VacancyRequestSanitizer;
use App\Traits\ScopeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Vacancy extends Model
{
    use ScopeTrait;

    protected $fillable = [
      'name', 'city', 'payment', 'employment_type', 'body', 'is_published'
    ];

    protected $casts = [
        'body' => 'array'
    ];

    /**
     * User for updating or creating new vacancy
     *
     * @param Request $request
     * @return mixed
     * @throws \App\Exceptions\CustomException
     * @throws \App\Repositories\BodyBuilder\Exceptions\BodyBuilderException
     */
    public static function saveOrCreate(Request $request)
    {
        $validated = VacancyRequestSanitizer::validateEditor($request);

        $vacancy = Vacancy::find($validated['id']);

        if (is_null($vacancy) && intval($request->get('id')) !== 0) {
            abort(404);
        }

        if(is_null($vacancy)) {
            $vacancy = Vacancy::create($validated['data']);
        } else {
            $vacancy->update($validated['data']);
        }

        return $vacancy;
    }


    /**
     * Job inquirers (applies to the job. fml)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inquirers()
    {
        return $this->hasMany(VacancyInquirer::class, 'vacancy_id', 'id');
    }
}
