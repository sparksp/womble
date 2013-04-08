<?php

class GroupCreateForm extends BaseForm {

	/**
	 * @var array
	 */
	public $rules = [
		'name' => 'required|max:50',
		'section' => 'required|in:1,2,3',
		'contact_name' => 'required|max:50',
		'contact_email' => 'required|email|max:200',
		'contact_phone' => 'max:15',
	];

	/**
	 * Create a group from the submitted data.
	 * 
	 * @return Group
	 */
	public function createGroup() {
		return Group::create($this->data);
	}

}