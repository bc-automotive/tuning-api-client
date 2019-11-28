<?php

namespace BcConsulting\TuningApiClient\Models;

use BcConsulting\TuningApiClient\Traits\HasRelation;
use BcConsulting\TuningApiClient\Traits\HasPicture;

class Powertrain extends BaseModel
{
	use HasRelation, HasPicture;

	public $id;
	public $name;
	public $flag;

	public function miniature()
	{
		return $this->picture('miniature');
	}

}