
<div class="page-header">
	<h1>{{{ $group->name }}} <small>{{{ $group->section_name }}}</small></h1>
</div>

{{ $attendee_list }}

<p class="clearfix">
	<a href="{{ URL::action('HomeController@showWelcome') }}" class="btn btn-success pull-right">Finished</a>
</p>