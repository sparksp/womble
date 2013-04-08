<?php

use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration {

	protected $table =  'activities';

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
			$table->string('link', 200);
			$table->integer('sat_total')->unsigned();
			$table->integer('sat_used')->unsigned();
			$table->integer('sun_total')->unsigned();
			$table->integer('sun_used')->unsigned();
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