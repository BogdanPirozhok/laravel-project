<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class AdminProductControllerTest extends TestCase
{

    /**
     * Testing if product creation fails with short name parameter
     */
    public function testProductCreationShortNameFailure()
    {
        $user = User::find(1);

        $fixture = [
            'name'             => '',
            'categories'       => [1, 2, 3, 4, 5, 6, 7, 8, 9],
            'tags'             => [1, 2, 3, 99, 14, 21,],
            'similar_products' => [1, 2, 3,],
            'similar_recipes'  => [1],
        ];


        $response = $this->actingAs($user)->json('POST', '/admin/products/save',
            $fixture,
            ['Accept' => 'application/json']);

        $this->assertEquals(422, $response->getStatusCode());
    }

    /**
     * Testing if product creation fails with long name parameter
     */
    public function testProductCreationLongNameFailure()
    {
        $user = User::find(1);

        $fixture = [
            'name'             => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc eget finibus sapien. Suspendisse porta turpis lacus, id vehicula elit rutrum vel. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc eget finibus sapien. Suspendisse porta turpis lacus, id vehicula elit rutrum vel.',
            'categories'       => [1, 2, 3, 4, 5, 6, 7, 8, 9],
            'tags'             => [1, 2, 3, 99, 14, 21,],
            'similar_products' => [1, 2, 3,],
            'similar_recipes'  => [1],
        ];


        $response = $this->actingAs($user)->json('POST', '/admin/products/save',
            $fixture,
            ['Accept' => 'application/json']);

        $this->assertEquals(422, $response->getStatusCode());
    }


    /**
     * Testing if product creation completes successfully
     */
    public function testProductCreationGoodParams()
    {
        $user = User::find(1);

        $fixture = [
            'name'             => 'Lorem ipsum dolor sit amet',
            'categories'       => [1, 2, 3, 4, 5, 6, 7, 8, 9],
            'tags'             => [1, 2, 3, 99, 14, 21,],
            'similar_products' => [1, 2, 3,],
            'similar_recipes'  => [1],
            'specs'            => [
                [
                    'type'    => 'column',
                    'caption' => 'great caption',
                    'value'   => 'cool value'
                ],
            ]
        ];


        $response = $this->actingAs($user)->json('POST', '/admin/products/save',
            $fixture,
            ['Accept' => 'application/json']);

        $responseData = json_decode($response->getContent());

        $this->assertEquals(201, $response->getStatusCode());

        return $responseData;
    }

    /**
     * @depends testProductCreationGoodParams
     * @param $data
     * @return mixed
     */
    public function testProductUpdate($data)
    {

        $user = User::find(1);

        $fixture = [
            'id'    => $data->data->id,
            'name'  => 'Changed product name',
            'specs' => [
                [
                    'type'    => 'column',
                    'caption' => 'great caption',
                    'value'   => 'cool value'
                ],
            ]
        ];

        $response = $this->actingAs($user)->json('POST', '/admin/products/save',
            $fixture,
            ['Accept' => 'application/json']);

        $responseData = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Changed product name', $responseData->data->name);

        return $responseData;
    }

    /**
     * @depends testProductUpdate
     * @param $data
     */
    public function testProductPublish($data)
    {
        $user = User::find(1);

        $fixture = [
            'is_published' => true,
        ];

        $response = $this->actingAs($user)->json('PUT', '/admin/products/' . $data->data->id,
            $fixture,
            ['Accept' => 'application/json']);

        $responseData = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(true, $responseData->success);
        $this->assertEquals(true, $responseData->product->is_published);

        return $responseData;
    }

    /**
     * @depends testProductPublish
     * @param $data
     * @return mixed
     */
    public function testProductDeletion($data)
    {
        $user = User::find(1);

        $product = Product::find($data->product->id);

        $fixture = [
            'is_published' => true,
        ];

        $response = $this->actingAs($user)->json('DELETE', '/admin/products/' . $data->product->id,
            $fixture,
            ['Accept' => 'application/json']);

        $responseData = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(true, $responseData->success);
        $this->assertDeleted($product);

        return $responseData;
    }

    public function testProductCategorySync()
    {
        $user = User::find(1);

        $attachable = ((new Product)->getAttachableCategories([], true))->slice(0, 2);

        $fixture = [
            'name'       => 'Lorem ipsum dolor sit amet',
            'categories' => $attachable,
            'specs'      => [
                [
                    'type'    => 'column',
                    'caption' => 'great caption',
                    'value'   => 'cool value'
                ],
            ]
        ];


        $response = $this->actingAs($user)->json('POST', '/admin/products/save',
            $fixture,
            ['Accept' => 'application/json']);

        $responseData = json_decode($response->getContent());

        $this->assertEquals(201, $response->getStatusCode());


        $product = Product::find($responseData->data->id);

        $categories = $product->categories()->pluck('id');

        $diffLeft = $categories->diff($attachable);
        $diffRight = $attachable->diff($categories);

        $this->assertEquals(0, $diffLeft->count());
        $this->assertEquals(0, $diffRight->count());

        return $responseData;
    }

    /**
     * @depends testProductCategorySync
     * @param $data
     */
    public function testProductCategoryUnsync($data)
    {
        $user = User::find(1);

        $attachable = collect([]);


        $fixture = [
            'id'         => $data->data->id,
            'name'       => 'Lorem ipsum dolor sit amet',
            'categories' => $attachable,
            'specs'      => [
                [
                    'type'    => 'column',
                    'caption' => 'great caption',
                    'value'   => 'cool value'
                ],
            ]
        ];

        $response = $this->actingAs($user)->json('POST', '/admin/products/save',
            $fixture,
            ['Accept' => 'application/json']);


        $responseData = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());


        $product = Product::find($responseData->data->id);

        $categories = $product->categories()->pluck('id');

        $diffLeft = $categories->diff($attachable);
        $diffRight = $attachable->diff($categories);

        $this->assertEquals(0, $diffLeft->count());
        $this->assertEquals(0, $diffRight->count());

        $product->delete();
    }
}
