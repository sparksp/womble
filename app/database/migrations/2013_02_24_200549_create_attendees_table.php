<?php

use Illuminate\Database\Migrations\Migration;

class CreateAttendeesTable extends Migration {

	protected $table = 'attendees';

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create($this->table, function($table)
		{
			$table->increments('id');
			$table->string('name', 50);
			$table->string('hash', 8);
			$table->decimal('paid', 3, 2)->default(0.0);
			$table->integer('group_id')->unsigned();
			$table->integer('sat_activity_id')->unsigned();
			$table->integer('sun_activity_id')->unsigned();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop($this->table);
	}

}