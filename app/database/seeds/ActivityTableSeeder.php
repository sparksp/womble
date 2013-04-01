<?php

class ActivityTableSeeder extends Seeder {

	protected static $activities = [
		[
			'name' => 'Canoeing',
			'spaces' => 12,
		],
		[
			'name' => 'Caving',
			'spaces' => 15,
		],
		[
			'name' => 'Climbing',
			'spaces' => 12,
		],
		[
			'name' => 'Mountain Biking',
			'spaces' => 6,
		],
		[
			'name' => 'None (Group Supporter)',
			'spaces' => -1,
		],
	];

	public function run()
	{
		DB::table('activities')->delete();

		foreach (self::$activities as $activity) {
			Activity::create([
				'name' => $activity['name'],
				'sat_total' => $activity['spaces'],
				'sun_total' => $activity['spaces'],
				'sat_used' => 0,
				'sun_used' => 0,
			]);
		}

	}

}
