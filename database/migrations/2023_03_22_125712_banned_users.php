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
        Schema::create('banned_users', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->string('who_banned');
            $table->string('gamer_id');
            $table->string('ban_type');
            $table->string('ban_time');
            $table->string('ban_description');
            $table->string('ban_image');
            $table->integer('ban_status');
            $table->timestamps('banned_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banned_users');
    }
};
