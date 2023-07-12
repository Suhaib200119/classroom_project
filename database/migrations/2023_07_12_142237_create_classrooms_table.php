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
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable(false);
            $table->string("code",10)->unique();
            $table->string("section",191)->nullable();
            $table->string("subject",191)->nullable();
            $table->string("room",191)->nullable();
            $table->string("theme",191)->nullable();
            $table->string("cover_image")->nullable();
            $table->enum("status",["active","archived"])->default("active");
            $table->foreignId("user_id")->constrained("users","id")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
