<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class GroupController extends BaseController {

	public function create()
	{
		$group = new Group;

		$this->layout->nest('content', 'group.register', [
			'group' => $group,
			'sections' => Group::sections(),
		]);
	}

	public function store()
	{
		$form = new GroupCreateForm;

		if ($form->invalid()) {
			return Redirect::action('GroupController@create')->withErrors($form->validator())->withInput();
		}

		$group = $form->createGroup();

		return Redirect::action('GroupController@show', [ $group->id, $group->hash ]);
	}

	public function show($group, $hash = '')
	{
		$group->hashMatches($hash);

		$form = new AttendeeCreateForm;
		$sat_activities = $form->activities('sat');
		$sun_activities = $form->activities('sun');

		$attendees =& $group->attendees;

		$content = View::make('group.show', compact('group'));
		$content->nest('attendee_list', 'attendee.list', compact('attendees', 'group', 'sat_activities', 'sun_activities'));

		$this->layout->content = $content;
	}

	public function index()
	{
		return Redirect::to('/');
	}

}