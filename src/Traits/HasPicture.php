<?php

namespace BcConsulting\TuningApiClient\Traits;

use BcConsulting\TuningApiClient\TuningApiClient;

trait HasPicture
{

    public function picture($endpoint)
    {
        $ep = $this->endpoint.'/';
        if (property_exists($this, 'id')) {
            $ep .= $this->id.'/';
        }
        $ep .= $endpoint;

        return TuningApiClient::picture($ep);
	}
	
}