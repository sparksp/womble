<?php

class HealthAgeForm extends BaseForm {

	/**
	 * @var array
	 */
	public $rules = [
		'date_of_birth' => 'required|date',
	];

	/**
	 * Create a health from the submitted data.
	 *
	 * @param  Attendee  $attendee
	 * @return Health
	 */
	public function createHealth(Attendee $attendee) {

		$data = $this->data;
		$data['unit_name'] = $attendee->group->name;

		$health = Health::create($data);
		
		$attendee->health_id = $health->id;
		$attendee->save();

		return $health;
	}

}