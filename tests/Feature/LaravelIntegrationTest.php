<?php

namespace BcConsulting\TuningApiClient\Tests\Feature;

use BcConsulting\TuningApiClient\Tests\TestCase;
use TuningApiClient;

use Facades\BcConsulting\TuningApiClient\Tests\ModelFactories\VehicleFactory;
use BcConsulting\TuningApiClient\Models\Vehicle;

class LaravelIntegrationTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

    }

    /**
     * @test
     */
    public function calling_vehicles_in_laravel_succeeds()
    {
        $vehicle = VehicleFactory::make();
        $this->withResponse([$vehicle]);

        $vehicles = TuningApiClient::vehicles();

        $this->guzzle->assertGet('/api/vehicles');
        $this->assertArrayHasBaseModel($vehicles, Vehicle::class, $vehicle);
    }

}
