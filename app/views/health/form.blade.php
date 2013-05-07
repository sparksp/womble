
<div class="page-header">
<h1>{{{ $attendee->name }}} <small>{{{ Lang::get('health.form') }}}</small></h1>
</div>

{{ Form::model($attendee->health->data, [ 'action' => ['HealthController@update', $attendee->id, $attendee->hash ], 'method' => 'patch', 'class' => 'form-horizontal' ]) }}

<fieldset>
    <legend>{{Lang::get('health.personal-details') }}</legend>

    @if ($errors->all())
    <div class="alert alert-block alert-error">
        <strong>{{Lang::get('health.oops') }}</strong>
        {{Lang::get('health.please_try_again') }}
    </div>
    @endif

    <div class="control-group{{ $errors->first('surname', ' error') }}">
        {{ Form::label('surname', Lang::get('health.surname'), [ 'class' => 'control-label' ] ) }}
        <div class="controls">
            {{ Form::text('surname', null, [ 'required' ] ) }}
            {{ $errors->first('surname', '<span class="help-inline">:message</span>') }}
        </div>
    </div>

    <div class="control-group{{ $errors->first('firstname', ' error') }}">
        {{ Form::label('firstname', Lang::get('health.firstname'), [ 'class' => 'control-label'] ) }}
        <div class="controls">
            {{ Form::text('firstname', null, [ 'required' ] ) }}
            {{ $errors->first('firstname', '<span class="help-inline">:message</span>') }}
        </div>
    </div>

    <div class="control-group{{ $errors->first('email', ' error') }}">
        {{ Form::label('email', Lang::get('health.email'), [ 'class' => 'control-label'] ) }}
        <div class="controls">
            {{ Form::email('email', null, [ 'required' ] ) }}
            {{ $errors->first('email', '<span class="help-inline">:message</span>') }}
        </div>
    </div>

    <div class="control-group{{ $errors->first('gender', ' error') }}">
        {{ Form::label('gender', Lang::get('health.gender'), [ 'class' => 'control-label'] ) }}
        <div class="controls">
            {{ Form::select('gender', HealthForm::genders(), null, [ 'class' => 'input-small', 'required' ] ) }}
            {{ $errors->first('gender', '<span class="help-inline">:message</span>') }}
        </div>
    </div>

    <div class="control-group{{ $errors->first('date_of_birth', ' error') }}">
        {{ Form::label('date_of_birth', Lang::get('health.date_of_birth'), [ 'class' => 'control-label'] ) }}
        <div class="controls">
            <div class="input-append date" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-enddate="1999-12-31">
                {{ Form::text('date_of_birth', null, [ 'placeholder' => 'YYYY-MM-DD', 'class' => 'input-small', 'readonly', 'required' ]) }}<span class="add-on"><i class="icon-th"></i></span>
            </div>
            {{ $errors->first('date_of_birth', '<span class="help-inline">:message</span>') }}
        </div>
    </div>

    <div class="control-group{{ $errors->first('height', ' error') }}">
       {{ Form::label('height', Lang::get('health.height'), [ 'class' => 'control-label' ] ) }}
        <div class="controls"><div class="input-append">
            {{ Form::text('height', null, [ 'class' => 'input-mini' ]) }}<span class="add-on">{{ Lang::get('health.cm') }}</span>
        </div></div>
    </div>

    <div class="control-group{{ $errors->first('weight', ' error') }}">
        {{ Form::label('weight', Lang::get('health.weight'), [ 'class' => 'control-label' ] ) }}
        <div class="controls"><div class="input-append">
            {{ Form::text('weight', null, [ 'class' => 'input-mini' ]) }}<span class="add-on">{{ Lang::get('health.kg') }}</span>
        </div></div>
    </div>

    <div class="control-group{{ $errors->first('address', ' error').$errors->first('postcode', ' error') }}">
        {{ Form::label('address', Lang::get('health.address'), [ 'class' => 'control-label'] ) }}
        <div class="controls">
            {{
                Form::textarea('address', null, [ 'rows' => 3, 'required' ]) .
                $errors->first('address', '<span class="help-inline">:message</span>')
            }}<br>{{
                Form::text('postcode', null, [ 'placeholder' => Lang::get('health.postcode'), 'style' => 'text-transform: uppercase', 'maxlength' => 8, 'class' => 'input-small', 'required' ]) .
                $errors->first('postcode', '<p class="help-inline">:message</span>')
            }}
        </div>
    </div>

    <div class="control-group{{ $errors->first('telephone', ' error') }}">
        {{ Form::label('telephone', Lang::get('health.telephone'), [ 'class' => 'control-label'] ) }}
        <div class="controls">
            {{ Form::input('tel', 'telephone', null, [ 'required' ] ) }}
            {{ $errors->first('telephone', '<span class="help-inline">:message</span>') }}
        </div>
    </div>

