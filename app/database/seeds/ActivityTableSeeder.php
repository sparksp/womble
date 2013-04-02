<?php

class ActivityTableSeeder extends Seeder {

	protected static $activities = [
		[
			'name' => 'Canoeing',
			'link' => '//womble.me.uk/?p=14',
			'spaces' => 12,
		],
		[
			'name' => 'Caving',
			'link' => '//womble.me.uk/?p=23',
			'spaces' => 15,
		],
		[
			'name' => 'Climbing',
			'link' => '//womble.me.uk/?p=33',
			'spaces' => 20,
		],
		[
			'name' => 'Mountain Biking',
			'link' => '//womble.me.uk/?p=39',
			'spaces' => 6,
		],
		[
			'name' => 'None (Group Supporter)',
			'link' => '',
			'spaces' => -1,
		],
	];

	public function run()
	{
		DB::table('activities')->delete();

		foreach (self::$activities as $activity) {
			Activity::create([
				'name' => $activity['name'],
				'link' => $activity['link'],
				'sat_total' => $activity['spaces'],
				'sun_total' => $activity['spaces'],
				'sat_used' => 0,
				'sun_used' => 0,
			]);
		}

	}

}
