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
        Schema::create('fields', function (Blueprint $table) {
            $table->id("field_id");
            $table->text("title");
            $table->text('image');
            $table->string('desc');
            $table->integer("disc");
            $table->integer("min_time");
            $table->boolean("status");
            $table->integer("price");
            $table->string('map_link');
            $table->foreignId("type_id")->references("type_id")->on("field_types");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fields');
    }
};
