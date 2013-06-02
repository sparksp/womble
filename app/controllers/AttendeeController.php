<?php

class AttendeeController extends BaseController {

  public function __construct()
  {
    $this->beforeFilter('registerable', [
      'except' => ['index', 'show'],
    ]);
  }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Group $group, $hash)
	{
		$group->hashMatches($hash);

		return Redirect::action('GroupController@show', [$group->id, $hash]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Group $group
	 * @param  string $hash
	 * @return Response
	 */
	public function store(Group $group, $hash)
	{
		$group->hashMatches($hash);

		$form = new AttendeeCreateForm;

		if ($form->invalid()) {
			return Redirect::action('GroupController@show', [$group->id, $hash])->withErrors($form->validator())->withInput();
		}

		$attendee = $form->createAttendee($group);

		return Redirect::action('GroupController@show', [$group->id, $hash]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Group $group, $hash, Attendee $attendee)
	{
		$group->hashMatches($hash);
		$attendee->groupMatches($group);

		return Redirect::action('GroupController@show', [$group->id, $hash]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($group, $hash, $attendee)
	{
		$group->hashMatches($hash);
		$attendee->groupMatches($group);
		
		$form = new AttendeeCreateForm;
		$form->attendee = $attendee;

		$sat_activities = $form->activities('sat', $attendee->sat_activity_id);
		$sun_activities = $form->activities('sun', $attendee->sun_activity_id);

		$this->layout->nest('content', 'attendee.edit', compact('group', 'attendee', 'sat_activities', 'sun_activities'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($group, $hash, $attendee)
	{
		$group->hashMatches($hash);
		$attendee->groupMatches($group);

		$form = new AttendeeCreateForm;
		$form->attendee = $attendee;

		if ($form->invalid()) {
			return Redirect::action('AttendeeController@edit', [$group->id, $hash, $attendee->id])->withErrors($form->validator())->withInput();
		}

		$form->updateAttendee($attendee);

		return Redirect::action('GroupController@show', [$group->id, $hash]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Group $group, $hash, Attendee $attendee)
	{
		$group->hashMatches($hash);
		$attendee->groupMatches($group);

		$attendee->delete();

		$activities = [
			'sat_activity_id' => 'sat_used',
			'sun_activity_id' => 'sun_used',
		];
		foreach ($activities as $activity_id => $used) {
			Activity::where('id', $attendee->$activity_id)->decrement($used);
		}

		return Redirect::action('GroupController@show', [$group->id, $hash]);
	}

	/**
	 * Show a form to confirm removing this attendee.
	 * 
	 * @param  Group  $group
	 * @param  string $hash
	 * @param  Attendee $attendee
	 * @return Response
	 */
	public function remove(Group $group, $hash, Attendee $attendee)
	{
		$group->hashMatches($hash);
		$attendee->groupMatches($group);

		$this->layout->nest('content', 'attendee.remove', compact('group', 'attendee'));
	}

}