@if ($attendee->health->adult)

    <div class="control-group{{ $errors->first('mobile', ' error') }}">
        {{ Form::label('mobile', Lang::get('health.mobile'), [ 'class' => 'control-label'] ) }}
        <div class="controls">
            {{ Form::input('tel', 'mobile') }}
            {{ $errors->first('mobile', '<span class="help-inline">:message</span>') }}
        </div>
    </div>

@endif

    <div class="control-group{{ $errors->first('unit_name', ' error') }}">
        {{ Form::label('unit_name', Lang::get('health.unit_name'), [ 'class' => 'control-label'] ) }}
        <div class="controls">
            {{ Form::text('unit_name', null, [ 'required' ] ) }}
            {{ $errors->first('unit_name', '<span class="help-inline">:message</span>') }}
        </div>
    </div>

@if ($attendee->health->adult)

    <div class="control-group{{ $errors->first('crb_number', ' error') }}">
        {{ Form::label('crb_number', Lang::get('health.crb_number'), [ 'class' => 'control-label'] ) }}
        <div class="controls">
            {{ Form::text('crb_number', null, [ 'maxlength' => 12, 'required' ] ) }}
            {{ $errors->first('crb_number', '<span class="help-inline">:message</span>') }}
        </div>
    </div>

    <div class="control-group{{ $errors->first('crb_issue_date', ' error') }}">
        {{ Form::label('crb_issue_date', Lang::get('health.crb_issue_date'), [ 'class' => 'control-label'] ) }}
        <div class="controls">
            <div class="input-append date" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-startdate="2008-01-01">
                {{ Form::text('crb_issue_date', null, [ 'placeholder' => 'YYYY-MM-DD', 'class' => 'input-small', 'readonly', 'required' ]) }}<span class="add-on"><i class="icon-th"></i></span>
            </div>
            {{ $errors->first('crb_issue_date', '<span class="help-inline">:message</span>') }}
        </div>
    </div>

    <div class="control-group">
        <p class="controls">{{Lang::get('health.crb_instructions') }}</p>
    </div>

    <div class="control-group{{ $errors->first('is_leader', ' error') }}">
        {{ Form::label('is_leader', Lang::get('health.is_leader')) }}
        <div class="controls">
            {{ Form::select('is_leader', HealthForm::yesno(), null, [ 'class' => 'input-mini', 'required' ]) }}
            {{ $errors->first('is_leader', '<p class="help-inline">:message</p>') }}
        </div>
    </div>

    <div class="control-group{{ $errors->first('first_aid', ' error') }}">
        {{ Form::label('first_aid', Lang::get('health.first_aid')) }}
        <div class="controls">
            {{ Form::select('first_aid', HealthForm::yesno(), null, [ 'class' => 'input-mini', 'required' ]) }}

            {{ Form::label('first_aid_details', Lang::get('health.if_yes_give_details')) }}
            {{ Form::text('first_aid_details') }}

            {{ $errors->first('first_aid', '<p class="help-block">:message</p>') }}
        </div>
    </div>

