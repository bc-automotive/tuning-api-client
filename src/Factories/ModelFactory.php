<?php

namespace BcConsulting\TuningApiClient\Factories;

class ModelFactory
{
	private $class = null;
	private $endpoint = null;

	public static function for($endpoint, $class)
	{
		return new static($endpoint, $class);
	}

	protected function __construct($endpoint, $class)
	{
		$this->endpoint = $endpoint;
		$this->class = $class;
	}

	public function collect(array $data = [])
	{
		$array = [];
		foreach($data as $value) {
			$array[] = $this->make($value);
		}
		return $array;
	}

	public function make(array $data = [])
	{
		return new $this->class($this->endpoint, $data);
	}
	
}