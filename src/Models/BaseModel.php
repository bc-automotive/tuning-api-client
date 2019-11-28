<?php

namespace BcConsulting\TuningApiClient\Models;

class BaseModel
{
	protected $endpoint;
	protected $data;

	public function __construct($endpoint, array $data = [])
	{
		$this->endpoint = $endpoint;
		$this->data = $data;

		foreach($data as $key => $value) {
			$this->{$key} = $value;
		}
	}

	public function toArray()
	{
		return $this->data;
	}
	
}