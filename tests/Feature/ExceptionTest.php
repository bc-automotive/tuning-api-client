<?php

namespace BcConsulting\TuningApiClient\Tests\Feature;

use BcConsulting\TuningApiClient\Tests\TestCase;
use BcConsulting\TuningApiClient\TuningApiClient;
use BcConsulting\TuningApiClient\Exceptions\TuningApiException;
use Facades\BcConsulting\TuningApiClient\Tests\ExceptionFactory;

class ExceptionTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

    }

    /**
     * @test
     */
    public function an_json_error_response_throws_an_exception()
    {
        $exception = ExceptionFactory::make();
        $this->withExceptionResponse($exception);

        try {
            TuningApiClient::vehicles();
        } catch (TuningApiException $e) {
            $this->assertEquals($exception->code, $e->getCode());
            $this->assertEquals($exception->message, $e->getMessage());
            $this->assertEquals($exception->statuscode, $e->getStatusCode());
            $this->assertIsArray($e->getData());
            $this->assertEquals($exception->data, $e->getData());
            return;
        }
        $this->fail('Expected exception not thrown');
    }

    /**
     * @test
     */
    public function an_text_error_response_throws_an_exception()
    {
        $this->guzzle->withResponse(401, [], 'Unauthenticated');

        try {
            TuningApiClient::vehicles();
        } catch (TuningApiException $e) {
            $this->assertEquals(401, $e->getCode());
            $this->assertEquals('Unauthenticated', $e->getMessage());
            $this->assertEquals(401, $e->getStatusCode());
            $this->assertIsArray($e->getData());
            $this->assertEquals([], $e->getData());
            return;
        }
        $this->fail('Expected exception not thrown');
    }

}
