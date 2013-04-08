<h2>Activities</h2>
 
<table class="table table-hover">
	<thead>
		<tr>
			<th></th>
			<th class="span2">Saturday</th>
			<th class="span2">Sunday</th>
		</tr>
	<thead>
	<tbody>
	@foreach ($activities as $activity)
		<tr>
			<td><strong><a href="{{{ $activity->link }}}">{{{ $activity->name }}}</a></strong></td>
			<td>
			@if ($activity->sat_avail == 0)
			@elseif ($activity->sat_avail == 1)
				<span class="badge badge-important">{{{ $activity->sat_avail }}}</span>
			@elseif ($activity->sat_avail == 2)
				<span class="badge badge-warning">{{{ $activity->sat_avail }}}</span>
			@else
				<span class="badge badge-info">{{{ $activity->sat_avail }}}</span>
			@endif
				{{ Lang::choice('messages.spaces', $activity->sat_avail, [ 'count' => '' ]) }}
			</td>
			<td>
			@if ($activity->sun_avail == 0)
			@elseif ($activity->sun_avail == 1)
				<span class="badge badge-important">{{{ $activity->sun_avail }}}</span>
			@elseif ($activity->sun_avail == 2)
				<span class="badge badge-warning">{{{ $activity->sun_avail }}}</span>
			@else
				<span class="badge badge-info">{{{ $activity->sun_avail }}}</span>
			@endif
				{{ Lang::choice('messages.spaces', $activity->sun_avail, [ 'count' => '' ]) }}
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
