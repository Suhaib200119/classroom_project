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
        Schema::create('classrooms_users', function (Blueprint $table) {
            $table->foreignId("classroom_id")->constrained("classrooms","id")->cascadeOnDelete();
            $table->foreignId("user_id")->constrained("users","id")->cascadeOnDelete();
            $table->primary(["classroom_id","user_id"]);
            $table->timestamp("created_at");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms_users');
    }
};
