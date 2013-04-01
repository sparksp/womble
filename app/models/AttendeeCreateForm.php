<?php

class AttendeeCreateForm extends BaseForm {

	public $attendee = null;

	public $rules = [
		'name' => ['required', 'max:50'],
		'sat_activity_id' => ['required', 'exists:activities,id'],
		'sun_activity_id' => ['required', 'exists:activities,id'],
	];

	protected function beforeValidator()
	{
		Validator::extend('spaces', function($attribute, $value, $parameters)
		{
			if ($parameters[2] == $value) return true;

			$activity = Activity::find($value);
			$total = $parameters[1].'_total';
			$avail = $parameters[1].'_avail';

			if ($activity->$total == -1) return true;
			if ($activity->$avail > 0) return true;

			return false;
		});

		$this->rules['sat_activity_id'][] = 'spaces:activities,sat,'.(is_null($this->attendee) ? 0 : $this->attendee->sat_activity_id);
		$this->rules['sun_activity_id'][] = 'spaces:activities,sun,'.(is_null($this->attendee) ? 0 : $this->attendee->sun_activity_id);
	}

	public function createAttendee(Group $group)
	{
		$attendee = new Attendee($this->data);
		$group->attendees()->save($attendee);

		Activity::where('id', $attendee->sat_activity_id)->increment('sat_used');
		Activity::where('id', $attendee->sun_activity_id)->increment('sun_used');

		return $attendee;
	}

	public function updateAttendee(Attendee $attendee)
	{
		$attendee->fill($this->data);
		$changed = $attendee->getDirty();

		$activities = [
			'sat_activity_id' => 'sat_used',
			'sun_activity_id' => 'sun_used',
		];
		foreach ($activities as $activity_id => $used) {
			if (array_key_exists($activity_id, $changed)) {
				Activity::where('id', $attendee->getOriginal($activity_id))->decrement($used);
				Activity::where('id', $attendee->$activity_id)->increment($used);
			}
		}
		$attendee->save();

		return $attendee;
	}

	public function activities($day = 'sat', $current = 0)
	{
		$total = $day.'_total';
		$avail = $day.'_avail';

		$activities = Activity::all();

		$options = array();
		foreach ($activities as $activity) {
			if ($activity->$total == -1) {
				$label = $activity->name;
			}
			else if ($activity->$avail > 0 or $activity->id == $current) {
				$label = $activity->name . ' ('. Lang::choice('messages.spaces', $activity->$avail, ['count' => $activity->$avail]) .')';
			}
			else {
				continue; // Skip!
			}
			$options[$activity->id] = $label;
		}

		return $options;
	}

}
