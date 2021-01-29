<?php

namespace App\Http\Controllers\PublicSite;

use App\Http\Controllers\Controller;
use App\Http\Requests\Point\GetPoints;
use App\Http\Resources\MapPointSearchResource;
use App\Http\Resources\MapPointResource;
use App\Http\Resources\MapPointViewResource;
use App\Models\Point;
use App\Models\StoreNetwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MapController extends Controller
{
    public function index() {
        $response = [
            'data' => StoreNetwork::orderBy('id', 'desc')->get()
        ];

        return view('public.pages.networks', compact('response'));
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function search(Request $request)
    {
        $points =  DB::table('points')
            ->select(
                DB::raw(
                    'points.id, points.type, points.longitude, points.latitude, points.store_uid, points.address'
                )
            )
            ->when($request->has('address'), function($query) use ($request) {
                return $query->where('address', 'ilike', '%' . $request->get('address') . '%');
            })
            ->take(5000)
            ->get();

        return MapPointSearchResource::collection($points);
    }

    /**
     * @param GetPoints $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function points(GetPoints $request)
    {
        $points =  DB::table('points')
            ->select(
                DB::raw(
                    'points.id, points.type, points.longitude, points.latitude, points.store_uid,
                    store_networks.store_uid, store_networks.name, store_networks.mark_image_path'
                )
            )
            ->when($request->has('type') && !is_null($request->get('type')), function($query) use ($request) {
                return $query->where('type', $request->get('type'));
            })
            ->when($request->has('store_uid') && !is_null($request->get('store_uid')), function($query) use ($request) {
                return $query->where('points.store_uid', $request->get('store_uid'));
            })
            ->when($request->has('address'), function($query) use ($request) {
                return $query->where('address', 'ilike', '%' . $request->get('address') . '%');
            })
            ->leftJoin('store_networks', 'points.store_uid', '=', 'store_networks.store_uid')
            ->take(5000)
            ->get();

        return MapPointResource::collection($points);
    }

    /**
     * @param Point $point
     * @return MapPointViewResource
     */
    public function viewPoint(Point $point)
    {
        return MapPointViewResource::make($point);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function networks()
    {
        return DB::table('store_networks')
            ->selectRaw('store_networks.id, store_networks.name, store_networks.store_uid,
                store_networks.external_url, store_networks.mark_image_path as icon,
                COUNT(points.id) as points_count')
            ->leftJoin('points', 'store_networks.store_uid', 'points.store_uid')
            ->groupBy('store_networks.id')
            ->get();
    }
}
