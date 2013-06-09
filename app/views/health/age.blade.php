
<div class="page-header">
  <h1>{{{ $attendee->name }}} <small>{{{ Lang::get('health.form') }}}</small></h1>
</div>

{{ Form::model($health->data, [ 'action' => ['HealthController@store', $attendee->id, $attendee->hash ], 'method' => 'post', 'class' => 'form-horizontal' ] ) }}

  <fieldset>

    <legend>{{{ Lang::get('health.personal-details') }}}</legend>

      <div class="control-group{{ $errors->first('date_of_birth', ' error') }}">
        {{ Form::label('date_of_birth', Lang::get('health.date_of_birth'), [ 'class' => 'control-label'] ) }}
        <div class="controls">
          <div class="input-append date" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-enddate="{{ date('Y-m-d') }}">
            {{ Form::text('date_of_birth', null, [ 'placeholder' => 'YYYY-MM-DD', 'class' => 'input-small', 'readonly', 'required' ]) }}<span class="add-on"><i class="icon-th"></i></span>
          </div>
          {{ $errors->first('date_of_birth', '<span class="help-inline">:message</span>') }}
        </div>
      </div>

  </fieldset>

  <div class="form-actions">
    <button type="submit" class="btn btn-primary">{{{ Lang::get('health.continue') }}}</button>
  </div>

{{ Form::close() }}
