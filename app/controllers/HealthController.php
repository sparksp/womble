<?php

class HealthController extends BaseController {

	/**
	 * The root route for this controller.
	 * @return mixed
	 */
	public function index()
	{

	}

	public function store(Attendee $attendee, $hash)
	{
		$attendee->hashMatches($hash);

		$form = new HealthAgeForm;

		if ($form->invalid()) {
			return Redirect::action('HealthController@create', [ $attendee->id, $attendee->hash ])->withErrors($form->validator())->withInput();
		}

		$health = $form->createHealth($attendee);
		
		return Redirect::action('HealthController@show', [ $attendee->id, $attendee->hash ]);
	}

	public function create(Attendee $attendee, $hash)
	{
		$attendee->hashMatches($hash);

		if ($attendee->hasHealth())
		{
			return Redirect::action('HealthController@edit', [$attendee->id, $hash]);
		}

		$health = new Health;
		$this->layout->nest('content', 'health.age', compact('attendee', 'health'));
	}

	public function update(Attendee $attendee, $hash)
	{
		$attendee->hashMatches($hash);

		$form = new HealthForm;
		$form->attendee = $attendee;

		if ($form->invalid())
		{
			return Redirect::action('HealthController@show', [ $attendee->id, $attendee->hash ])->withErrors($form->validator())->withInput();
		}

		$form->updateHealth($attendee);

		/** @todo thank-you page */
		return Redirect::action('HealthController@show', [ $attendee->id, $attendee->hash ]);
	}

	/**
	 * Start the health form process for the given attendee.
	 * @param  Attendee $attendee
	 * @param  string   $hash
	 * @return mixed
	 */
	public function show(Attendee $attendee, $hash)
	{
		$attendee->hashMatches($hash);

		if (!$attendee->hasHealth())
		{
			// If they've not started a health form yet we will send them to the start screen
			return Redirect::action('HealthController@create', [$attendee->id, $hash]);
		}

		$this->layout->nest('content', 'health.form', compact('attendee'));
	}

}