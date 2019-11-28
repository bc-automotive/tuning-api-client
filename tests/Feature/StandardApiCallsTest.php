<?php

namespace BcConsulting\TuningApiClient\Tests\Feature;

use BcConsulting\TuningApiClient\Tests\TestCase;
use BcConsulting\TuningApiClient\TuningApiClient;

use Facades\BcConsulting\TuningApiClient\Tests\ModelFactories\VehicleFactory;
use Facades\BcConsulting\TuningApiClient\Tests\ModelFactories\BrandFactory;
use Facades\BcConsulting\TuningApiClient\Tests\ModelFactories\ModelFactory;
use Facades\BcConsulting\TuningApiClient\Tests\ModelFactories\YearFactory;
use Facades\BcConsulting\TuningApiClient\Tests\ModelFactories\PowertrainFactory;
use BcConsulting\TuningApiClient\Models\Vehicle;
use BcConsulting\TuningApiClient\Models\Brand;
use BcConsulting\TuningApiClient\Models\Model;
use BcConsulting\TuningApiClient\Models\Year;
use BcConsulting\TuningApiClient\Models\Powertrain;

class StandardApiCallsTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

    }

    /**
     * @test
     */
    public function calling_vehicles_succeeds()
    {
        $vehicle = VehicleFactory::make();
        $this->withResponse([$vehicle]);

        $vehicles = TuningApiClient::vehicles();

        $this->guzzle->assertGet('/api/vehicles');
        $this->assertArrayHasBaseModel($vehicles, Vehicle::class, $vehicle);
    }

    /**
     * @test
     */
    public function calling_vehicle_succeeds()
    {
        $vehicle = VehicleFactory::make();
        $this->withResponse($vehicle);

        $v = TuningApiClient::vehicles($vehicle->id);

        $this->guzzle->assertGet('/api/vehicles/'.$vehicle->id);
        $this->assertInstanceOf(Vehicle::class, $v);
        $this->assertEquals($vehicle->toArray(), $v->toArray());
    }

    /**
     * @test
     */
    public function calling_brands_succeeds()
    {
        $vehicle = VehicleFactory::make();
        $brand = BrandFactory::make();
        $this->withResponse([$brand]);

        $brands = $vehicle->brands();

        $this->guzzle->assertGet('/api/vehicles/'.$vehicle->id.'/brands');
        $this->assertArrayHasBaseModel($brands, Brand::class, $brand);
    }

    /**
     * @test
     */
    public function calling_brand_succeeds()
    {
        $vehicle = VehicleFactory::make();
        $brand = BrandFactory::make();
        $this->withResponse($brand);

        $b = $vehicle->brands($brand->id);

        $this->guzzle->assertGet('/api/vehicles/'.$vehicle->id.'/brands/'.$brand->id);
        $this->assertInstanceOf(Brand::class, $b);
        $this->assertEquals($brand->toArray(), $b->toArray());
    }

    /**
     * @test
     */
    public function calling_models_succeeds()
    {
        $brand = BrandFactory::make();
        $model = ModelFactory::make();
        $this->withResponse([$model]);

        $models = $brand->models();

        $this->guzzle->assertGet('/api/vehicles/0/brands/'.$brand->id.'/models');
        $this->assertArrayHasBaseModel($models, Model::class, $model);
    }

    /**
     * @test
     */
    public function calling_model_succeeds()
    {
        $brand = BrandFactory::make();
        $model = ModelFactory::make();
        $this->withResponse($model);

        $m = $brand->models($model->id);

        $this->guzzle->assertGet('/api/vehicles/0/brands/'.$brand->id.'/models/'.$model->id);
        $this->assertInstanceOf(Model::class, $m);
        $this->assertEquals($model->toArray(), $m->toArray());
    }

    /**
     * @test
     */
    public function calling_years_succeeds()
    {
        $model = ModelFactory::make();
        $year = YearFactory::make();
        $this->withResponse([$year]);

        $years = $model->years();

        $this->guzzle->assertGet('/api/vehicles/0/brands/0/models/'.$model->id.'/years');
        $this->assertArrayHasBaseModel($years, Year::class, $year);
    }

    /**
     * @test
     */
    public function calling_year_succeeds()
    {
        $model = ModelFactory::make();
        $year = YearFactory::make();
        $this->withResponse($year);

        $y = $model->years($year->id);

        $this->guzzle->assertGet('/api/vehicles/0/brands/0/models/'.$model->id.'/years/'.$year->id);
        $this->assertInstanceOf(Year::class, $y);
        $this->assertEquals($year->toArray(), $y->toArray());
    }

    /**
     * @test
     */
    public function calling_powertrains_succeeds()
    {
        $year = YearFactory::make();
        $powertrain = PowertrainFactory::make();
        $this->withResponse([$powertrain]);

        $powertrains = $year->powertrains();

        $this->guzzle->assertGet('/api/vehicles/0/brands/0/models/0/years/'.$year->id.'/powertrains');
        $this->assertArrayHasBaseModel($powertrains, Powertrain::class, $powertrain);
    }

    /**
     * @test
     */
    public function calling_powertrain_succeeds()
    {
        $year = YearFactory::make();
        $powertrain = PowertrainFactory::make();
        $this->withResponse($powertrain);

        $p = $year->powertrains($powertrain->id);

        $this->guzzle->assertGet('/api/vehicles/0/brands/0/models/0/years/'.$year->id.'/powertrains/'.$powertrain->id);
        $this->assertInstanceOf(Powertrain::class, $p);
        $this->assertEquals($powertrain->toArray(), $p->toArray());
    }

}
