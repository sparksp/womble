<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\MessageBag;

class GroupController extends BaseController {

  public function __construct()
  {
    $this->beforeFilter('registerable', [
      'except' => ['index', 'show'],
    ]);
  }

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

		return Redirect::action('GroupController@welcome', [ $group->id, $group->hash ]);
	}

	public function find()
	{
		$email = Input::get('contact_email');
		$hash  = Input::get('hash');

		$group = Group::where('contact_email', $email)->where('hash', $hash)->first();

		if (!$group) {
			$errors = new MessageBag;
			$errors->add('contact_email', 'No group found with these details');

			return Redirect::action('GroupController@search')->withErrors($errors)->withInput(Input::except('hash'));
		}

		return Redirect::action('GroupController@show', [$group->id, $group->hash]);
	}

	public function search()
	{
		$this->layout->content = View::make('group.search');
	}

	public function welcome($group, $hash)
	{
		$group->hashMatches($hash);

		$this->layout->nest('content', 'group.welcome', compact('group'));
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

	public function edit($group, $hash)
	{
		$group->hashMatches($hash);

		$this->layout->nest('content', 'group.edit', compact('group'));
	}

	public function update($group, $hash)
	{
		$group->hashMatches($hash);

		$form = new GroupContactEditForm;

		if ($form->invalid()) {
			return Redirect::action('GroupController@edit', [$group->id, $group->hash])->withErrors($form->validator())->withInput();
		}

		$group = $form->updateGroup($group);

		return Redirect::action('GroupController@show', [ $group->id, $group->hash ]);
	}

	public function index()
	{
		return Redirect::to('/');
	}

}
