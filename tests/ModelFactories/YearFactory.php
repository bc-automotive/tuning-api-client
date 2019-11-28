<?php

namespace BcConsulting\TuningApiClient\Tests\ModelFactories;

use BcConsulting\TuningApiClient\Models\Year;

class YearFactory extends BaseFactory
{
    protected $endpoint = '/api/vehicles/0/brands/0/models/0/years';
    protected $class = Year::class;

    public function __construct()
    {
        parent::__construct();
    }

    public function data(): array
    {
        return [
            'id' => $this->faker->randomDigit,
            'name' => $this->faker->word,
            'long_name' => $this->faker->words,
            'start_year' => $this->faker->numberBetween(1980, now()->year),
            'start_month' => $this->faker->numberBetween(1, 12),
            'end_year' => $this->faker->numberBetween(1980, now()->year),
            'end_month' => $this->faker->numberBetween(1, 12),
        ];
    }

}
