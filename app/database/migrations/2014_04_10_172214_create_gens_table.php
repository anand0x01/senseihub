<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ads_response', function($table)
		{
			$table->index('res_ad_id');
		});
		Schema::create('ads_doubts', function($table)
		{
			$table->index('doubts_ad_id');
		});
		Schema::create('listprocess', function($table)
		{
			$table->index('list_user_id');
		});
		Schema::create('u_messages', function($table)
		{
			$table->index('msg_user_id');
		});
		Schema::create('ad_views', function($table)
		{
			$table->index('view_ad_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ads_response');
		Schema::drop('ads_doubts');
		Schema::drop('listprocess');
		Schema::drop('u_messages');
		Schema::drop('ad_views');
	}

}
