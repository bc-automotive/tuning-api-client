<?php

namespace BcConsulting\TuningApiClient;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use BcConsulting\TuningApiClient\Exceptions\TuningApiException;

class TuningApiClient
{
    use Traits\HasRelation;

    const PICTURE_FORMAT_BIN = "binary";
    const PICTURE_FORMAT_B64 = "base64";

    private static $client = null;

    private $token;
    private $base_uri;
    private $picture_format = self::PICTURE_FORMAT_B64;

    private $endpoint = '/api';

    private $guzzle;

    public static function config(array $config = [], GuzzleHttpClient $guzzle = null) {
        static::$client = new static($config, $guzzle);
    }

    private function __construct(array $config = [], GuzzleHttpClient $guzzle = null)
    {
        $this->token = $config['api_token'];
        $this->base_uri = $config['api_url'];

        $this->guzzle = $guzzle ?: new GuzzleHttpClient();
    }

    public static function vehicles($vehicle = null)
    {
        return static::$client->relation('vehicles', Models\Vehicle::class, $vehicle);
    }

    public static function collection($endpoint, $model)
    {
        return static::$client->getJson($endpoint, $model, 'collect');
    }

    public static function resource($endpoint, $model, $id = null)
    {
        return static::$client->getJson($endpoint, $model, 'make', $id);
    }

    public static function picture($endpoint)
    {
        $bin = static::$client->get($endpoint);
        return base64_encode($bin);
    }

    private function get($endpoint, $id = null)
    {
        $params = [
            'base_uri' => $this->base_uri,
            'headers' => [
                'X-Requested-With' => 'XMLHttpRequest',
                'Authorization' => 'Bearer '.$this->token,
            ],
        ];

        $ep = $endpoint;
        if ($id !== null) {
            $ep .= '/'.$id;
        }

        try {
            $response = $this->guzzle->get($ep, $params);
            return $response->getBody();
        } catch (RequestException $e) {
            throw new TuningApiException($e);
        }
    }

    private function getJson($endpoint, $class = null, $make = null, $id = null)
    {
        $body = $this->get($endpoint, $id);

        $data = json_decode($body, true);
        if ($class === null) {
            return $data;
        }

        $obj = Factories\ModelFactory::for($endpoint, $class)->$make($data);
        return $obj;
    }
}
