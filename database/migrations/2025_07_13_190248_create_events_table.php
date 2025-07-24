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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->dateTime('event_date')->index(); // index untuk pencarian
            $table->integer('quota');
            $table->text('description')->nullable();
            $table->enum('category', ['music', 'theater', 'seminar', 'exhibition']);
            $table->string('banner_url');
            $table->integer('total_likes')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
