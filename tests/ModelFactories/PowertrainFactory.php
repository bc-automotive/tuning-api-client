<?php

namespace BcConsulting\TuningApiClient\Tests\ModelFactories;

use BcConsulting\TuningApiClient\Models\Powertrain;

class PowertrainFactory extends BaseFactory
{
    protected $endpoint = '/api/vehicles/0/brands/0/models/0/years/0/powertrains';
    protected $class = Powertrain::class;

    public function __construct()
    {
        parent::__construct();
    }

    public function data(): array
    {
        return [
            'id' => $this->faker->randomDigit,
            'name' => $this->faker->word,
            'flag' => $this->faker->randomElement(['new', 'development', null]),
        ];
    }

}
