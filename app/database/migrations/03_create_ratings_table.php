<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRatingsTable extends Migration {

	public function up()
	{
		Schema::create('ratings', function(Blueprint $table) {

			$table->increments('id');

			$table->integer('rating', 11)->nullable();
			$table->string('comment', 50)->nullable();

			$table->integer('company_id', 11)->nullable();
			
			$table->softDeletes();
			$table->timestamps();
			
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('restrict')->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('ratings', function($table) {	
			
			$table->dropForeign('companies_company_id_foreign');

		});
		
		Schema::drop('ratings');
	}
}