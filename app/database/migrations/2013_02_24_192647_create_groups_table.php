<?php

use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration {

	protected $table = 'groups';

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
			$table->string('hash', 8);
			$table->string('name', 50);
			$table->integer('section')->unsigned();
			$table->string('contact_name', 50);
			$table->string('contact_email', 200);
			$table->string('contact_phone', 15);
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