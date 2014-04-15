<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyPriorityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('company_priority', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('priority_id')->unsigned();
			$table->integer('company_id')->unsigned();
			$table->timestamps();
			
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('priority_id')->references('id')->on('priorities')->onDelete('restrict')->onUpdate('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('company_priority', function($table) {	
			
			$table->dropForeign('rating_company_company_id_foreign');
			$table->dropForeign('rating_company_priority_id_foreign');
			
		});
	
		Schema::drop('company_priority');
	}

}
