<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('w_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('share_id')->unique();
            $table->string('openid')->unique();
            $table->string('name');
            $table->char('phone', 11);
            $table->string('card_list')->default('');
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
        Schema::drop('w_users');
    }
}