@endif
</fieldset><fieldset>

    <legend>{{Lang::get('health.home-contact') }}</legend>

    <div class="row"><div class="primary-contact-block span6">

        <h3>{{Lang::get('health.primary-contact') }}</h3>

        <div class="control-group{{ $errors->first('primary_contact_name', ' error') }}">
            {{ Form::label('primary_contact_name', Lang::get('health.contact_name'), [ 'class' => 'control-label'] ) }}
            <div class="controls">
                {{ Form::text('primary_contact_name', null, [ 'required' ] ) }}
                {{ $errors->first('primary_contact_name', '<span class="help-block">:message</span>') }}
            </div>
        </div>

        <div class="control-group{{ $errors->first('primary_contact_relationship', ' error') }}">
            {{ Form::label('primary_contact_relationship', Lang::get('health.contact_relationship'), [ 'class' => 'control-label'] ) }}
            <div class="controls">
                {{ Form::text('primary_contact_relationship', null, [ 'required' ] ) }}
                {{ $errors->first('primary_contact_relationship', '<span class="help-block">:message</span>') }}
            </div>
        </div>

        <div class="control-group{{ $errors->first('primary_contact_address', ' error').$errors->first('primary_contact_postcode', ' error') }}">
            {{ Form::label('primary_contact_address', Lang::get('health.contact_address'), [ 'class' => 'control-label'] ) }}
            <div class="controls">
                {{ Form::textarea('primary_contact_address', null, [ 'rows' => 3, 'required' ]) }}<br>
                {{ Form::text('primary_contact_postcode', null, [ 'placeholder' => Lang::get('health.contact_postcode'), 'style' => 'text-transform: uppercase', 'maxlength' => 8, 'class' => 'input-small', 'required' ]) }}
                {{ $errors->first('primary_contact_address', '<span class="help-block">:message</span>') ?: $errors->first('primary_contact_postcode', '<p class="help-block">:message</span>') }}
            </div>
        </div>

        <div class="control-group{{ $errors->first('primary_contact_day_telephone', ' error') }}">
            {{ Form::label('primary_contact_day_telephone', Lang::get('health.contact_day_telephone'), [ 'class' => 'control-label'] ) }}
            <div class="controls">
                {{ Form::input('tel', 'primary_contact_day_telephone', null, [ 'required' ] ) }}
                {{ $errors->first('primary_contact_day_telephone', '<span class="help-block">:message</span>') }}
            </div>
        </div>

        <div class="control-group{{ $errors->first('primary_contact_evening_telephone', ' error') }}">
            {{ Form::label('primary_contact_evening_telephone', Lang::get('health.contact_evening_telephone'), [ 'class' => 'control-label'] ) }}
            <div class="controls">
                {{ Form::input('tel', 'primary_contact_evening_telephone', null, [ 'required' ] ) }}
                {{ $errors->first('primary_contact_evening_telephone', '<span class="help-block">:message</span>') }}
            </div>
        </div>

        <div class="control-group{{ $errors->first('primary_contact_mobile', ' error') }}">
            {{ Form::label('primary_contact_mobile', Lang::get('health.contact_mobile'), [ 'class' => 'control-label'] ) }}
            <div class="controls">
                {{ Form::input('tel', 'primary_contact_mobile') }}
                {{ $errors->first('primary_contact_mobile', '<span class="help-block">:message</span>') }}
            </div>
        </div>

    </div><div class="secondary-contact-block span6">

        <h3>{{Lang::get('health.secondary-contact') }}</h3>

        <div class="control-group{{ $errors->first('secondary_contact_name', ' error') }}">
            {{ Form::label('secondary_contact_name', Lang::get('health.contact_name'), [ 'class' => 'control-label'] ) }}
            <div class="controls">
                {{ Form::text('secondary_contact_name', null, [ 'required' ] ) }}
                {{ $errors->first('secondary_contact_name', '<span class="help-block">:message</span>') }}
            </div>
        </div>

        <div class="control-group{{ $errors->first('secondary_contact_relationship', ' error') }}">
            {{ Form::label('secondary_contact_relationship', Lang::get('health.contact_relationship'), [ 'class' => 'control-label'] ) }}
            <div class="controls">
                {{ Form::text('secondary_contact_relationship', null, [ 'required' ] ) }}
                {{ $errors->first('secondary_contact_relationship', '<span class="help-block">:message</span>') }}
            </div>
        </div>

        <div class="control-group{{ $errors->first('secondary_contact_address', ' error').$errors->first('secondary_contact_postcode', ' error') }}">
            {{ Form::label('secondary_contact_address', Lang::get('health.contact_address'), [ 'class' => 'control-label'] ) }}
            <div class="controls">
                {{ Form::textarea('secondary_contact_address', null, [ 'rows' => 3, 'required' ]) }}<br>
                {{ Form::text('secondary_contact_postcode', null, [ 'placeholder' => Lang::get('health.contact_postcode'), 'style' => 'text-transform: uppercase', 'maxlength' => 8, 'class' => 'input-small', 'required' ]) }}
                {{ $errors->first('secondary_contact_address', '<span class="help-block">:message</span>') ?: $errors->first('secondary_contact_postcode', '<p class="help-block">:message</span>') }}
            </div>
        </div>

        <div class="control-group{{ $errors->first('secondary_contact_day_telephone', ' error') }}">
            {{ Form::label('secondary_contact_day_telephone', Lang::get('health.contact_day_telephone'), [ 'class' => 'control-label'] ) }}
            <div class="controls">
                {{ Form::input('tel', 'secondary_contact_day_telephone', null, [ 'required' ] ) }}
                {{ $errors->first('secondary_contact_day_telephone', '<span class="help-block">:message</span>') }}
            </div>
        </div>

        <div class="control-group{{ $errors->first('secondary_contact_evening_telephone', ' error') }}">
            {{ Form::label('secondary_contact_evening_telephone', Lang::get('health.contact_evening_telephone'), [ 'class' => 'control-label'] ) }}
            <div class="controls">
                {{ Form::input('tel', 'secondary_contact_evening_telephone', null, [ 'required' ] ) }}
                {{ $errors->first('secondary_contact_evening_telephone', '<span class="help-block">:message</span>') }}
            </div>
        </div>

        <div class="control-group{{ $errors->first('secondary_contact_mobile', ' error') }}">
            {{ Form::label('secondary_contact_mobile', Lang::get('health.contact_mobile'), [ 'class' => 'control-label'] ) }}
            <div class="controls">
                {{ Form::input('tel', 'secondary_contact_mobile') }}
                {{ $errors->first('secondary_contact_mobile', '<span class="help-block">:message</span>') }}
            </div>
        </div>

    </div></div>

