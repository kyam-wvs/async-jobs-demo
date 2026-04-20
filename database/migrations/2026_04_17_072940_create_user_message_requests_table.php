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
        Schema::create('user_message_requests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('completed')->default(false);
            $table->integer('time_taken_ms')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_message_requests');
    }
};
