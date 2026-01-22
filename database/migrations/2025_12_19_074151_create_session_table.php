<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
            Schema::create('session', function (Blueprint $table) {
                $table->id();
                $table->foreignId('trainer_id')->constrained('trainers')->cascadeOnDelete();
                $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
                $table->string('name');
                $table->unsignedTinyInteger('capacity')->default(10);
                $table->dateTime('start_date');
                $table->dateTime('end_date');
                $table->enum('status', ['upcoming', 'ongoing', 'completed'])->default('upcoming');
                $table->timestamps();
            });
    }

    public function down(): void
    {
        Schema::dropIfExists('session');
    }
};
