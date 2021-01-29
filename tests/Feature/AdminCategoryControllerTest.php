<?php

namespace Tests\Feature;

use App\Models\User;
use App\Repositories\Category\Models\Category;
use Tests\TestCase;

class AdminCategoryControllerTest extends TestCase
{

    /**
     *
     */
    public function testCategoryCreationZeroDataFail()
    {
        $user = User::find(1);

        $fixture = [];

        $response = $this->actingAs($user)->json('POST', '/admin/category',
            $fixture,
            ['Accept' => 'application/json']);

        $this->assertEquals(422, $response->getStatusCode());
    }


    /**
     *
     */
    public function testCategoryCreationWrongBehaviorTypeFail()
    {
        $user = User::find(1);

        $fixture = [
            'name'          => 'Bad Behavior',
            'models'        => 'product',
            'behavior_type' => 'filter'
        ];

        $response = $this->actingAs($user)->json('POST', '/admin/category',
            $fixture,
            ['Accept' => 'application/json']);

        $this->assertEquals(422, $response->getStatusCode());
    }

    /**
     * @return mixed
     */
    public function testCategoryCreationSuccess()
    {
        $user = User::find(1);

        $fixture = [
            'name'          => 'Good category',
            'models'        => 'product',
            'behavior_type' => 'category',
        ];

        $response = $this->actingAs($user)->json('POST', '/admin/category',
            $fixture,
            ['Accept' => 'application/json']);

        $responseData = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('category', $responseData->category->behavior_type);
        $this->assertTrue($responseData->success);

        return $responseData;
    }

    /**
     * @depends testCategoryCreationSuccess
     * @param $data
     * @return mixed
     */
    public function testFilterCreationSuccess($data)
    {
        $user = User::find(1);

        $fixture = [
            'name'          => 'Good filter',
            'models'        => 'product',
            'behavior_type' => 'filter',
            'parent_id'     => $data->category->id
        ];

        $response = $this->actingAs($user)->json('POST', '/admin/category',
            $fixture,
            ['Accept' => 'application/json']);

        $responseData = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('filter', $responseData->category->behavior_type);
        $this->assertTrue($responseData->success);

        return $responseData;
    }

    /**
     * @depends testFilterCreationSuccess
     * @param $data
     * @return mixed
     */
    public function testParameterCreationSuccess($data)
    {
        $user = User::find(1);

        $fixture = [
            'name'          => 'Good parameter',
            'models'        => 'product',
            'behavior_type' => 'parameter',
            'parent_id'     => $data->category->id
        ];

        $response = $this->actingAs($user)->json('POST', '/admin/category',
            $fixture,
            ['Accept' => 'application/json']);

        $responseData = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('parameter', $responseData->category->behavior_type);
        $this->assertTrue($responseData->success);

        return $responseData;
    }

    /**
     * @depends testCategoryCreationSuccess
     * @param $data
     * @return mixed
     */
    public function testParameterCreationForCategoryFail($data)
    {
        $user = User::find(1);

        $fixture = [
            'name'          => 'Good parameter',
            'models'        => 'product',
            'behavior_type' => 'parameter',
            'parent_id'     => $data->category->id
        ];

        $response = $this->actingAs($user)->json('POST', '/admin/category',
            $fixture,
            ['Accept' => 'application/json']);

        $responseData = json_decode($response->getContent());

        $this->assertEquals(422, $response->getStatusCode());

        return $responseData;
    }

    /**
     * @depends testCategoryCreationSuccess
     * @param $data
     * @return mixed
     */
    public function testSetCategoryIsPrimaryFail($data)
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->json('POST', '/admin/category/' . $data->category->id,
            [],
            ['Accept' => 'application/json']);

        $responseData = json_decode($response->getContent());

        $this->assertEquals(422, $response->getStatusCode());

        return $responseData;
    }

    /**
     * @depends testParameterCreationSuccess
     * @param $data
     * @return mixed
     */
    public function testSetParameterIsPrimaryFail($data)
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->json('POST', '/admin/category/' . $data->category->id,
            [],
            ['Accept' => 'application/json']);

        $responseData = json_decode($response->getContent());

        $this->assertEquals(422, $response->getStatusCode());

        return $responseData;
    }

    /**
     * @depends testFilterCreationSuccess
     * @param $data
     * @return mixed
     */
    public function testSetFilterIsPrimarySuccess($data)
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->json('POST', '/admin/category/' . $data->category->id,
            [],
            ['Accept' => 'application/json']);

        $responseData = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());

        return $responseData;
    }


    /**
     * @depends testCategoryCreationSuccess
     * @return mixed
     */
    public function testFilterCreationWithIsPrimary($data)
    {
        $user = User::find(1);

        $fixture = [
            'name'          => 'Good filter with primary',
            'models'        => 'product',
            'behavior_type' => 'filter',
            'is_primary'    => true,
            'parent_id'     => $data->category->id
        ];

        $response = $this->actingAs($user)->json('POST', '/admin/category',
            $fixture,
            ['Accept' => 'application/json']);

        $responseData = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($responseData->category->is_primary);
        $this->assertTrue($responseData->success);

        $primaries = Category::where('behavior_type', 'filter')
            ->where('parent_id', $data->category->id)
            ->where('is_primary', true)
            ->whereNotIn('id', [$responseData->category->id])
            ->count();

        $this->assertSame(0, $primaries);

        $category = Category::find($responseData->category->id);

        $this->assertTrue($category->is_primary);

        return $responseData;
    }
}
