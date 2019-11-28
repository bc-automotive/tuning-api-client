<?php

namespace BcConsulting\TuningApiClient\Models;

use BcConsulting\TuningApiClient\Traits\HasRelation;
use BcConsulting\TuningApiClient\Traits\HasPicture;

class Year extends BaseModel
{
	use HasRelation, HasPicture;

	public $id;
	public $name;
	public $long_name;
	public $start_year;
	public $start_month;
	public $end_year;
	public $end_month;

    public function powertrains($powertrain = null)
    {
    	return $this->relation('powertrains', Powertrain::class, $powertrain);
	}

	public function miniature()
	{
		return $this->picture('miniature');
	}

}