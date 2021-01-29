<?php


namespace App\Repositories\Sanitizers;


use App\Exceptions\CustomException;
use App\Repositories\BodyBuilder\VacancyBody;
use Illuminate\Http\Request;

class VacancyRequestSanitizer
{
    /**
     * @param Request $request
     * @return mixed
     * @throws CustomException
     * @throws \App\Repositories\BodyBuilder\Exceptions\BodyBuilderException
     */
    public static function validateEditor(Request $request)
    {
        $content['id'] = $request->get('id');
        $content['data'] = $request->validated();
        unset($content['data']['id']);

        // inputs which will be validated separately
        $accepted = [
            'id', 'is_published',
        ];

        // getting array key => rules of sanitized inputs
        $rule_keys = $request->rules();
        $accepted_keys = array_flip($accepted);
        $sanitized = array_diff_key($rule_keys, $accepted_keys);
        foreach ($sanitized as $key => &$rule) {
            $rule = $request->get($key);
        }

        // checking if sanitized inputs are not fully null
        $isSanitizedContainsOnlyNull = (empty(array_filter($sanitized, function ($a) {
            return $a !== null;
        })));

        // checking if sanitized and editor body blocks is not empty
        if ($isSanitizedContainsOnlyNull
            && empty($content['data'])) {
            throw new CustomException('Content cannot be empty', 400);
        }

        // validate and sanitize body blocks
        $builder = new VacancyBody($content['data']['body']);

        $content['data']['body'] = $builder->instance->sanitize()->getBlocks();

        return $content;
    }

}
