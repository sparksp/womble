<?php

/**
 * An attending group.
 *
 * @property-read int id Unique identifier
 * @property string name
 * @property string section
 * @property-read string section_name
 * @property string contact_name
 * @property string contact_email
 * @property string contact_phone
 * @property-read datetime created_at
 * @property-read datetime updated_at
 */
class Group extends Eloquent {

	const SECTION_EXPLORERS = 1;
	const SECTION_NETWORK = 2;
	const SECTION_LEADERS = 3;

	/** @var string */
	protected $table = 'groups';

	/** @var array */
	protected $dates = ['created_at', 'updated_at'];

	/**
	 * @var array The attributes that are mass assignable.
	 */
	protected $fillable = array(
		'name',
		'section',
		'contact_name',
		'contact_email',
		'contact_phone',
	);

	/**
	 * Create a new Group instance.
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
	 * @return  Group
	 */
	public function setRandomHash()
	{
		$this->hash = Str::random(8);

		return $this;
	}

	/**
	 * Get the name of this group's section.
	 * 
	 * @return string
	 */
	public function getSectionNameAttribute()
	{
		return array_get(static::sections(), $this->section);
	}

	/**
	 * Has Many: Attendee (Relationship)
	 * @return Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function attendees()
	{
		return $this->hasMany('Attendee');
	}

	/**
	 * List the sections
	 * @return array
	 */
	public static function sections()
	{
		return [
			self::SECTION_EXPLORERS => 'Explorers',
			self::SECTION_NETWORK   => 'Network',
			self::SECTION_LEADERS   => 'Leaders only',
		];
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

