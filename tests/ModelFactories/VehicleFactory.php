<?php

namespace BcConsulting\TuningApiClient\Tests\ModelFactories;

use BcConsulting\TuningApiClient\Models\Vehicle;

class VehicleFactory extends BaseFactory
{
    protected $endpoint = '/api/vehicles';
    protected $class = Vehicle::class;

    public function __construct()
    {
        parent::__construct();
    }

    public function data(): array
    {
        return [
            'id' => $this->faker->randomDigit,
            'name' => $this->faker->word,
        ];
    }

}
