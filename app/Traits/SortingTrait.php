<?php


namespace App\Traits;


use Illuminate\Support\Facades\Session;

trait SortingTrait
{
    /**
     * @param $query
     * @param $request
     * @param array $jsonColumn
     * @return mixed
     */
    public function sortByLawAndOrder($query, $request, $jsonColumn = [])
    {
        $sortBy = in_array($request->get('sort_by'), $jsonColumn)
            ? $request->get('sort_by') . '->' . Session::get('locale')
            : $request->get('sort_by');
        return $query->orderBy($sortBy, $request->get('order_by', 'ASC'));
    }

}
