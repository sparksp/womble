
<div class="page-header">
  <h1>Register Your Group</h1>
</div>

{{ Form::model($group, [ 'action' => 'GroupController@store', 'class' => 'form-horizontal' ]).Form::token() }}

  <fieldset>
    <legend>Group Details</legend>

    <div class="control-group{{ $errors->first('name', ' error') }}">
      <label class="control-label" for="inputGroupName">Group Name</label>
      <div class="controls">
        {{ Form::text('name', null, [ 'id' => 'inputGroupName', 'placeholder' => 'Group Name', 'maxlength' => 50, 'required', 'autofocus' ]) }}
        {{ $errors->first('name', '<span class="help-inline">:message</span>') }}
      </div>
    </div>

    <div class="control-group{{ $errors->first('section', ' error') }}">
      <label class="control-label" for="inputSection">Section</label>
      <div class="controls">
        {{ Form::select('section', [ null => 'Choose a Section' ] + $sections, null, [ 'id' => 'inputSection', 'required' ]) }}
        {{ $errors->first('section', '<span class="help-inline">:message</span>') }}
      </div>
    </div>
  </fieldset>

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
        {{ $errors->first('contact_name', '<span class="help-inline">:message</span>') }}
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
    <button type="submit" class="btn btn-primary">Register</button>
    <a href="{{ URL::action('HomeController@showWelcome') }}" class="btn">Cancel</a>
  </div>

{{ Form::close() }}