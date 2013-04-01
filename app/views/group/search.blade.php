
<h1>Lookup your group</h1>

{{ Form::open(['action' => 'GroupController@find', 'class' => 'form-horizontal']) }}

	<fieldset>
		<legend>Group Details</legend>

    <div class="control-group{{ $errors->first('contact_email', ' error') }}">
      <label class="control-label" for="inputContactEmail">Contact Email</label>
      <div class="controls">
        {{ Form::email('contact_email', null, [ 'id' => 'inputContactEmail', 'placeholder' => 'Contact Email', 'maxlength' => 200, 'required' ]) }}
        {{ $errors->first('contact_email', '<span class="help-inline">:message</span>') }}
      </div>
    </div>

    <div class="control-group{{ $errors->first('hash', ' error') }}">
      <label class="control-label" for="inputGroupCode">Group Code</label>
      <div class="controls">
        {{ Form::password('hash', [ 'id' => 'inputGroupCode', 'placeholder' => 'Group Code', 'maxlength' => 8, 'required' ]) }}
        {{ $errors->first('hash', '<span class="help-inline">:message</span>') }}
      </div>
    </div>

	</fieldset>

    <div class="form-actions">
		<button class="btn btn-primary">Login</button>
	</div>


{{ Form::close() }}