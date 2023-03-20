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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->enum("gender", ["M", "F"]);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->char("phone", 16);
            $table->string('password');
            $table->string("address");
            $table->enum("level", ["4dm1n", "user"])->default("user");
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
