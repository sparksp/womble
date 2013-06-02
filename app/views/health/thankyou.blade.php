
<div class="page-header">
	<h1>{{{ $attendee->name }}} <small>{{{ Lang::get('health.form') }}}</small></h1>
	<p class="lead">{{{ Lang::get('health.thankyou') }}}</p>
</div>

<h2>{{{ Lang::get('health.what_next') }}}</h2>
<p>{{{ Lang::get('health.what_next_details') }}}</p>

<ul>
@if ($attendee->adult)
	<li><a href="{{{ URL::asset('docs/womble-health-o18.docx') }}}">{{{ Lang::get('health.download_docx') }}}</a></li>
	<li><a href="{{{ URL::asset('docs/womble-health-o18.pdf') }}}">{{{ Lang::get('health.download_pdf') }}}</a></li>

@else
	<li><a href="{{{ URL::asset('docs/womble-health-u18.docx') }}}">{{{ Lang::get('health.download_docx') }}}</a></li>
	<li><a href="{{{ URL::asset('docs/womble-health-u18.pdf') }}}">{{{ Lang::get('health.download_pdf') }}}</a></li>

@endif
</ul>