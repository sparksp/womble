
<div class="page-header">
	<h1>{{{ $group->name }}} <small>{{{ $group->section_name }}}</small></h1>
</div>

{{ Form::model($group, [ 'action' => ['GroupController@update', $group->id, $group->hash], 'method' => 'patch'] ) }}

  <fieldset>
    <legend>Contact Details</legend>
    
    <div class="control-group{{ $errors->first('contact_name', ' error') }}">
      <label class="control-label" for="inputContactName">Contact Name</label>
      <div class="controls">
        {{ Form::text('contact_name', null, [ 'id' => 'inputContactName', 'placeholder' => 'Contact Name', 'maxlength' => 50, 'required' ]) }}
        {{ $errors->first('contact_name', '<span class="help-inline">:message</span>') }}
      </div>
    </div>

    <div class="control-group{{ $errors->first('contact_email', ' error') }}">
      <label class="control-label" for="inputContactEmail">Contact Email</label>
      <div class="controls">
        {{ Form::email('contact_email', null, [ 'id' => 'inputContactEmail', 'placeholder' => 'Contact Email', 'maxlength' => 200, 'required' ]) }}
        {{ $errors->first('contact_email', '<span class="help-inline">:message</span>') }}
      </div>
    </div>

    <div class="control-group{{ $errors->first('contact_phone', ' error') }}">
      <label class="control-label" for="inputContactPhone">Contact Phone</label>
      <div class="controls">
        {{ Form::input('tel', 'contact_phone', null, [ 'id' => 'inputContactPhone', 'placeholder' => 'Contact Phone', 'maxlength' => 15 ]) }}
        {{ $errors->first('contact_phone', '<span class="help-inline">:message</span>') }}
      </div>
    </div>

  </fieldset>

  <div class="form-actions">
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ URL::action('GroupController@show', [$group->id, $group->hash]) }}" class="btn">Cancel</a>
  </div>

{{ Form::close() }}