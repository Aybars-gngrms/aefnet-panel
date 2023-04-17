<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_nick_historys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('gamer_id');
            $table->string('new_player_nick');
            $table->string('updated_at');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_nick_historys');
    }
};