</fieldset><fieldset>

    <legend>{{Lang::get('health.medical_details') }}</legend>
    <p>{{Lang::get('health.medical_include_extra') }}</p>

    <div class="control-group{{ $errors->first('doctor_name', ' error') }}">
        {{ Form::label('doctor_name', Lang::get('health.doctor_name'), [ 'class' => 'control-label'] ) }}
        <div class="controls">
            {{ Form::text('doctor_name', null, [ 'required' ] ) }}
            {{ $errors->first('doctor_name', '<span class="help-inline">:message</span>') }}
        </div>
    </div>

    <div class="control-group{{ $errors->first('doctor_telephone', ' error') }}">
        {{ Form::label('doctor_telephone', Lang::get('health.doctor_telephone'), [ 'class' => 'control-label'] ) }}
        <div class="controls">
            {{ Form::text('doctor_telephone', null, [ 'required' ] ) }}
            {{ $errors->first('doctor_telephone', '<span class="help-inline">:message</span>') }}
        </div>
    </div>

    <div class="control-group{{ $errors->first('doctor_address', ' error').$errors->first('doctor_postcode', ' error') }}">
        {{ Form::label('doctor_address', Lang::get('health.doctor_address'), [ 'class' => 'control-label'] ) }}
        <div class="controls">
            {{
                Form::textarea('doctor_address', null, [ 'rows' => 3, 'required' ]) .
                $errors->first('doctor_address', '<span class="help-inline">:message</span>')
            }}<br>{{
                Form::text('doctor_postcode', null, [ 'placeholder' => Lang::get('health.doctor_postcode'), 'style' => 'text-transform: uppercase', 'maxlength' => 8, 'class' => 'input-small', 'required' ]) .
                $errors->first('doctor_postcode', '<p class="help-inline">:message</span>')
            }}
        </div>
    </div>

    <div class="control-group medical_illness{{ $errors->first('medical_illness', ' error') }}">
        {{ Form::label('medical_illness', Lang::get('health.medical_illness')) }}
        <div class="controls">
            {{ Form::select('medical_illness', HealthForm::yesno(), null, [ 'class' => 'input-mini' ]) }}

            {{ Form::label('medical_illness_details', Lang::get('health.if_yes_give_details')) }}
            {{ Form::text('medical_illness_details', null, [ 'class' => 'input-xlarge' ]) }}

            {{ $errors->first('medical_illness', '<p class="help-block">:message</p>') }}
        </div>
    </div>

    <div class="control-group medical_allergy{{ $errors->first('medical_allergy', ' error') }}">
        {{ Form::label('medical_allergy', Lang::get('health.medical_allergy')) }}
        <div class="controls">
            {{ Form::select('medical_allergy', HealthForm::yesno(), null, [ 'class' => 'input-mini' ]) }}

            {{ Form::label('medical_allergy_details', Lang::get('health.if_yes_give_details')) }}
            {{ Form::text('medical_allergy_details', null, [ 'class' => 'input-xlarge' ]) }}

            {{ $errors->first('medical_allergy', '<p class="help-block">:message</p>') }}
        </div>
    </div>

    <div class="control-group medical_dietary{{ $errors->first('medical_dietary', ' error') }}">
        {{ Form::label('medical_dietary', Lang::get('health.medical_dietary')) }}
        <div class="controls">
            {{ Form::select('medical_dietary', HealthForm::yesno(), null, [ 'class' => 'input-mini' ]) }}

            {{ Form::label('medical_dietary_details', Lang::get('health.if_yes_give_details')) }}
            {{ Form::text('medical_dietary_details', null, [ 'class' => 'input-xlarge' ]) }}

            {{ $errors->first('medical_dietary', '<p class="help-block">:message</p>') }}
        </div>
    </div>

    <div class="control-group{{ $errors->first('medical_tetnus_date', ' error') }}">
        {{ Form::label('medical_tetnus_date', Lang::get('health.medical_tetnus_date')) }}
        <div class="controls">
            <div class="input-append date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                {{ Form::text('medical_tetnus_date', null, [ 'placeholder' => 'YYYY-MM-DD', 'class' => 'input-small', 'readonly' ]) }}<span class="add-on"><i class="icon-th"></i></span>
            </div>
            {{ $errors->first('medical_tetnus_date', '<span class="help-inline">:message</span>') }}
        </div>
    </div>

    <div class="control-group contact_lens{{ $errors->first('medical_contact_lens', ' error') }}">
        {{ Form::label('medical_contact_lens', Lang::get('health.medical_contact_lens')) }}
        <div class="controls">
            {{ Form::select('medical_contact_lens', HealthForm::yesno(), null, [ 'class' => 'input-mini' ]) }}

            {{ $errors->first('medical_contact_lens', '<p class="help-block">:message</p>') }}
        </div>
    </div>

    <div class="control-group medical_treatment{{ $errors->first('medical_treatment', ' error') }}">
        {{ Form::label('medical_treatment', Lang::get('health.medical_treatment')) }}
        <div class="controls">
            {{ Form::select('medical_treatment', HealthForm::yesno(), null, [ 'class' => 'input-mini' ]) }}

            {{ Form::label('medical_treatment_details', Lang::get('health.if_yes_give_details')) }}
            {{ Form::text('medical_treatment_details', null, [ 'class' => 'input-xlarge' ]) }}

            {{ $errors->first('medical_treatment', '<p class="help-block">:message</p>') }}
        </div>
    </div>

    <div class="row">
    <div class="control-group medication{{ $errors->first('medication', ' error') }} span6">
        {{ Form::label('medication', Lang::get('health.medication')) }}
        <div class="controls">
            {{ Form::textarea('medication', null, array('rows' => 4, 'class' => 'input-xlarge')) }}

            {{ $errors->first('medication', '<p class="help-block">:message</p>') }}
        </div>
    </div>
