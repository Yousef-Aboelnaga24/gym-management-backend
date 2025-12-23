<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();

            $table->foreignId('member_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('plan_id')
                ->constrained()
                ->restrictOnDelete();

            $table->date('start_date');
            $table->date('end_date');

            $table->timestamps();

            $table->unique(['member_id', 'plan_id']);
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('table_name');
    }
};