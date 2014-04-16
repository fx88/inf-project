<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->nullable();
			$table->string('address')->nullable();
			$table->string('zip')->nullable();
			
			$table->string('place')->nullable();
			$table->string('street')->nullable();
			$table->string('country')->nullable();

			$table->string('contact')->nullable();
			$table->string('email')->nullable();
			$table->string('url')->nullable();	
					
			$table->softDeletes();
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
		Schema::drop('companies');
	}

}
