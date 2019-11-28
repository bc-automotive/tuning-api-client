<?php

namespace BcConsulting\TuningApiClient\Tests\ModelFactories;

use BcConsulting\TuningApiClient\Models\Model;

class ModelFactory extends BaseFactory
{

    protected $endpoint = '/api/vehicles/0/brands/0/models';
    protected $class = Model::class;

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
