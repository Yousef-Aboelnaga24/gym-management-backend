<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->cascadeOnDelete();
<<<<<<< HEAD
            $table->foreignId('session_id')->constrained('session')->cascadeOnDelete();
            $table->date('booking_date');
            $table->boolean('is_attended')->default(false);
            $table->unique(['member_id', 'session_id']);
=======
            $table->foreignId('session_id')->constrained('sessions')->cascadeOnDelete();
            $table->date('booking_date');
            $table->boolean('is_attended')->default(false);
>>>>>>> origin/main
            $table->timestamps();
            $table->unique(['member_id', 'session_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};