<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRatingCompanyTable extends Migration {

	public function up()
	{
		Schema::create('rating_company', function(Blueprint $table) {

			$table->increments('id');
			$table->integer('rating_id')->unsigned();
			$table->integer('company_id')->unsigned();
			$table->timestamps();
			
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('rating_id')->references('id')->on('ratings')->onDelete('restrict')->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('rating_company', function($table) {	
			
			$table->dropForeign('companies_company_id_foreign');
			$table->dropForeign('ratings_rating_id_foreign');
			
		});
		
		Schema::drop('rating_company');
	}
}
