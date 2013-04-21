<?php

use Carbon\Carbon;
use Illuminate\Support\Fluent;

class Health extends Eloquent {
	
	/** @var string */
	protected $table = 'health';

	/** @var Fluent */
	protected $_data = null;

	/** @var array */
	protected $fillable = ['data'];

	/**
	 * Fill the model with an array of attributes.
	 *
	 * @param  array  $attributes
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function fill(array $attributes)
	{
		$data = array_except($attributes, ['id', 'created_at', 'updated_at']);
		
		$attributes = array_only($attributes, ['id', 'created_at', 'updated_at']);
		$attributes['data'] = array_merge($this->data, $data);

		return parent::fill($attributes);
	}

	public function setDataAttribute($value)
	{
		if ($value instanceof Fluent)
		{
			$value = json_encode($value->getAttributes());
		}
		else if (! is_scalar($value))
		{
			$value = json_encode($value);
		}

		$this->attributes['data'] = $value;
	}

	public function getDataAttribute($value)
	{
		return $value ? json_decode($value, true) : array();
	}

	/** @todo */
	public function getAdultAttribute($value)
	{
		$date_string = array_get($this->data, 'date_of_birth', '');

		$date = Carbon::createFromFormat('Y-m-d', $date_string);
		$today = new Carbon;
		
		return $date->diffInYears($today) >= 18;
	}

}