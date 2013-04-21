<?php

class HealthForm extends BaseForm
{

    /** @var Attendee */
    public $attendee = null;

    /** @var array */
    public $rules = array(
        'surname' => 'required',
        'firstname' => 'required',
        'email' => 'required|email',
        'gender' => 'required|in:female,male',
        'date_of_birth' => 'required',
        'address' => 'required',
        'postcode' => 'required|min:5|max:10',
        'telephone' => 'required',
        // 'mobile' => '',
        'unit_name' => 'required',

        // Primary Contact
        'primary_contact_name' => 'required',
        'primary_contact_relationship' => 'required',
        'primary_contact_address' => 'required',
        'primary_contact_postcode' => 'required',
        'primary_contact_day_telephone' => 'required',
        'primary_contact_evening_telephone' => 'required',
        // 'primary_contact_mobile' => '',

        // Secondary Contact
        'secondary_contact_name' => 'required',
        'secondary_contact_relationship' => 'required',
        'secondary_contact_address' => 'required',
        'secondary_contact_postcode' => 'required',
        'secondary_contact_day_telephone' => 'required',
        'secondary_contact_evening_telephone' => 'required',
        // 'secondary_contact_mobile' => '',

        // Medical Details
        'doctor_name' => 'required',
        'doctor_telephone' => 'required',
        'doctor_address' => 'required',
        'doctor_postcode' => 'required',

        'medical_illness' => 'required|in:yes,no',
        // 'medical_illness_details' => '', // required when medical_illness,yes

        'medical_allergy' => 'required|in:yes,no',
        // 'medical_allergy_details' => '', // requried when medical_allergy,yes

        'medical_dietary' => 'required|in:yes,no',
        // 'medical_dietary_details' => '', // required when medical_dietary,yes

        // 'medical_tetnus_date' => '', // optional
        'medical_contact_lens' => 'required|in:yes,no',

        'medical_treatment' => 'required|in:yes,no',
        // 'medical_treatment_deatils' => '', // required when medical_treatment,yes

        // 'medication' => '',

        // Hospital Consultant (optional)
        // 'consultant_surname' => '',
        // 'consultant_firstname' => '',
        // 'consultant_hospital' => '',
        // 'consultant_telephone' => '',
        // 'patient_number' => '',

        'consent' => 'accepted',

    );
	
    public $adult_rules = array(
        'crb_number' => 'required',
        'crb_issue_date' => 'required',
        'is_leader' => 'required',
        'first_aid' => 'required',
    );

    protected function beforeValidator()
    {
        if (is_null($this->attendee))
        {
            throw new RuntimeException('Attendee must be set');            
        }

        if ($this->attendee->health->adult)
        {
            $this->rules += $this->adult_rules;
        }
    }

    public static function genders()
    {
        return array(
            '' => '-',
            'female' => Lang::get('health.female'),
            'male' => Lang::get('health.male'),
        );
    }

    public static function yesno()
    {
        return array(
            '' => '-',
            'no' => Lang::get('health.no'),
            'yes' => Lang::get('health.yes'),
        );
    }

    public function updateHealth(Attendee $attendee)
    {
        $health = $attendee->health;
        $health->fill($this->data);
        $health->save();

        return $health;
    }

}