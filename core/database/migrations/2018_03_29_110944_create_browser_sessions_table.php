<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrowserSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('browser_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
			$table->string('platform');
			$table->string('browser');
			$table->string('ip_address')->default('0.0.0.0');
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
        Schema::dropIfExists('browser_sessions');
    }
}
