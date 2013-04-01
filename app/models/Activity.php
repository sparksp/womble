<?php

/**
 * An activity at Womble 2013.
 *
 * @property-read int id Unique identifier
 * @property string name Activity Name
 * @property int sat_total Total spaces on Saturday
 * @property int sat_used  Spaces taken on Saturday
 * @property-read int sat_avail  Spaces available on Saturday
 * @property int sun_total Total spaces on Sunday
 * @property int sun_used  Spaces taken on Sunday
 * @property-read int sun_avail  Spaces available on Sunday
 * @property-read datetime created_at
 * @property-read datetime updated_at
 */
class Activity extends Eloquent {

	/**
	 * @var string The database table used by the model.
	 */
	protected $table = 'activities';

	/**
	 * @var array The attributes that are mass assignable.
	 */
	protected $fillable = array(
		'name',
		'sat_total',
		'sat_used',
		'sun_total',
		'sun_used',
	);

	protected function getSatAvailAttribute()
	{
		return $this->sat_total - $this->sat_used;
	}

	protected function getSunAvailAttribute()
	{
		return $this->sun_total - $this->sun_used;
	}

}
