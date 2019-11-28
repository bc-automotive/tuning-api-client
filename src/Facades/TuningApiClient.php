<?php

namespace BcConsulting\TuningApiClient\Facades;

use Illuminate\Support\Facades\Facade;

class TuningApiClient extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'tuning-api-client';
	}
	
}