<?php

class GroupContactEditForm extends BaseForm {

	/**
	 * @var array
	 */
	public $rules = [
		'contact_name' => 'required|max:50',
		'contact_email' => 'required|email|max:200',
		'contact_phone' => 'max:15',
	];

	/**
	 * Create a group from the submitted data.
	 * 
	 * @return Group
	 */
	public function updateGroup(Group $group) {
		$group->fill(Input::only('contact_name', 'contact_email', 'contact_phone'));
		$group->save();

		return $group;
	}

}