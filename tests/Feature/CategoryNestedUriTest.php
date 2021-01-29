<?php

namespace Tests\Feature;

use App\Repositories\Category\Strategies\CategoryNestedUri;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Tests\TestCase;

//use PHPUnit\Framework\TestCase;

class CategoryNestedUriTest extends TestCase
{
    public function testEmptyParams()
    {
        $params = [];
        $stack = (new CategoryNestedUri())->assembleParams($params);
        $this->assertEmpty($stack);
        return [
            [$params, $this->implodedParams($stack), '']
        ];
    }

    public function testFullParams()
    {
        $params = [
            "syre_ikra_midii",
            "osobennosti_k-pivu",
        ];
        $expected = collect([
            "syre" => [
                "ikra",
                "midii"
            ],
            "osobennosti" => [
                "k-pivu"
            ]
        ]);
        $stack = (new CategoryNestedUri())->assembleParams($params);
        $this->assertEquals($expected, $stack);

        return [
            [$params,  $this->implodedParams($stack), 'syre_ikra_midii/osobennosti_k-pivu', true]
        ];

    }

    /**
     * @dataProvider testFullParams
     * @dataProvider testEmptyParams
     */
    public function testUrlIsNotBroken($params, $uri)
    {
        $stack = (new CategoryNestedUri())->checkIfUrlIsBroken($params, $uri);
        $this->assertFalse($stack);
    }

    /**
     * @dataProvider testFullParams
     * @dataProvider testEmptyParams
     */
    public function testGlueUri($params, $uri, $expected)
    {
        $stack = (new CategoryNestedUri())->glueUri($uri);
        $this->assertEquals($expected, $stack);
    }

    /**
     * @dataProvider testFullParams
     * @dataProvider testEmptyParams
     */
    public function testBuildFixedUri($parms, $uri, $slug)
    {
        $model = new class extends Model {};
        $model->slug = 'sluggish';

        $stack = (new CategoryNestedUri())->buildFixedUri($model, $uri);
        $this->assertInstanceOf(RedirectResponse::class, $stack);
    }


    private function implodedParams($params)
    {
        $uri = [];
        foreach ($params as $key => $param) {
            $uri[] = $key . '_' . implode('_', $param);
        }
        return $uri;
    }

}
