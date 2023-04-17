<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('gamer_id');
            $table->unsignedBigInteger('exceptional_id')->default(3);
            $table->string('email');
            $table->string('player_nick');
            $table->string('password');
            $table->string('ip_address')->default(0);
            $table->string('security_question');
            $table->string('security_answer');
            $table->string('computer_id')->default('')->nullable();
            $table->string('nick_update_date')->default('')->nullable();
            $table->datetime('last_login_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('pc_user_info')->default('')->nullable();
            $table->timestamps();

            $table->foreign('exceptional_id')
                  ->references('id')
                  ->on('exceptionals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