@if (! $attendee->health->adult)
    <div class="span6">
        <h4 style="font-size: 100%; padding: 0; margin: 0 0 5px">{{Lang::get('health.medication_note') }}</h4>
        <p style="line-height: 1.6">{{Lang::get('health.medication_note_detail') }}</p>
    </div>
@endif
    </div>

    <h3>{{ Lang::get('health.hospital-consultant') }}</h3>

    <div class="control-group{{ $errors->first('consultant_surname', ' error') }}">
        {{ Form::label('consultant_surname', Lang::get('health.consultant_surname'), [ 'class' => 'control-label'] ) }}
        <div class="controls">
            {{ Form::text('consultant_surname') }}
            {{ $errors->first('consultant_surname', '<span class="help-inline">:message</span>') }}
        </div>
    </div>

    <div class="control-group{{ $errors->first('consultant_firstname', ' error') }}">
        {{ Form::label('consultant_firstname', Lang::get('health.consultant_firstname'), [ 'class' => 'control-label'] ) }}
        <div class="controls">
            {{ Form::text('consultant_firstname') }}
            {{ $errors->first('consultant_firstname', '<span class="help-inline">:message</span>') }}
        </div>
    </div>

    <div class="control-group{{ $errors->first('consultant_hospital', ' error') }}">
        {{ Form::label('consultant_hospital', Lang::get('health.consultant_hospital'), [ 'class' => 'control-label'] ) }}
        <div class="controls">
            {{ Form::text('consultant_hospital') }}
            {{ $errors->first('consultant_hospital', '<span class="help-inline">:message</span>') }}
        </div>
    </div>

    <div class="control-group{{ $errors->first('consultant_telephone', ' error') }}">
        {{ Form::label('consultant_telephone', Lang::get('health.consultant_telephone'), [ 'class' => 'control-label'] ) }}
        <div class="controls">
            {{ Form::input('tel', 'consultant_telephone') }}
            {{ $errors->first('consultant_telephone', '<span class="help-inline">:message</span>') }}
        </div>
    </div>

    <div class="control-group{{ $errors->first('patient_number', ' error') }}">
        {{ Form::label('patient_number', Lang::get('health.patient_number'), [ 'class' => 'control-label'] ) }}
        <div class="controls">
            {{ Form::text('patient_number') }}
            {{ $errors->first('patient_number', '<span class="help-inline">:message</span>') }}
        </div>
    </div>

</fieldset><fieldset>

    <legend>{{Lang::get('health.permission') }}</legend>
    <p>{{Lang::get('health.permission_detail') }}</p>
    <p><strong>{{Lang::get('health.changes_detail') }}</strong></p>

    <h3>{{Lang::get('health.publicity') }}</h3>
    <p>{{Lang::get('health.publicity_detail') }}</p>

    <h3>{{Lang::get('health.cancellation') }}</h3>
    <p>{{Lang::get('health.cancellation_detail') }}</p>


    <h3>{{Lang::get('health.consent') }}</h3>
    <p>{{Lang::get('health.consent_detail') }}</p>
    

    <div class="form-inline"><div class="control-group consent{{ $errors->first('consent', ' error') }}">
        {{ Form::label('consent', Lang::get('health.understand')) }}
        {{ Form::select('consent', HealthForm::yesno(), null, [ 'class' => 'input-mini', 'required' ]) }}
        {{ $errors->first('consent', '<span class="help-inline">:message</span>') }}
    </div></div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">{{{ Lang::get('health.submit') }}}</button>
    </div>

</fieldset>
{{ Form::close() }}
