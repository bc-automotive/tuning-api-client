<?php

namespace BcConsulting\TuningApiClient\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Middleware;
use PHPUnit\Framework\Assert as PHPUnit;

class Guzzle
{
    public $client = null;

    private $container;
    private $mockHandler;
    private $idx = 0;

    public function fake()
    {
        $this->idx = 0;
        $this->container = [];
        $history = Middleware::history($this->container);

        $this->mockHandler = new MockHandler;
        $handler = HandlerStack::create($this->mockHandler);
        $handler->push($history);
        $this->client = new Client(['handler' => $handler]);
        
        //app()->instance(Client::class, $client);
        return $this;
    }

    public function withResponse($statusCode = 200, $headers = [], $body = '', $version = '1.1', $reason = null)
    {
        if (! $this->mockHandler) {
            $this->fake();
        }

        if (is_array($body)) {
            $body = json_encode($body, JSON_PRETTY_PRINT);
        }

        $this->mockHandler->append(new Response($statusCode, $headers, $body, $version, $reason));
        return $this;
    }

    public function assertGet($uri = null)
    {
        return $this->assertRequest('GET', $uri);
    }

    public function assertPost($uri = null, $body = null)
    {
        return $this->assertRequest('POST', $uri, $body);
    }

    public function first()
    {
        $this->idx = 0;
        return $this;
    }

    public function last()
    {
        $this->idx = count($this->container) - 1;
        return $this;
    }

    private function assertRequest($method = null, $uri = null, $body = null)
    {        
        $request = $this->container[$this->idx++]['request'];

        if ($method !== null)
            PHPUnit::assertEquals($method, $request->getMethod());

        if ($uri !== null) {
            $uri = new Uri($uri);
            $m = 'getScheme';
            foreach(['getScheme', 'getHost', 'getPort', 'getPath', 'getQuery'] as $function) {
                if ($uri->$function() != '') 
                    PHPUnit::assertEquals($uri->$function(), $request->getUri()->$function());
            }            
        }

        if ($body !== null) {
            print_r($request->getBody()->getContents());
        }

        return $this;
    }

    public function assertCount($cnt)
    {
        PHPUnit::assertCount($cnt, $this->container);
        return $this;
    }
}
