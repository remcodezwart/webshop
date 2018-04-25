<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumInteger('user_id');
            $table->char('name', 191);
            $table->char('middle_name', 191);
            $table->char('last_name', 191);
            $table->char('street', 191);
            $table->char('house_number', 191);
            $table->char('gender', 20);
            $table->char('post_code', 191);
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
        Schema::dropIfExists('clients');
    }
}
