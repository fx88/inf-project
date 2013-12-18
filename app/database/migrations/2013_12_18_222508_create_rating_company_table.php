<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingCompanyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rating_company', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('rating_id')->unsigned();
			$table->integer('company_id')->unsigned();
			$table->timestamps();
			
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('rating_id')->references('id')->on('ratings')->onDelete('restrict')->onUpdate('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('rating_company', function($table) {	
			
			$table->dropForeign('rating_company_company_id_foreign');
			$table->dropForeign('rating_company_rating_id_foreign');
			
		});
	
		Schema::drop('rating_company');
	}

}
