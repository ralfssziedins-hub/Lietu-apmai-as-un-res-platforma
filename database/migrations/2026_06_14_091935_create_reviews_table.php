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
    Schema::create('reviews', function (Blueprint $table) {
        $table->id();

        $table->foreignId('request_id')->constrained('requests')->onDelete('cascade');
        $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');

        $table->unsignedTinyInteger('rating');
        $table->text('text');

        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('reviews');
}
};
