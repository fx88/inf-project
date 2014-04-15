<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ratings', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('rating')->nullable();
			$table->string('comment', 50)->nullable();

			$table->integer('company_id')->unsigned();
			
			$table->softDeletes();
			$table->timestamps();
			
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('restrict')->onUpdate('restrict');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ratings', function($table) {	
			
			$table->dropForeign('companies_company_id_foreign');

		});
	
		Schema::drop('ratings');
	}

}
