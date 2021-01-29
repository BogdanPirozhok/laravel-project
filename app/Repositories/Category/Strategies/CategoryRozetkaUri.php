<?php


namespace App\Repositories\Category\Strategies;


use App\Repositories\Category\Interfaces\UriBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CategoryRozetkaUri implements UriBuilder
{
    public function handle(Model $context, string $model, string $params = null)
    {
        $params = $params ? explode(';', $params) : [];
        $uri = [];

        $assembledParams = $this->assembleParams($params);

        $categories = $this->getCategories($context, $assembledParams, $model);

        if(count($assembledParams) !== 0) {
            // grouping categories by parent slug
            $grouped = $categories->groupBy('parent.slug');

            // pushing compiled uri strings
            $grouped->each(function($items, $key) use (&$uri) {
                $uri[] = $key . '=' . $items->implode('slug', ',');
            });
        }

        $urlIsBroken = $this->checkIfUrlIsBroken($params, $uri);

        return $urlIsBroken ? $this->buildFixedUri($context, $uri) : [
            'appliedFilters' => $categories,
            'selectedFilters' => (count($assembledParams) !== 0) ? $categories : collect([]) ,
            'uri' => $this->glueUri($uri)
        ];
    }

    /**
     * Get related to category filters
     *
     * @param Model $context
     * @param Collection $assembledParams
     * @param string $model
     * @return mixed
     */
    public function getCategories(Model $context, Collection $assembledParams, string $model)
    {
        return $context->when(count($assembledParams) !== 0, function($query) use ($assembledParams){
            return $query->whereIn('slug', $assembledParams->flatten());
        })
            ->where('related_to', $model)
            ->whereBetween('_lft', [$context->_lft, $context->_rgt])
            ->where('behavior_type', 'parameter')
            ->with('parent')
            ->orderBy('id')->get();
    }

    /**
     * Parse uri string and assemble collection
     * @param array $params
     * @return \Illuminate\Support\Collection
     */
    public function assembleParams(array $params)
    {
        $assembledParams = collect([]);

        foreach ($params as $param) {
            $disassembled = explode('=', $param);

            if(count($disassembled) < 2) {
                continue;
            }
            $filters = explode(',', $disassembled[1]);

            $assembledParams[$disassembled[0]] = $filters;
            unset($disassembled);
        }

        return $assembledParams;
    }

    /**
     * Check if url is broken. And if so return correct redirect
     *
     * @param array $params
     * @param array $uri
     * @return false|\Illuminate\Http\RedirectResponse
     */
    public function checkIfUrlIsBroken(array $params, array $uri)
    {
        // check if filters sorted properly
        if(count(array_diff($params, $uri)) > 0) {
            return true;
        }

        // comparing filters sorting
        if($params !== $uri) {
            return true;
        }

        return false;
    }

    /**
     * Build correct uri
     *
     * @param Model $context
     * @param array $uri
     * @return \Illuminate\Http\RedirectResponse
     */
    public function buildFixedUri(Model $context, array $uri)
    {
        return redirect()->action(
            'CategoryController@rozetka', ['recipe_category' => $context->slug, 'params' => $this->glueUri($uri)]
        );
    }

    /**
     * Glue compiled uri
     *
     * @param array $uri
     * @return string
     */
    public function glueUri(array $uri)
    {
        return implode(';', $uri);
    }
}