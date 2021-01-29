<?php

namespace Tests\Feature;

use App\Http\Controllers\Admin\AdminProductPackageController;
use App\Http\Requests\ProductPackage\CreateProductPackage;
use App\Models\User;
use App\Repositories\Category\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminProductPackageControllerTest extends TestCase
{
    /**
     * Test if validator fails with bad params
     */
    public function testPackageCreationBadParameters()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->json('POST', '/admin/package',
            ['name' => 'Tested Package'] ,
            ['Accept' => 'application/json']);

        $this->assertEquals(422, $response->getStatusCode());
    }

    /**
     * Test if action create new instance
     *
     * @return false|string
     */
    public function testPackageCreationGoodParameters()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->json('POST', '/admin/package',
            ['name' => 'Tested Package', 'image_url' => 'https://www.google.com/image.png'] ,
            ['Accept' => 'application/json']);

        $responseData = json_decode($response->getContent());

        $this->assertEquals(201, $response->getStatusCode());

        return $responseData;
    }

    /**
     * @depends testPackageCreationGoodParameters
     * @param $data
     * @return false|string
     */
    public function testPackageUpdate($data)
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->json('PATCH', '/admin/package/' . $data->package->id,
            ['name' => 'Updated Package Name', 'image_url' => 'https://www.fake-news-dot-com.com/image.png'] ,
            ['Accept' => 'application/json']);

        $responseData = json_decode($response->getContent());

        $this->assertEquals('Updated Package Name', $responseData->package->name);
        $this->assertEquals('https://www.fake-news-dot-com.com/image.png', $responseData->package->image_url);
        $this->assertEquals(200, $response->getStatusCode());

        return $responseData;
    }

    /**
     * @depends testPackageUpdate
     * @param $data
     * @return \Illuminate\Testing\TestResponse
     */
    public function testPackagePublish($data)
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->json('PATCH', '/admin/package/' . $data->package->id . '/publish',
            ['is_published' => true],
            ['Accept' => 'application/json']);

        $responseData = json_decode($response->getContent());

        $this->assertEquals(true, $responseData->package->is_published);
        $this->assertEquals(200, $response->getStatusCode());

        return $responseData;
    }

    /**
     * @depends testPackagePublish
     * @param $data
     * @return \Illuminate\Testing\TestResponse
     */
    public function testPackageDeletion($data)
    {
        $user = User::find(1);

        $package = Category::package()->where('id', $data->package->id)->firstOrFail();

        $response = $this->actingAs($user)->json('DELETE', '/admin/package/' . $data->package->id,
            ['Accept' => 'application/json']);

        $responseData = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertDeleted($package);

        return $response;
    }

}
