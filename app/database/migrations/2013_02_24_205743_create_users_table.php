<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	protected $table = 'users';

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
			$table->string('email', 200);
			$table->string('password', 60);
			$table->integer('level')->unsigned();
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