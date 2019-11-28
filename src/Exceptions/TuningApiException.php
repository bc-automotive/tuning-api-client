<?php

namespace BcConsulting\TuningApiClient\Exceptions;

use GuzzleHttp\Exception\RequestException;

class TuningApiException extends \Exception
{
    private $statusCode = 0;
    private $data = [];

    public function __construct(RequestException $previous)
    {
        $code = $previous->getCode();
        $message = $previous->getMessage();

        if ($previous->hasResponse()) {
            $response = $previous->getResponse();

            $this->statusCode = $response->getStatusCode();

            $body = json_decode($response->getBody(), true);
            if (is_array($body)) {
                if (array_key_exists('code', $body)) {
                    $code = $body['code'];
                }
                if (array_key_exists('message', $body)) {
                    $message = $body['message'];
                }
                if (array_key_exists('data', $body)) {
                    $this->data = $body['data'];
                }
            } else {
                $message = (string)$response->getBody();
            }
        }

        parent::__construct($message, $code, $previous);
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getData()
    {
        return $this->data;
    }
}
