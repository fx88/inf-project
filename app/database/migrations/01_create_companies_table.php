<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompaniesTable extends Migration {

	public function up()
	{
		Schema::create('companies', function(Blueprint $table) {

			$table->increments('id');

			$table->string('name', 100)->nullable();
			$table->string('address', 100)->nullable();
			$table->integer('zip', 5)->nullable();
			
			$table->string('place', 100)->nullable();
			$table->string('street', 100)->nullable();
			$table->string('country', 100)->nullable();

			$table->string('contact', 100)->nullable();
			
			$table->softDeletes();
			$table->timestamps();
			
		});
	}

	public function down()
	{
		Schema::drop('companies');
	}
}