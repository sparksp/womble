
<div class="page-header">
	<h1>{{{ $group->name }}} <small>{{{ $group->section_name }}}</small></h1>
</div>

<p class="lead">You're almost ready, first make a note of your <b>Group Code</b>, you'll need this if you come back again...</p>

<div class="text-center">
	{{ Form::text('hash', $group->hash, [ 'readonly', 'autofocus', 'style' => 'width: auto; height: auto; font-size: 200%; text-align: center; cursor: text' ]) }}
	<a href="{{ URL::action('GroupController@show', [$group->id, $group->hash]) }}" class="btn btn-large btn-primary pull-right">Ok, got it</a>
</div>