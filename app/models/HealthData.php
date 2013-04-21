<?php

use Illuminate\Support\Fluent;

class HealthData extends Fluent implements ArrayAccess {
	
	public function __toString()
	{
		return json_encode($this->getAttributes());
	}

	public function offsetExists($offset)
	{
		return isset($this->$offset);
	}

	public function offsetGet($offset)
	{
		return $this->$offset;
	}

	public function offsetSet($offset, $value)
	{
		$this->$offset = $value;
	}

	public function offsetUnset($offset)
	{
		unset($this->$offset);
	}

}