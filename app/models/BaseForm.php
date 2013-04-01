<?php

class BaseForm {

	/**
	 * @var array
	 */
	public $rules = [];

	/**
	 * @var array
	 */
	protected $data = array();

	/**
	 * @var Illuminate\Validation\Validator
	 */
	protected $validator = null;

	/**
	 * @param array $data
	 */
	public function __construct($data = null)
	{
		if (is_null($data)) {
			$data = Input::all();
		}
		$this->data = $data;
	}

	public function validator()
	{
		if (is_null($this->validator)) {
			$this->validator = Validator::make($this->data, $this->rules);
		}
		return $this->validator;
	}

	public function valid()
	{
		return $this->validator()->passes();
	}

	public function invalid()
	{
		return $this->validator()->fails();
	}

	public function errors()
	{
		return $this->validator()->errors();
	}

}