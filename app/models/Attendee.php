<?php

/**
 * An attendee at Womble.
 *
 * @property-read int id Unique identifier
 * @property string name
 * @property currency paid
 * @property int group_id
 * @property int sat_activity_id
 * @property int sun_activity_id
 * @property int user_id
 * @property-read datetime created_at
 * @property-read datetime updated_at
 */
class Attendee extends Eloquent {

	protected $table = 'attendees';

	public $fillable = ['name', 'sat_activity_id', 'sun_activity_id'];

	/**
	 * Belongs To: Group (Relationship)
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function group() {
		return $this->belongsTo('Group');
	}

	/**
	 * Belongs To: Activity (Relationship)
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function sat_activity() {
		return $this->belongsTo('Activity', 'sat_activity_id');
	}

	/**
	 * Belongs To: Activity (Relationship)
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function sun_activity() {
		return $this->belongsTo('Activity', 'sun_activity_id');
	}

	/**
	 * Has One: Health (Relationship)
	 * @return Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function health() {
		return $this->hasOne('Health');
	}

	/**
	 * Belongs To: User (Relationship)
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user() {
		return $this->belongsTo('User');
	}

	/**
	 * @param  Group  $group
	 * @throws  If [this condition is met]
	 * @return Attendee
	 */
	public function groupMatches(Group $group)
	{
		if ($group->id != $this->group_id) {
			throw new GroupMismatchException;
		}
	}

}