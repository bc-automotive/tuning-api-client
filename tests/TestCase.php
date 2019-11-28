<?php

namespace BcConsulting\TuningApiClient\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

use BcConsulting\TuningApiClient\TuningApiClient;
use BcConsulting\TuningApiClient\Models\BaseModel;

abstract class TestCase extends BaseTestCase
{

    use WithFaker;

    protected $guzzle;

	/**
	 * Setup the test environment.
	 */
	protected function setUp(): void
	{
	    parent::setUp();
	    
        $this->guzzle = (new Guzzle())->fake();

        TuningApiClient::config([
            'api_token' => $this->faker->uuid,
            'api_url' => $this->faker->url,
        ], $this->guzzle->client);
	}

    protected function getPackageProviders($app)
    {
        return [
            'BcConsulting\TuningApiClient\TuningApiClientServiceProvider',
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'TuningApiClient' => 'BcConsulting\TuningApiClient\Facades\TuningApiClient',
        ];
    }

	protected function withResponse($response)
	{
        $body = null;
        if ($response instanceof BaseModel) {
            $body = $response->toArray();
        } elseif (is_array($response)) {
            $body = array_map(function(BaseModel $baseModel) {
                return $baseModel->toArray();
            }, $response);
        }
		$this->guzzle->withResponse(200, [], $body);
		return $this;
	}

    protected function withExceptionResponse($exception)
    {
        $this->guzzle->withResponse($exception->statuscode, [], [
            'code' => $exception->code,
            'message' => $exception->message,
            'data' => $exception->data
        ]);
        return $this;
    }

    protected function assertArrayHasBaseModel($array, $class, $baseModel)
    {
        $this->assertIsArray($array);
        $this->assertInstanceOf($class, $array[0]);
        $this->assertInstanceOf($class, $baseModel);
        $this->assertEquals($array[0]->toArray(), $baseModel->toArray());
    }
}
