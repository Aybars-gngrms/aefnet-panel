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
        Schema::create('system_authorities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('authorized_name');
            $table->string('authorized_email');
            $table->string('authorized_password');
            $table->string('authorized_security_question');
            $table->string('authorized_security_answer');
            $table->timestamp('authorized_last_login_date')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_authorities');
    }
};
