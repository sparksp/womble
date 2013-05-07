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
	 * Create a new Attendee instance.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = array())
	{
		$this->setRandomHash();

		parent::__construct($attributes);
	}

	/**
	 * Generate a random hash and set it on the group.
	 * 
	 * @return  Attendee
	 */
	public function setRandomHash()
	{
		$this->hash = Str::random(8);

		return $this;
	}

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
		return $this->belongsTo('Health');
	}

	/**
	 * Has this attendee started a health form yet?
	 * @return boolean
	 */
	public function hasHealth()
	{
		return $this->health_id > 0;
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

	/**
	 * Check that the given hash matches this Group's hash.
	 * @param  string $hash
	 * @throws  GroupHashMismatchException If the hashes do not match
	 * @return  Group
	 */
	public function hashMatches($hash)
	{
		if ($hash != $this->hash) {
			throw new HashMismatchException;
		}

		return $this;
	}

}