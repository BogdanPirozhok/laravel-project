<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vacancy;
use Tests\TestCase;

class AdminVacancyControllerTest extends TestCase
{

    public function testVacancyCreationBadParamsFailure()
    {
        $user = User::find(1);

        $fixture = [
            'name'            => '',
            'city'            => '',
            'payment'         => '1000 - 2000 usd',
            'employment_type' => 'Filltime',
            'body'            => [
                [
                    "caption" => "Requirements",
                    "type"    => "header"
                ],
                [
                    "caption" => "Age",
                    "value"   => "Unlimited",
                    "type"    => "column"
                ]
            ],
        ];

        $response = $this->actingAs($user)->json('POST', '/admin/vacancy/save',
            $fixture,
            ['Accept' => 'application/json']);


        $this->assertEquals(422, $response->getStatusCode());
    }


    public function testVacancyCreationGoodParamsFailure()
    {
        $user = User::find(1);

        $fixture = [
            'name'            => 'Really great vacancy',
            'city'            => 'Riverland',
            'payment'         => '1000 - 2000 usd',
            'employment_type' => 'Filltime',
            'body'            => [
                [
                    "caption" => "Requirements",
                    "type"    => "header"
                ],
                [
                    "caption" => "Age",
                    "value"   => "Unlimited",
                    "type"    => "column"
                ]
            ],
        ];

        $response = $this->actingAs($user)->json('POST', '/admin/vacancy/save',
            $fixture,
            ['Accept' => 'application/json']);

        $responseData = json_decode($response->getContent());


        $this->assertEquals(201, $response->getStatusCode());

        return $responseData;
    }


    /**
     * @depends testVacancyCreationGoodParamsFailure
     * @param $data
     * @return mixed
     */
    public function testVacancyUpdating($data)
    {
        $user = User::find(1);

        $fixture = [
            'id'              => $data->data->id,
            'name'            => 'Updated title',
            'city'            => 'Riverland',
            'payment'         => '1000 - 2000 usd',
            'employment_type' => 'Filltime',
            'body'            => [
                [
                    "caption" => "Requirements",
                    "type"    => "header"
                ],
                [
                    "caption" => "Age",
                    "value"   => "Unlimited",
                    "type"    => "column"
                ]
            ],
        ];

        $response = $this->actingAs($user)->json('POST', '/admin/vacancy/save',
            $fixture,
            ['Accept' => 'application/json']);

        $responseData = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Updated title', $responseData->data->name);

        return $responseData;
    }


    /**
     * @depends testVacancyUpdating
     * @param $data
     * @return mixed
     */
    public function testVacancyPublish($data)
    {
        $user = User::find(1);

        $fixture = [
            'is_published' => true,
        ];

        $response = $this->actingAs($user)->json('POST', '/admin/vacancy/' . $data->data->id,
            $fixture,
            ['Accept' => 'application/json']);

        $responseData = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(true, $responseData->success);
        $this->assertEquals(true, $responseData->vacancy->is_published);

        return $responseData;
    }


    /**
     * @depends testVacancyPublish
     */
    public function testVacancyDelete($data)
    {
        $user = User::find(1);

        $vacancy = Vacancy::find($data->vacancy->id);

        $fixture = [

        ];

        $response = $this->actingAs($user)->json('DELETE', '/admin/vacancy/' . $data->vacancy->id,
            $fixture,
            ['Accept' => 'application/json']);

        $responseData = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(true, $responseData->success);
        $this->assertDeleted($vacancy);

        return $responseData;
    }

}
