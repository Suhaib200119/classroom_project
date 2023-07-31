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
        Schema::create('classworks', function (Blueprint $table) {
            $table->id();
            $table->foreignId("classroom_id")
                    ->constrained("classrooms","id")
                    ->cascadeOnDelete();

            $table->foreignId("user_id")->nullable()
                    ->constrained("users","id")
                    ->nullOnDelete();

            $table->foreignId("topic_id")->nullable()
                    ->constrained("topics","id")
                    ->nullOnDelete();

            $table->string("title")->nullable(false);
            $table->longText("description")->nullable(); 
            $table->enum("types",["assignment","material","question"]);
            $table->enum("status",["published","draft"])->default("published");
            $table->timestamp("published_at")->nullable();
            $table->json("options")->nullable();   


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classworks');
    }
};
