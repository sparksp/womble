
<div class="page-header">
  <h1>{{{ $group->name }}} <small>{{{ $group->section_name }}}</small></h1>
</div>

{{ Form::model($attendee, ['action' => ['AttendeeController@update', $group->id, $group->hash, $attendee->id], 'method' => 'put', 'class' => 'form-horizontal']) }}

  <fieldset>
    <legend>Update Attendee</legend>

      <div class="control-group{{ $errors->first('name', ' error') }}">
        <label class="control-label" for="inputAttendeeName">Name</label>
        <div class="controls">
          {{ Form::text('name', null, [ 'id' => 'inputAttendeeName', 'placeholder' => 'Name', 'maxlength' => 50, '-required', 'autofocus' ]) }}
          {{ $errors->first('name', '<span class="help-inline">:message</span>') }}
        </div>
      </div>

      <div class="control-group{{ $errors->first('sat_activity_id', ' error') }}">
        <label class="control-label" for="inputSaturdayActivity">Saturday Activity</label>
        <div class="controls">
          {{ Form::select('sat_activity_id', ['' => 'Choose an activity'] + $sat_activities, null, [ 'id' => 'inputSaturdayActivity', '-required' ]) }}
          {{ $errors->first('sat_activity_id', '<span class="help-inline">:message</span>') }}
        </div>
      </div>

      <div class="control-group{{ $errors->first('sat_activity_id', ' error') }}">
        <label class="control-label" for="inputSundayActivity">Sunday Activity</label>
        <div class="controls">
          {{ Form::select('sun_activity_id', ['' => 'Choose an activity'] + $sun_activities, null, [ 'id' => 'inputSundayActivity', '-required' ]) }}
          {{ $errors->first('sun_activity_id', '<span class="help-inline">:message</span>') }}
        </div>
      </div>

  </fieldset>

  <div class="form-actions">
    <button class="btn btn-primary">Update</button>
    <a href="{{ URL::action('GroupController@show', [$group->id, $group->hash]) }}" class="btn">Cancel</a>
  </div>

{{ Form::close() }}
