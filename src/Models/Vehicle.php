<?php

namespace BcConsulting\TuningApiClient\Models;

use BcConsulting\TuningApiClient\Traits\HasRelation;

class Vehicle extends BaseModel
{
	use HasRelation;

	public $id;
	public $name;

    public function brands($brand = null)
    {
    	return $this->relation('brands', Brand::class, $brand);
	}
	
}