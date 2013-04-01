
<h1>{{{ $group->name }}} <small>{{{ $group->section_name }}}</small></h1>

{{ Form::open(['action' => ['AttendeeController@destroy', $group->id, $group->hash, $attendee->id], 'method' => 'delete']) }}

	<fieldset>
		<legend>Remove Attendee?</legend>

		<p>Are you sure you want to remove <b>{{{ $attendee->name }}}</b> from Womble 2013?</p>
	</fieldset>

	<div class="form-actions">
		<button class="btn btn-primary btn-danger">Yes, remove</button>
		<a href="{{ URL::action('GroupController@show', [$group->id, $group->hash]) }}" class="btn">No, cancel</a>
	</div>

{{ Form::close() }}