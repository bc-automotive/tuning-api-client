<?php

namespace BcConsulting\TuningApiClient\Traits;

use BcConsulting\TuningApiClient\TuningApiClient;

trait HasRelation
{

    public function relation($endpoint, $class, $id = null)
    {
    	$ep = $this->endpoint.'/';
    	if (property_exists($this, 'id')) {
    		$ep .= $this->id.'/';
    	}
    	$ep .= $endpoint;

        if ($id === null) {
            return TuningApiClient::collection($ep, $class);
        } else {
            return TuningApiClient::resource($ep, $class, $id);
        }
	}
	
}