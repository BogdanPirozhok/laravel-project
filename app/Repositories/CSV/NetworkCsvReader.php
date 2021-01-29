<?php


namespace App\Repositories\CSV;


use App\Models\Point;
use Illuminate\Support\Facades\DB;

class NetworkCsvReader extends AbstractCsvReader
{

    public function work()
    {
        $indexes = $this->findColumns();
        $countBefore = 0;
        $points = [];
        $skipped = 0;
        $success = false;
        $uids = DB::table('store_networks')->select('id', 'title', 'store_uid')->get();

        foreach ($this->reader as $row) {
            $validated = [];
            foreach ($indexes as $column => $data) {
                $validated[$data['callback']['db_column']] =
                    $data['callback']['callback']($row[$column], $uids);
            }
            // check if some value dont validated
            if (in_array(false, $validated)) {
                $skipped++;
            } else {
                array_push($points, array_merge(['type' => Point::NETWORK], $validated));
            }
        }

        DB::transaction(function () use ($points, &$success, &$countBefore) {
            $countBefore = DB::table('points')->where('type', Point::NETWORK)->delete();
            $success = DB::table('points')->insert($points);
        });

        $countAfter = DB::table('points')->where('type', Point::NETWORK)->count();

        return [
            'success'     => $success,
            'countBefore' => $countBefore,
            'countAfter'  => $countAfter,
            'skipped'    => $skipped
        ];


    }

    public function getDefaultColumns(): array
    {
        return [
            'store_uid' => [
                'db_column' => 'store_uid',
                'callback'  => function ($data, $uids) {
                    return $uids->contains('store_uid', $data) ? $data : false;
                }
            ],
            'address'   => [
                'db_column' => 'address',
                'callback'  => function ($data) {
                    return $data;
                }
            ],
            'longitude' => [
                'db_column' => 'longitude',
                'callback'  => function ($data) {
                    return strlen($data) > 0 ? $data : false;
                }
            ],
            'latitude'  => [
                'db_column' => 'latitude',
                'callback'  => function ($data) {
                    return strlen($data) > 0 ? $data : false;
                }
            ],
            'name'      => [
                'db_column' => 'name',
                'callback'  => function ($data) {
                    return $data;
                }
            ],
            'info'      => [
                'db_column' => 'info',
                'callback'  => function ($data) {
                    return $data;
                }
            ],
        ];
    }
}
