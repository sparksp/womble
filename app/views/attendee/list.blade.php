<h2>Attendees</h2>
<p class="lead">Please list <b>all</b> of your group's attendees below, even if they are not taking part in any activities.</p>
<?php
	$messages = ["If they're not on the list then they won't be fed!", "Don't forget to include yourself if you're coming too!"];
	$message = $messages[array_rand($messages)];
?>
<p>{{{ $message }}}</p>

<table class="table">
	<thead>
		<tr>
			<th>Name</th>
			<th>Saturday</th>
			<th>Sunday</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
@if (count($attendees))
	@foreach ($attendees as $attendee)
		<tr>
			<td>{{{ $attendee->name }}}</td>
			<td>{{{ $attendee->sat_activity->name }}}</td>
			<td>{{{ $attendee->sun_activity->name }}}</td>
			<td class="btn-group">
				<button class="btn dropdown-toggle" data-toggle="dropdown">
					<span class="icon-cog"></span>
				</button>
				<ul class="dropdown-menu">
					<li><a href="{{ URL::action('AttendeeController@edit', [$group->id, $group->hash, $attendee->id]) }}"><i class="icon-pencil"></i> Change attendee</a></li>
					<li><a href="{{ URL::action('AttendeeController@remove', [$group->id, $group->hash, $attendee->id]) }}" class="text-warning"><i class="icon-remove"></i> Remove attendee</a></li>
				</ul>
			</td>
		</tr>
	@endforeach
@endif
	{{ Form::open(['action' => ['AttendeeController@store', $group->id, $group->hash] ]) }}
		<tr class="{{ $errors->count() ? 'error' : '' }}">
			<td class="control-group {{ $errors->first('name', 'error') }}">
				{{ Form::text('name', null, [ 'placeholder' => 'Full Name', 'maxlength' => 50, 'required', 'autofocus' ] ) . $errors->first('name') }}</td>
			<td class="control-group {{ $errors->first('sat_activity_id', 'error') }}">
				{{ Form::select('sat_activity_id', [null => 'Choose an activity'] + $sat_activities, null, [ 'required' ]) . $errors->first('sat_activity_id') }}</td>
			<td class="control-group {{ $errors->first('sun_activity_id', 'error') }}">
				{{ Form::select('sun_activity_id', [null => 'Choose an activity'] + $sun_activities, null, [ 'required' ]) . $errors->first('sun_activity_id') }}</td>
			<td><button class="btn btn-primary" title="Add attendee"><i class="icon-plus icon-white"></i></button></td>
		</tr>
	{{ Form::close() }}
	</tbody>
</table>
