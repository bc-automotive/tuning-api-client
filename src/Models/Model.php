<?php

namespace BcConsulting\TuningApiClient\Models;

use BcConsulting\TuningApiClient\Traits\HasRelation;
use BcConsulting\TuningApiClient\Traits\HasPicture;

class Model extends BaseModel
{
	use HasRelation, HasPicture;

	public $id;
	public $name;

    public function years($year = null)
    {
    	return $this->relation('years', Year::class, $year);
	}
	
	public function miniature()
	{
		return $this->picture('miniature');
	}

}