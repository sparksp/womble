<?php

use Illuminate\Database\Migrations\Migration;

class CreateHealthTable extends Migration {

	protected $health =  'health';
	protected $attendees = 'attendees';

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create($this->health, function($table)
		{
			$table->increments('id');
			$table->text('data');
			$table->timestamps();
		});
		Schema::table($this->attendees, function($table)
		{
			$table->integer('health_id')->unsigned()->after('group_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table($this->attendees, function($table)
		{
			$table->dropColumn('health_id');
		});
		Schema::drop($this->health);
	}

}