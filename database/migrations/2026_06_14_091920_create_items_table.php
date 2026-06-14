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
    Schema::create('items', function (Blueprint $table) {
        $table->id();
        $table->string('title', 150);
        $table->text('description');
        $table->string('type', 50);
        $table->string('status', 50)->default('available');
        $table->decimal('price', 8, 2)->nullable();

        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('category_id')->constrained()->onDelete('cascade');

        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('items');
}
};
