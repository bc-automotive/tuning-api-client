<?php

namespace BcConsulting\TuningApiClient\Models;

use BcConsulting\TuningApiClient\Traits\HasRelation;
use BcConsulting\TuningApiClient\Traits\HasPicture;

class Brand extends BaseModel
{
	use HasRelation, HasPicture;

	public $id;
	public $name;

    public function models($model = null)
    {
    	return $this->relation('models', Model::class, $model);
	}

	public function logo()
	{
		return $this->picture('logo');
	}
	
}