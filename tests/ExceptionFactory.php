<?php

namespace BcConsulting\TuningApiClient\Tests;

use Faker\Factory;

class ExceptionFactory
{
    protected $faker;
    
    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function make()
    {
        $data =  [];
        for($i = 0; $i < $this->faker->randomDigit; $i++) {
            $data[$this->faker->word] = $this->faker->sentence;
        }

        return (object)[
            'statuscode' => $this->faker->randomElement([401, 403, 500]),
            'code' => $this->faker->numberBetween(1000, 1010),
            'message' => $this->faker->sentence,
            'data' => $data,
        ];
    }

}
