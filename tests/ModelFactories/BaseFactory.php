<?php

namespace BcConsulting\TuningApiClient\Tests\ModelFactories;

use Faker\Factory;
use BcConsulting\TuningApiClient\Factories\ModelFactory;
use BcConsulting\TuningApiClient\Models\Vehicle;

abstract class BaseFactory
{
    protected $faker;
    
    protected $endpoint;
    protected $class;

    protected function __construct()
    {
        $this->faker = Factory::create();
    }

    abstract protected function data(): array;

    public function make($overrides = [])
    {
        $data = array_merge($this->data(), $overrides);
        return ModelFactory::for($this->endpoint, $this->class)->make($data);
    }
}
