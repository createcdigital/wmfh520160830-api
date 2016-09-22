<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('w_shares', function (Blueprint $table) {
            $table->string('id');
            $table->string('share_id');
            $table->string('openid');
            $table->timestamps();

            $table->primary(['share_id', 'openid']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('w_shares');
    }
}
